<?php

namespace App\Admin\Controllers;

use App\Model\MatchReport;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class MatchReportController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'MatchReport';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new MatchReport());

        $grid->column('id', __('Id'));
        $grid->column('user_id', __('User id'));
        $grid->column('match_id', __('Match id'));
        $grid->column('topic', __('Topic'));
        $grid->column('description', __('Description'));
        $grid->column('file_url', __('File url'));
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
        $show = new Show(MatchReport::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('user_id', __('User id'));
        $show->field('match_id', __('Match id'));
        $show->field('topic', __('Topic'));
        $show->field('description', __('Description'));
        $show->field('file_url', __('File url'));
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
        $form = new Form(new MatchReport());

        $form->number('user_id', __('User id'));
        $form->number('match_id', __('Match id'));
        $form->text('topic', __('Topic'));
        $form->textarea('description', __('Description'));
        $form->textarea('file_url', __('File url'));

        return $form;
    }
}
