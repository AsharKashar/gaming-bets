<?php

namespace App\Admin\Controllers;

use App\Model\UserPoint;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class UserPointController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'UserPoint';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new UserPoint());

        $grid->column('id', __('Id'));
        $grid->column('user_level_id', __('User level id'));
        $grid->column('points', __('Points'));
        $grid->column('user_id', __('User id'));
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
        $show = new Show(UserPoint::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('user_level_id', __('User level id'));
        $show->field('points', __('Points'));
        $show->field('user_id', __('User id'));
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
        $form = new Form(new UserPoint());

        $form->number('user_level_id', __('User level id'))->default(1);
        $form->decimal('points', __('Points'));
        $form->number('user_id', __('User id'));

        return $form;
    }
}
