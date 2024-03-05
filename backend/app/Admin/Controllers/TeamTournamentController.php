<?php

namespace App\Admin\Controllers;

use App\Model\TeamTournament;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class TeamTournamentController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'TeamTournament';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new TeamTournament());

        $grid->column('id', __('Id'));
        $grid->column('team_id', __('Team id'));
        $grid->column('tournament_id', __('Tournament id'));
        $grid->column('is_valid', __('Is valid'));

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
        $show = new Show(TeamTournament::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('team_id', __('Team id'));
        $show->field('tournament_id', __('Tournament id'));
        $show->field('is_valid', __('Is valid'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new TeamTournament());

        $form->number('team_id', __('Team id'));
        $form->number('tournament_id', __('Tournament id'));
        $form->switch('is_valid', __('Is valid'));

        return $form;
    }
}
