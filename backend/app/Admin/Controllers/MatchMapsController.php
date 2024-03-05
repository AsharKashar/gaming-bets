<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Model\MatchMaps;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class MatchMapsController extends Controller
{
    use HasResourceActions;

    /**
     * Index interface.
     *
     * @param Content $content
     * @return Content
     */
    public function index(Content $content)
    {
        return $content
            ->header('Map List')
            ->description('All Map')
            ->body($this->grid());
    }

    /**
     * Show interface.
     *
     * @param mixed   $id
     * @param Content $content
     * @return Content
     */
    public function show($id, Content $content)
    {
        return $content
            ->header('Map Detail')
            ->description('Details')
            ->body($this->detail($id));
    }

    /**
     * Edit interface.
     *
     * @param mixed   $id
     * @param Content $content
     * @return Content
     */
    public function edit($id, Content $content)
    {
        return $content
            ->header('Edit')
            ->description('Edit Map')
            ->body($this->form()->edit($id));
    }

    /**
     * Create interface.
     *
     * @param Content $content
     * @return Content
     */
    public function create(Content $content)
    {
        return $content
            ->header('Create')
            ->description('Create Map')
            ->body($this->form());
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new MatchMaps());

        $grid->id('ID')->sortable();
        $grid->map_name('Map Name')->editable();
        $grid->created_at('Created At');
        $grid->updated_at('Updated At');

        $grid->paginate(20);
        $grid->disableExport();
        $grid->disableColumnSelector();

        $grid->filter(function($filter){

            // Remove the default id filter
            $filter->disableIdFilter();

            // Add a column filter
            $filter->like('map_name', 'Map Name');



        });

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed   $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(MatchMaps::findOrFail($id));


        $show->id('ID');
        $show->map_name('Map Name');
        $show->created_at('Created at');
        $show->updated_at('Updated at');


        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new MatchMaps());

        $form->text('map_name','Map Name')->required();


        return $form;
    }
}
