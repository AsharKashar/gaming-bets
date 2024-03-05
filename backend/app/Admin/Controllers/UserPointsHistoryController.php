<?php

namespace App\Admin\Controllers;

use App\Model\UserPointsHistory;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class UserPointsHistoryController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'UserPointsHistory';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new UserPointsHistory());

        $grid->column('id', __('Id'));
        $grid->column('match_user_id', __('Match user id'));
        $grid->column('points', __('Points'));
        $grid->column('reason', __('Reason'));
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
        $show = new Show(UserPointsHistory::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('match_user_id', __('Match user id'));
        $show->field('points', __('Points'));
        $show->field('reason', __('Reason'));
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
        $form = new Form(new UserPointsHistory());

        $form->number('match_user_id', __('Match user id'));
        $form->number('points', __('Points'));
        $form->text('reason', __('Reason'));

        return $form;
    }
}
