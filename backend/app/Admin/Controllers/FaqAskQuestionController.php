<?php

namespace App\Admin\Controllers;

use App\Model\FaqAskQuestion;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class FaqAskQuestionController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'FaqAskQuestion';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new FaqAskQuestion());

        $grid->column('id', __('Id'));
        $grid->column('username', __('Username'));
        $grid->column('email', __('Email'));
        $grid->column('description', __('Description'));
        $grid->column('file_url', __('File url'));
        $grid->column('answer', __('Answer'));
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));
        $grid->column('deleted_at', __('Deleted at'));
        // $grid->model()->where('id', '=', 'match_id');
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
        $show = new Show(FaqAskQuestion::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('username', __('Username'));
        $show->field('email', __('Email'));
        $show->field('description', __('Description'));
        $show->field('file_url', __('File url'));
        $show->avatar('File')->image()->as(function ($content) {
            return "<img src='{$this->file_url}' width='600px'/>";
        });
        $show->field('answer', __('Answer'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));
        $show->field('deleted_at', __('Deleted at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new FaqAskQuestion());

        $form->text('username', __('Username'));
        $form->email('email', __('Email'));
        $form->textarea('description', __('Description'));
        $form->text('file_url', __('File url'));
        $form->textarea('answer', __('Answer'));

        return $form;
    }
}
