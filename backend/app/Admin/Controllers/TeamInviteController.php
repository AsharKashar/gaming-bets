<?php

namespace App\Admin\Controllers;

use App\Model\TeamInvite;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class TeamInviteController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'TeamInvite';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new TeamInvite());

        $grid->column('id', __('Id'));
        $grid->column('user_id', __('User id'));
        $grid->column('email', __('Email'));
        $grid->column('team_id', __('Team id'));
        $grid->column('token', __('Token'));
        $grid->column('status', __('Status'));
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
        $show = new Show(TeamInvite::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('user_id', __('User id'));
        $show->field('email', __('Email'));
        $show->field('team_id', __('Team id'));
        $show->field('token', __('Token'));
        $show->field('status', __('Status'));
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
        $form = new Form(new TeamInvite());

        $form->number('user_id', __('User id'));
        $form->email('email', __('Email'));
        $form->number('team_id', __('Team id'));
        $form->text('token', __('Token'));
        $form->number('status', __('Status'));

        return $form;
    }
}
