<?php

namespace App\Admin\Controllers;

use App\Model\TournamentSize;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class TournamentSizeController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'TournamentSize';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new TournamentSize());

        $grid->column('id', __('Id'));
        $grid->column('game_id', __('Game id'));
        $grid->column('players_count', __('Players count'));

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
        $show = new Show(TournamentSize::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('game_id', __('Game id'));
        $show->field('players_count', __('Players count'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new TournamentSize());

        $form->number('game_id', __('Game id'));
        $form->number('players_count', __('Players count'));

        return $form;
    }
}
