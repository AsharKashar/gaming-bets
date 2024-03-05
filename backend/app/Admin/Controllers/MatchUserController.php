<?php

namespace App\Admin\Controllers;

use App\Model\MatchUser;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class MatchUserController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'MatchUser';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new MatchUser());

        $grid->column('id', __('Id'));
        $grid->column('match_id', __('Match id'));
        $grid->column('team_id', __('Team id'));
        $grid->column('user_id', __('User id'));
        $grid->column('points', __('Points'));
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));
        $grid->column('result_data', __('Result data'));
        $grid->column('kills', __('Kills'));
        $grid->column('deaths', __('Deaths'));
        $grid->column('assists', __('Assists'));

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
        $show = new Show(MatchUser::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('match_id', __('Match id'));
        $show->field('team_id', __('Team id'));
        $show->field('user_id', __('User id'));
        $show->field('points', __('Points'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));
        $show->field('result_data', __('Result data'));
        $show->field('kills', __('Kills'));
        $show->field('deaths', __('Deaths'));
        $show->field('assists', __('Assists'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new MatchUser());

        $form->number('match_id', __('Match id'));
        $form->number('team_id', __('Team id'));
        $form->number('user_id', __('User id'));
        $form->number('points', __('Points'));
        $form->textarea('result_data', __('Result data'));
        $form->number('kills', __('Kills'));
        $form->number('deaths', __('Deaths'));
        $form->number('assists', __('Assists'));

        return $form;
    }
}
