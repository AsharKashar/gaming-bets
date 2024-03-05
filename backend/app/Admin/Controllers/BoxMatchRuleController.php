<?php

namespace App\Admin\Controllers;

use App\Model\BoxMatchRule;
use App\Model\Game;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class BoxMatchRuleController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Box Match Rule';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new BoxMatchRule());

        $grid->column('id', __('Id'));
        $grid->column('game_id', __('Game id'));
        $grid->column('title', __('Title'));
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));
        // $grid->column('deleted_at', __('Deleted at'));

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
        $show = new Show(BoxMatchRule::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('game_id', __('Game'));
        $show->field('title', __('Title'));
        $show->field('rule', __('Rules'))->unescape()->as(function ($items) {
            ob_start();
            foreach ($items as $key=>$val){
                echo "<div>{$val}</div>";
                echo "<hr />";
            }
            return ob_get_clean();
        });
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));
        $show->field('deleted_at', __('Deleted at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new BoxMatchRule());

        $form->select('game_id', __('Game id'))->options(Game::all()->pluck('name','id'))->required();
        $form->text('title', __('Title'))->required();
        $form->list('rule', __('Rules'));

        return $form;
    }
}
