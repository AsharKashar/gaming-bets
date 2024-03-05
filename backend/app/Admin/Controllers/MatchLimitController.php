<?php

namespace App\Admin\Controllers;

use App\Model\MatchLimit;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class MatchLimitController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'MatchLimit';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new MatchLimit());

        $grid->column('id', __('Id'));
        $grid->column('min', __('Min'));
        $grid->column('max', __('Max'));

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
        $show = new Show(MatchLimit::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('min', __('Min'));
        $show->field('max', __('Max'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new MatchLimit());

        $form->number('min', __('Min'));
        $form->number('max', __('Max'));

        return $form;
    }
}
