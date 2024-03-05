<?php

namespace App\Admin\Controllers;

use App\Model\EntryFee;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class EntryFeeController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'EntryFee';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new EntryFee());

        $grid->column('id', __('Id'));
        $grid->column('fee', __('Fee'));

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
        $show = new Show(EntryFee::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('fee', __('Fee'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new EntryFee());

        $form->decimal('fee', __('Fee'));

        return $form;
    }
}
