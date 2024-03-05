<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Model\ReportIsuue;
use App\Model\User;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class ReportIssuesController extends Controller
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
            ->header('Report Issues List')
            ->description('All Report Issues')
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
            ->header('Report Issues Detail')
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
            ->description('Edit Report Issues')
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
            ->description('Create Report Issues')
            ->body($this->form());
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new ReportIsuue());

        $grid->id('ID')->sortable();
        $grid->title('Title')->editable();
        $grid->email('Email')->editable();
        $grid->created_at('Created At');
        $grid->updated_at('Updated At');

        $grid->paginate(20);
        $grid->disableExport();
        $grid->disableColumnSelector();

        $grid->filter(function($filter){

            // Remove the default id filter
            $filter->disableIdFilter();

            // Add a column filter
            $filter->like('title', 'Title');
            $filter->like('email', 'Email');



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
        $show = new Show(ReportIsuue::findOrFail($id));


        $show->id('ID');
        $show->title('Title');
        $show->email('Email');
        $show->description('Description');
        $show->user_id('User Id');
        $show->status('Status');
        $show->file('File');
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
        $form = new Form(new ReportIsuue());

        $form->text('title','Title')->required();
        $form->text('email','Email')->required();
        $form->text('description','Description')->required();
        $form->select('user_id','User')->options(User::all()->pluck('email','id'))->required();
        $form->select('status','Status')->options(['pending','in_process', 'resolved', 'canceled'])->default('pending');
        $form->text('file','File');


        return $form;
    }
}
