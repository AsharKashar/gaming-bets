<?php

namespace App\Admin\Controllers;

use App\Model\TeamTournamentUser;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class TeamTournamentUserController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'TeamTournamentUser';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new TeamTournamentUser());

        $grid->column('id', __('Id'));
        $grid->column('team_tournament_id', __('Team tournament id'));
        $grid->column('user_id', __('User id'));
        $grid->column('bomb_payed', __('Bomb payed'));

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
        $show = new Show(TeamTournamentUser::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('team_tournament_id', __('Team tournament id'));
        $show->field('user_id', __('User id'));
        $show->field('bomb_payed', __('Bomb payed'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new TeamTournamentUser());

        $form->number('team_tournament_id', __('Team tournament id'));
        $form->number('user_id', __('User id'));
        $form->switch('bomb_payed', __('Bomb payed'));

        return $form;
    }
}
