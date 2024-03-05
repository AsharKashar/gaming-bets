<?php

namespace App\Admin\Controllers;

use App\Model\DatHost\CsGoServer;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class CsGoServerController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'CsGoServer';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new CsGoServer());

        $grid->column('id', __('Id'));
        $grid->column('name', __('Name'));
        $grid->column('game', __('Game'));
        $grid->column('autostop', __('Autostop'));
        $grid->column('autostop_minutes', __('Autostop minutes'));
        $grid->column('custom_domain', __('Custom domain'));
        $grid->column('enable_mysql', __('Enable mysql'));
        $grid->column('location', __('Location'));
        $grid->column('scheduled_commands', __('Scheduled commands'));
        $grid->column('user_data', __('User data'));
        $grid->column('csgo_settings', __('Csgo settings'));
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
        $show = new Show(CsGoServer::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('name', __('Name'));
        $show->field('game', __('Game'));
        $show->field('autostop', __('Autostop'));
        $show->field('autostop_minutes', __('Autostop minutes'));
        $show->field('custom_domain', __('Custom domain'));
        $show->field('enable_mysql', __('Enable mysql'));
        $show->field('location', __('Location'));
        $show->field('scheduled_commands', __('Scheduled commands'));
        $show->field('user_data', __('User data'));
        $show->field('csgo_settings', __('Csgo settings'));
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
        $form = new Form(new CsGoServer());

        $form->text('name', __('Name'))->default('Banger Games');
        $form->text('game', __('Game'))->default('csgo');
        $form->text('autostop', __('Autostop'));
        $form->number('autostop_minutes', __('Autostop minutes'));
        $form->text('custom_domain', __('Custom domain'));
        $form->text('enable_mysql', __('Enable mysql'))->default('true');
        $form->text('location', __('Location'))->default('barcelona');
        $form->text('scheduled_commands', __('Scheduled commands'));
        $form->text('user_data', __('User data'));
        $form->text('csgo_settings', __('Csgo settings'));

        return $form;
    }
}
