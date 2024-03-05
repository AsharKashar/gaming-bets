<?php

namespace App\Admin\Controllers;

use App\Model\GameType;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class GameTypeController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'GameType';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new GameType());

        $grid->column('id', __('Id'));
        $grid->column('team_size_id', __('Team size id'));
        $grid->column('name', __('Name'));
        $grid->column('tag', __('Tag'));
        $grid->column('game_mode_id', __('Game mode id'));
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
        $show = new Show(GameType::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('team_size_id', __('Team size id'));
        $show->field('name', __('Name'));
        $show->field('tag', __('Tag'));
        $show->field('game_mode_id', __('Game mode id'));
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
        $form = new Form(new GameType());

        $form->number('team_size_id', __('Team size id'));
        $form->text('name', __('Name'));
        $form->text('tag', __('Tag'));
        $form->number('game_mode_id', __('Game mode id'));

        return $form;
    }
}
