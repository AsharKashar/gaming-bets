<?php

namespace App\Admin\Controllers;

use App\Model\TournamentOptions;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class TournamentOptionsController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'TournamentOptions';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new TournamentOptions());

        $grid->column('id', __('Id'));
        $grid->column('tournament_id', __('Tournament id'));
        $grid->column('locale_id', __('Locale id'));
        $grid->column('type', __('Type'));
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
        $show = new Show(TournamentOptions::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('tournament_id', __('Tournament id'));
        $show->field('locale_id', __('Locale id'));
        $show->field('type', __('Type'));
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
        $form = new Form(new TournamentOptions());

        $form->number('tournament_id', __('Tournament id'));
        $form->number('locale_id', __('Locale id'));
        $form->text('type', __('Type'));
        $form->text('data', __('Data'));

        return $form;
    }
}
