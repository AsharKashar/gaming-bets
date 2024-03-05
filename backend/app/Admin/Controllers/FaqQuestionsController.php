<?php

namespace App\Admin\Controllers;

use App\Model\FaqCatagories;
use App\Model\FaqQuestions;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class FaqQuestionsController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'FaqQuestions';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new FaqQuestions());

        $grid->column('id', __('Id'));
        $grid->column('faq_catagory_id', __('Faq catagory id'));
        $grid->column('question', __('Question'));
        $grid->column('answer', __('Answer'));


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
        $show = new Show(FaqQuestions::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('faq_catagory_id', __('Faq catagory id'));
        $show->field('question', __('Question'));
        $show->field('answer', __('Answer'));
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
        $form = new Form(new FaqQuestions());

        $form->select('faq_catagory_id', 'Faq catagory')->options(FaqCatagories::all()->pluck('catagory_name','id'))->required();
        $form->textarea('question', __('Question'));
        $form->textarea('answer', __('Answer'));

        return $form;
    }
}
