<?php

namespace App\Admin\Controllers;

use App\Model\BoxMatchInvite;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class BoxMatchInviteController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'BoxMatchInvite';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new BoxMatchInvite());

        $grid->column('id', __('Id'));
        $grid->column('match_id', __('Match id'));
        $grid->column('team_id', __('Team id'));
        $grid->column('token', __('Token'));
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
        $show = new Show(BoxMatchInvite::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('match_id', __('Match id'));
        $show->field('team_id', __('Team id'));
        $show->field('token', __('Token'));
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
        $form = new Form(new BoxMatchInvite());

        $form->number('match_id', __('Match id'));
        $form->number('team_id', __('Team id'));
        $form->text('token', __('Token'));

        return $form;
    }
}
