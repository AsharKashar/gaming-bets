<?php

namespace App\Admin\Controllers;

use App\Helpers\FileHelper;
use App\Model\BlogCategory;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;


class BlogCategoryController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Categories';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new BlogCategory());

        $grid->column('id', __('Id'));
        $grid->column('parent_id', __('Parent id'));
        $grid->column('name', __('Name'));
        $grid->column('slug', __('Slug'));
        $grid->column('preview_image_key', __('Preview Image'));
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(BlogCategory::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('parent_id', __('Parent id'));
        $show->field('name', __('Name'));
        $show->field('description', __('Description'));
        $show->field('slug', __('Slug'));
        $show->field('preview_image_key', __('Preview Image'));
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
        $form = new Form(new BlogCategory());
        $parentOptions = BlogCategory::all()->pluck('name', 'id');

        $form->select('parent_id', __('Parent category'))->options([null, ...$parentOptions]);
        $form->text('name', __('Name'))->required();
        $form->textarea('description', __('Description'));

        if ($form->isEditing()) {
            $id = request()->route('news_category');
            $model = $form->model()->find($id);
            $form->text('slug', __('Slug'))->default($model->slug);
        } else {
            $form->text('slug', __('Slug'));
        }

        $filename = '';
        if ($newFile = request()->preview_image_key) {
            $filename = FileHelper::formatFileName($newFile, true);
        }

        $form->image('preview_image_key',  __('Preview Image'))->move('blog_categories',"$filename")->removable();
        $form->ignore('slug');

        $form->saved(function (Form $form) {
            $blogCategory = BlogCategory::find($form->model()->id);
            $slugValue = request('slug') ?? $form->name ?? null;

            if ($slugValue && $blogCategory) {
                $blogCategory->applySlug($slugValue);
            }
        });

        return $form;
    }
}
