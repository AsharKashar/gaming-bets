<?php

namespace App\Admin\Controllers;

use App\Model\PaymentMethod;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class PaymentMethodController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'PaymentMethod';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new PaymentMethod());

        $grid->column('id', __('Id'));
        $grid->column('user_id', __('User id'));
        $grid->column('payment_method_id', __('Payment method id'));
        $grid->column('brand', __('Brand'));
        $grid->column('last4', __('Last4'));
        $grid->column('exp_month', __('Exp month'));
        $grid->column('exp_year', __('Exp year'));
        $grid->column('name', __('Name'));
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
        $show = new Show(PaymentMethod::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('user_id', __('User id'));
        $show->field('payment_method_id', __('Payment method id'));
        $show->field('brand', __('Brand'));
        $show->field('last4', __('Last4'));
        $show->field('exp_month', __('Exp month'));
        $show->field('exp_year', __('Exp year'));
        $show->field('name', __('Name'));
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
        $form = new Form(new PaymentMethod());

        $form->number('user_id', __('User id'));
        $form->textarea('payment_method_id', __('Payment method id'));
        $form->textarea('brand', __('Brand'));
        $form->number('last4', __('Last4'));
        $form->number('exp_month', __('Exp month'));
        $form->number('exp_year', __('Exp year'));
        $form->textarea('name', __('Name'));

        return $form;
    }
}
