<?php


namespace App\Admin\Controllers;

use App\Model\BombPackage;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;


class BombPackageController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Bomb Package';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new BombPackage());

        $grid->column('id', __('Id'));
        $grid->column('title', __('Title'));
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
        $show = new Show(BombPackage::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('title', __('Title'));
        $show->field('description', __('Description'))->unescape()->as(function ($items) {
            ob_start();
            foreach ($items as $key=>$val){
                echo "<div>{$val}</div>";
                echo "<hr />";
            }
            return ob_get_clean();
        });
        $show->field('price', __('Price'));
        $show->field('bombs', __('Bombs'));
        $show->field('free_bombs', __('Free Bombs'));
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
        $form = new Form(new BombPackage());


        $form->text('id')->disable();

        $form->text('title', __('Title'));
        $form->list('description', __('Description'));

        $form->divider('Price');

        $form->number('bombs', 'Bombs');
        $form->number('free_bombs', 'Free Bombs');
        $form->number('price', 'Price');

        return $form;
    }
}