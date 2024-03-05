<?php

namespace App\Admin\Controllers;

use App\Model\BombHistory;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class BombHistoryController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'BombHistory';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new BombHistory());

        $grid->column('id', __('Id'));
        $grid->column('user_id', __('User id'));
        $grid->column('bombs_free', __('Bombs free'));
        $grid->column('bombs_paid', __('Bombs paid'));
        $grid->column('bombs_reward', __('Bombs reward'));
        $grid->column('type', __('Type'));
        $grid->column('pay', __('Pay'));
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
        $show = new Show(BombHistory::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('user_id', __('User id'));
        $show->field('bombs_free', __('Bombs free'));
        $show->field('bombs_paid', __('Bombs paid'));
        $show->field('bombs_reward', __('Bombs reward'));
        $show->field('type', __('Type'));
        $show->field('pay', __('Pay'));
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
        $form = new Form(new BombHistory());

        $form->number('user_id', __('User id'));
        $form->decimal('bombs_free', __('Bombs free'))->default(0.0000);
        $form->decimal('bombs_paid', __('Bombs paid'))->default(0.0000);
        $form->decimal('bombs_reward', __('Bombs reward'))->default(0.0000);
        $form->text('type', __('Type'));
        $form->text('pay', __('Pay'));

        return $form;
    }
}
