<?php

namespace App\Admin\Controllers;

use App\Model\Locale;
use App\Model\FaqCatagories;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class FaqCatagoriesController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'FaqCatagories';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new FaqCatagories());

        $grid->column('id', __('Id'));
        $grid->column('locale_id', __('Locale ID'));
        $grid->column('catagory_name', __('Catagory name'));
        $grid->created_at('Created At');
        $grid->updated_at('Updated At');

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
        $show = new Show(FaqCatagories::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('locale_id', __('Locale ID'));
        $show->field('catagory_name', __('Catagory name'));
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
        $form = new Form(new FaqCatagories());

        $form->select('locale_id', __('Locale'))->options(Locale::all()->pluck('name', 'id'));
        $form->text('catagory_name', __('Catagory name'));

        return $form;
    }
}
