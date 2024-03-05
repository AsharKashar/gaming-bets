<?php

namespace App\Admin\Controllers;

use App\Model\TournamentPrize;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class TournamentPrizeController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'TournamentPrize';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new TournamentPrize());

        $grid->column('id', __('Id'));
        $grid->column('team_id', __('Team id'));
        $grid->column('tournament_id', __('Tournament id'));
        $grid->column('position', __('Position'));
        $grid->column('prize', __('Prize'));
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));
        $grid->column('point', __('Point'));

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
        $show = new Show(TournamentPrize::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('team_id', __('Team id'));
        $show->field('tournament_id', __('Tournament id'));
        $show->field('position', __('Position'));
        $show->field('prize', __('Prize'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));
        $show->field('point', __('Point'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new TournamentPrize());

        $form->number('team_id', __('Team id'));
        $form->number('tournament_id', __('Tournament id'));
        $form->number('position', __('Position'));
        $form->decimal('prize', __('Prize'))->default(0.0000);
        $form->decimal('point', __('Point'));

        return $form;
    }
}
