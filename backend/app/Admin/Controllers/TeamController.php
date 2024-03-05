<?php

namespace App\Admin\Controllers;

use App\Model\Game;
use App\Model\Team;
use App\Model\TeamSize;
use App\Model\User;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class TeamController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Team';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Team());

        $grid->column('team_id', __('Team id'));
        $grid->column('name', __('Name'));
        $grid->column('size', __('Size'));

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
        $show = new Show(Team::findOrFail($id));

        $show->field('team_id', __('Team id'));
        $show->field('name', __('Name'));
        $show->field('size', __('Size'));
        $show->field('avatar_key', __('Avatar'));

        return $show;
    }

    public function edit($id, Content $content)
    {
        return $content
            ->header('Edit')
            ->description('Edit Team')
            ->body($this->form()->edit($id));
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Team());
        $games = Game::all()->pluck('name', 'id');
        $users = User::all()->pluck('name', 'id');
        $sizes = TeamSize::all()->pluck('name', 'id');

        if ($form->isEditing()) {
            $id = request()->route('team');
            $team = Team::find($id);
            $form->text('token', __('Token'))->default($team->token)->disable();
            $form->select('owner_id',__('Team owner'))->options($users)->default($team->owner_id)->required();
        } else {
            $form->select('owner_id',__('Team owner'))->options($users)->required();
        }
        $form->text('name', __('Name'))->required();
        $form->select('game_id',__('Related game'))->options($games)->required();
        $form->select('team_size_id',__('Team size'))->options($sizes)->required();


        if ($form->isEditing()) {
            $id = request()->route('team');
            $form->image('avatar_key', __('Avatar'))->move("teams/$id","avatar.jpg");
        }

        $form->saved(function (Form $form) {

            $team = Team::find($form->model()->team_id);
            $ownerId = request('owner_id');

            if ($team && $ownerId) {
                $team->addMember(User::find($ownerId), ['is_leader' => true, 'checked_in' => true]);
            }
        });

        return $form;
    }
}
