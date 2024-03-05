<?php

namespace App\Admin\Controllers;

use App\Model\Card;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class CardController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Card';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Card());

        $grid->column('id', __('Id'));
        $grid->column('user_id', __('User id'));
        $grid->column('name', __('Name'));
        $grid->column('last_four', __('Last four'));
        $grid->column('expiry', __('Expiry'));
        $grid->column('brand', __('Brand'));
        $grid->column('stripe_payment_method', __('Stripe payment method'));
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));
        $grid->column('deleted_at', __('Deleted at'));

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
        $show = new Show(Card::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('user_id', __('User id'));
        $show->field('name', __('Name'));
        $show->field('last_four', __('Last four'));
        $show->field('expiry', __('Expiry'));
        $show->field('brand', __('Brand'));
        $show->field('stripe_payment_method', __('Stripe payment method'));
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
        $form = new Form(new Card());

        $form->number('user_id', __('User id'));
        $form->text('name', __('Name'));
        $form->number('last_four', __('Last four'));
        $form->date('expiry', __('Expiry'))->default(date('Y-m-d'));
        $form->text('brand', __('Brand'));
        $form->text('stripe_payment_method', __('Stripe payment method'));

        return $form;
    }
}
