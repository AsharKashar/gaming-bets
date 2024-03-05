<?php

namespace App\Admin\Controllers;

use App\Model\TournamentResult;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class TournamentResultController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'TournamentResult';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new TournamentResult());

        $grid->column('id', __('Id'));
        $grid->column('tournament_id', __('Tournament id'));
        $grid->column('first_place', __('First place'));
        $grid->column('second_place', __('Second place'));
        $grid->column('third_place', __('Third place'));
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
        $show = new Show(TournamentResult::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('tournament_id', __('Tournament id'));
        $show->field('first_place', __('First place'));
        $show->field('second_place', __('Second place'));
        $show->field('third_place', __('Third place'));
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
        $form = new Form(new TournamentResult());

        $form->number('tournament_id', __('Tournament id'));
        $form->number('first_place', __('First place'));
        $form->number('second_place', __('Second place'));
        $form->number('third_place', __('Third place'));

        return $form;
    }
}
