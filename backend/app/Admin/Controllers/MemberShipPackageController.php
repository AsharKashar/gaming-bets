<?php

namespace App\Admin\Controllers;

use App\Model\Package;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class MemberShipPackageController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Membership Package';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Package());

        $grid->column('id', __('Id'));
        $grid->column('name', __('name'));
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
        $show = new Show(Package::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('name', __('Name'));
        $show->field('stripe_plan', __('Stripe plan'));
        $show->field('boxfight_quantity', __('Boxfight Quantity'));
        $show->field('daily_allowed', __('Daily Allowed'));
        $show->field('weekly_allowed', __('Weekly Allowed'));
        $show->field('monthly_allowed', __('Monthly Allowed'));
        $show->field('pay', __('Pay'));
        $show->field('daily_save', __('Daily pay saving'));
        $show->field('money_win_chance', __('Chance to win'));
        $show->field('wagers', __('Wagers'));
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
        $form = new Form(new Package());


        $form->text('id')->disable();
        $form->text('name', __('Name'))->required();
        $form->text('stripe_plan', __('Stripe plan'))->required();
        $form->number('boxfight_quantity', __('Boxfight Quantity'))->required();
        $form->number('stripe_quantity', __('Stripe Quantity'))->required();
        $form->number('daily_allowed', __('Daily Allowed'))->required();
        $form->number('weekly_allowed', __('Weekly Allowed'))->required();
        $form->number('monthly_allowed', __('Monthly Allowed'))->required();
        $form->number('daily_save', __('Daily pay saving'))->required();
        $form->number('money_win_chance', __('Chance to win'))->required();
        $form->number('wagers', __('Wagers'))->required();
        $form->number('pay', __('Pay'))->required();

        return $form;
    }
}