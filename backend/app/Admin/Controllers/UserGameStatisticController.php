<?php

namespace App\Admin\Controllers;

use App\Model\UserGameStatistic;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class UserGameStatisticController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'UserGameStatistic';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new UserGameStatistic());

        $grid->column('id', __('Id'));
        $grid->column('user_id', __('User id'));
        $grid->column('game_id', __('Game id'));
        $grid->column('total_points_earned', __('Total points earned'));
        $grid->column('total_bombs_earned', __('Total bombs earned'));
        $grid->column('win_loss_record', __('Win loss record'));
        $grid->column('win_ratio', __('Win ratio'));
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
        $show = new Show(UserGameStatistic::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('user_id', __('User id'));
        $show->field('game_id', __('Game id'));
        $show->field('total_points_earned', __('Total points earned'));
        $show->field('total_bombs_earned', __('Total bombs earned'));
        $show->field('win_loss_record', __('Win loss record'));
        $show->field('win_ratio', __('Win ratio'));
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
        $form = new Form(new UserGameStatistic());

        $form->number('user_id', __('User id'));
        $form->number('game_id', __('Game id'));
        $form->number('total_points_earned', __('Total points earned'));
        $form->number('total_bombs_earned', __('Total bombs earned'));
        $form->decimal('win_loss_record', __('Win loss record'))->default(0.0);
        $form->decimal('win_ratio', __('Win ratio'))->default(0.0);

        return $form;
    }
}
