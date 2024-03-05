<?php

namespace App\Admin\Controllers;

use App\Model\Game;
use App\Model\Withdrawal;
use App\Model\User;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class WithdrawalController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Withdrawal';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Withdrawal());

        $grid->column('user_id', __('User'));
        $grid->column('account_number', __('Account Number'));
        $grid->column('account_holdername', __('Account Holder Name'));
        $grid->column('bank_name', __('Bank Name'));
        $grid->column('last4', __('Last 4'));
        $grid->column('account_holdertype', __('Account Holder Type'));
        $grid->column('currency', __('Currency'));
        $grid->column('routing_number', __('Routing Number'));
        $grid->column('status', __('Status'));
        $grid->column('created_at', __('Cretad at'));
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
        $show = new Show(Withdrawal::findOrFail($id));

        $show->field('user_id', __('User'));
        $show->field('account_number', __('Account Number'));
        $show->field('account_holdername', __('Account Holder Name'));
        $show->field('bank_name', __('Bank Name'));
        $show->field('last4', __('Last 4'));
        $show->field('account_holdertype', __('Account Holder Type'));
        $show->field('currency', __('Currency'));
        $show->field('routing_number', __('Routing Number'));
        $show->field('status', __('Status'));
        $show->field('created_at', __('Cretad at'));
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
        $form = new Form(new Withdrawal());

        $form->text('user_id', __('User'));
        $form->text('account_number', __('Account Number'));
        $form->text('account_holdername', __('Account Holder Name'));
        $form->text('bank_name', __('Bank Name'));
        $form->text('last4', __('Last 4'));
        $form->text('account_holdertype', __('Account Holder Type'));
        $form->text('currency', __('Currency'));
        $form->text('routing_number', __('Routing Number'));
        $form->text('status', __('Status'));
        $form->text('created_at', __('Cretad at'));
        $form->text('updated_at', __('Updated at'));

        return $form;
    }
}
