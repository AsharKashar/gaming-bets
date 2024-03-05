<?php

namespace App\Admin\Controllers;

use App\Model\BoxMatchResult;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class BoxMatchResultController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'BoxMatchResult';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new BoxMatchResult());

        $grid->column('id', __('Id'));
        $grid->column('boxmatch_id', __('Boxmatch id'));
        $grid->column('user_id', __('User id'));
        $grid->column('winnings', __('Winnings'));
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
        $show = new Show(BoxMatchResult::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('boxmatch_id', __('Boxmatch id'));
        $show->field('user_id', __('User id'));
        $show->field('winnings', __('Winnings'));
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
        $form = new Form(new BoxMatchResult());

        $form->number('boxmatch_id', __('Boxmatch id'));
        $form->number('user_id', __('User id'));
        $form->number('winnings', __('Winnings'));

        return $form;
    }
}
