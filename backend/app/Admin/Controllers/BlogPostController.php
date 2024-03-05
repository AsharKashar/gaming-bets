<?php

namespace App\Admin\Controllers;

use App\Helpers\FileHelper;
use App\Model\BlogCategory;
use App\Model\BlogPost;
use App\Model\Locale;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Log;

class BlogPostController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Posts';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new BlogPost());

        $grid->column('id', __('Id'));
        $grid->column('name', __('Name'));
        $grid->column('slug', __('Slug'));
        $grid->column('status', __('Post Status'));
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param  mixed  $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(BlogPost::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('name', __('Name'));
        $show->field('status', __('Post Status'));
        $show->field('body', __('Body'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new BlogPost());

        $id = request()->route('news_post');
        $categories = BlogCategory::all()->pluck('name', 'id');
        $mainCategories = BlogCategory::whereNull('parent_id')->pluck('name', 'id');
        $locales = Locale::all()->pluck('name', 'id');

        if ($id) {
            $form->text('id')->default($id)->disable();
        }


        $form->tools(function (Form\Tools $tools) {
            $tools->disableView();
        });

        $form->select('status', __('Post Status'))->options(BlogPost::STATUSES)->required();

        $filename = '';
        if ($newFile = request()->preview_image_key) {
            $filename = FileHelper::formatFileName($newFile, true);
        }

        $form->image('preview_image_key', __('Preview Image'))->move('blog_posts', "$filename")->removable();
        $form->multipleSelect('categories', __('Other categories'))->options($categories);
        $form->select('main_category_id', __('Main Category'))->options($mainCategories)->required();


        if ($form->isEditing()) {
            $model = $form->model()->find($id);
            $form->text('slug', __('Slug'))->default($model->slug);
            $form->text('slug-preview',
                __('Slug preview(will be updated after save)'))->default(config('app.url').'/'.$model->full_post_slug)->disable();
        } else {
            $form->text('slug', __('Slug'));
        }

        $form->html("
            <script>
                   const langOptions = JSON.parse('".json_encode($locales)."');
                   const optionsEditor = JSON.parse('".json_encode(config('admin.extensions.tmeditor.config'))."');
                   const initEditor = (selector) => {
                       tinymce.init({
                            selector,
                            ...optionsEditor
                       })
                   };
                   $(document).ready(() => {
                       let indexTemplate = 0;
                       const localesSelector = '.locales.body';
                       $(localesSelector).each(function() {
                           initEditor(localesSelector);
                       })

                       const isShow = (el) => el.css('display') !== 'none';

                       const buttonCreate = $('<button/>', {
                          text: 'New',
                          class:  'btn btn-success btn-sm',
                          type: 'button',
                       });

                       buttonCreate.on('click', () => {
                           createLocale();
                       });

                       const localeWrap = $('#has-many-locales');
                       const localeTemplate = localeWrap.find('.locales-tpl')[0].content;
                       const templateWrap = localeWrap.find('.has-many-locales-forms');
                       const select = templateWrap.find('select');
                       const formGroup = templateWrap.find('.has-many-locales-form.fields-group');

                       const showBtn = (parent) => {
                           parent.find('.remove.btn').on('click', () => {
                                buttonCreate.show();
                            })
                       }
                       const toggleButtonShow = () => {
                           const lengthTemplate =  $('.has-many-locales-form.fields-group').filter(function() { return isShow($(this))});
                             if (lengthTemplate.length === Object.keys(langOptions).length) {
                                   buttonCreate.hide();
                             } else {
                                   buttonCreate.show();
                             }
                       };

                       const createBtnPreview = (wrap) => {
                           const btnPreview = $('<a/>', {
                                target: '_blank',
                                style: 'margin-right: 5px',
                                class: 'btn btn-sm btn-primary btn--preview',
                                text: 'Preview',
                                href: '/preview?page=news&postId=' + ".$id." +  '&locale=' + wrap.find('select.locales').val(),
                            });

                            $('<i/>', {
                                class: 'fa fa-eye',
                            }).prependTo(btnPreview);

                            btnPreview.insertAfter(wrap.find('.remove.btn'));
                       };

                        select.select2({
                            allowClear: false
                        });

                        if (formGroup.length) {
                            formGroup.each(function () {
                                createBtnPreview($(this));
                                showBtn($(this));
                            })
                        }

                        toggleButtonShow();

                        const setChangeSelect = (select) => {

                            select.on('select2:selecting', function (e) {
                                const { data } = e.params.args;

                                const selectsLang =  $('select.locale_id').filter(function () {
                                    return $(this).val() === data.id && isShow($(this).closest('.has-many-locales-form.fields-group'));
                                })
                                if (selectsLang.length) {
                                    e.preventDefault();
                                }
                            });
                        };

                        setChangeSelect(select);

                       buttonCreate.appendTo(localeWrap);


                        const createLocale = () => {
                            indexTemplate++;
                            let template = $(localeTemplate.childNodes).filter(function (){
                                return $(this).hasClass('fields-group')
                            })[0].cloneNode(true);
                            template = $(template);

                            template.appendTo(templateWrap);

                            template.find('[name*=\"[new___LA_KEY__]\"]').each(function () {
                                const name = $(this).attr('name').replace('new___LA_KEY__', 'new_' + indexTemplate);
                                $(this).attr('name', name);
                            });
                            /*Toggle button*/

                            // showBtn(template);

                            toggleButtonShow();


                            /*Init select*/

                            const select = template.find('select');
                            let prevSelectionLang = [];

                            templateWrap.find('select').each(function () {
                                if ($(this).not(select) && $(this).val() && isShow($(this).closest('.has-many-locales-form.fields-group'))) {
                                    prevSelectionLang.push($(this).val());
                                }
                            });
                            console.log(prevSelectionLang);
                            prevSelectionLang = Object.keys(langOptions).filter((el) => !prevSelectionLang.includes(el));

                            select.find('option').each(function() {
                                if (!$(this).val()) {
                                    $(this).remove();
                                }
                            });

                            select.val(Array.isArray(prevSelectionLang) ? prevSelectionLang[0] : prevSelectionLang);
                            select.select2();

                            setChangeSelect(select);
                            /*Init Editor*/
                            const editor = template.find('.body');
                            const editorId = new Date().getTime() + 'editor';
                            editor.attr('id', editorId)
                            initEditor('#'+editorId);

                       }

                       if (!templateWrap.children().length) {
                          createLocale();
                       }
                   })

                 // templateLocale.prepend('buttonCreate');
            </script>
        ");


        $form->hasMany('locales', 'Post locale', function (Form\NestedForm $nestedForm) use ($locales){
            $nestedForm->select('locale_id',  __('Locale'))->options($locales)->required();
            $nestedForm->text('name', __('Name'))->required();
            $nestedForm->text('description', __('Description'));
            $nestedForm->text('meta_title', __('Meta title'));
            $nestedForm->text('meta_description', __('Meta description'));
            $nestedForm->textarea('body', 'Body');
        })->disableCreate();


        $form->ignore(['id', 'slug']);

        $form->saved(function (Form $form) {
            $blogPost = BlogPost::find($form->model()->id);
            $slugValue = request('slug');

            if (!$slugValue) {
                foreach ($form->locales as $locale) {
                    if ($locale['_remove_'] === '0' && $locale['name']) {
                        $slugValue = $locale['name'];
                        break;
                    }
                }
            }

            if ($slugValue && $blogPost) {
                $blogPost->applySlug($slugValue);
            }
        });

        return $form;
    }
}
