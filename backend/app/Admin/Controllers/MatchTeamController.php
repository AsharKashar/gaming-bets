<?php

namespace App\Admin\Controllers;

use App\Model\MatchTeam;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class MatchTeamController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'MatchTeam';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new MatchTeam());

        $grid->column('id', __('Id'));
        $grid->column('match_id', __('Match id'));
        $grid->column('team_id', __('Team id'));
        $grid->column('place', __('Place'));
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));
        $grid->column('result_data', __('Result data'));
        $grid->column('score', __('Score'));

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
        $show = new Show(MatchTeam::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('match_id', __('Match id'));
        $show->field('team_id', __('Team id'));
        $show->field('place', __('Place'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));
        $show->field('result_data', __('Result data'));
        $show->field('score', __('Score'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new MatchTeam());

        $form->number('match_id', __('Match id'));
        $form->number('team_id', __('Team id'));
        $form->number('place', __('Place'));
        $form->textarea('result_data', __('Result data'));
        $form->number('score', __('Score'));

        return $form;
    }
}
