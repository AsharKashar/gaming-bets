<?php

namespace App\Admin\Controllers;

use App\Model\UserConnection;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class UserConnectionController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'UserConnection';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new UserConnection());

        $grid->column('id', __('Id'));
        $grid->column('user_id', __('User id'));
        $grid->column('service_type', __('Service type'));
        $grid->column('social_id', __('Social id'));
        $grid->column('service_info', __('Service info'));
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));
        $grid->column('data', __('Data'));

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
        $show = new Show(UserConnection::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('user_id', __('User id'));
        $show->field('service_type', __('Service type'));
        $show->field('social_id', __('Social id'));
        $show->field('service_info', __('Service info'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));
        $show->field('data', __('Data'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new UserConnection());

        $form->number('user_id', __('User id'));
        $form->text('service_type', __('Service type'));
        $form->text('social_id', __('Social id'));
        $form->text('service_info', __('Service info'));
        $form->textarea('data', __('Data'));

        return $form;
    }
}
