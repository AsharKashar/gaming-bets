<?php

namespace App\Admin\Controllers;

use App\Helpers\FileHelper;
use App\Model\Game;
use App\Model\GameMode;
use App\Model\MatchLimit;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class GameModeController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'GameMode';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new GameMode());

        $grid->column('id', __('Id'));
        $grid->column('name', __('Name'));
        $grid->column('tag', __('Tag'));
        $grid->column('game_id', __('Game id'));
        $grid->column('match_limits_id', __('Match limits id'));
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));
        $grid->column('preview_img', __('Preview img'));

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
        $show = new Show(GameMode::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('name', __('Name'));
        $show->field('tag', __('Tag'));
        $show->field('game_id', __('Game id'));
        $show->field('match_limits_id', __('Match limits id'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));
        $show->field('preview_img', __('Preview img'));
        $show->field('available', __('Availability in beta'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new GameMode());

        $form->text('name', __('Name'));
        $form->text('tag', __('Tag'));
        $form->select('game_id', __('Game'))->options(Game::all()->pluck('name','id'))->required();
        $form->select('match_limits_id', __('Match limits id'))->options(MatchLimit::all()->pluck('id','id'))->required();
        $filename = '';
        if ($newFile = request()->preview_image_key) {
            $filename = FileHelper::formatFileName($newFile, true);
        }

        $form->image('preview_img', __('Preview Image'))->move('tournaments_game_mode', "$filename")->removable();
        $form->switch('available', __('Availability in beta'));
        return $form;
    }
}
