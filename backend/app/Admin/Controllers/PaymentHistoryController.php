<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Model\PaymentHistory;
use App\Model\User;
use App\Model\Tournament;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class PaymentHistoryController extends Controller
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
            ->header('Payment History List')
            ->description('All Payment History')
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
            ->header('Payment History Detail')
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
            ->description('Edit Payment History')
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
            ->description('Create Payment History')
            ->body($this->form());
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new PaymentHistory());

        $grid->id('ID')->sortable();
        $grid->tournament_id('Tournament ID')->editable();
        $grid->user_id('User ID')->editable();
        $grid->created_at('Created At');
        $grid->updated_at('Updated At');

        $grid->paginate(20);
        $grid->disableExport();
        $grid->disableColumnSelector();

        $grid->filter(function($filter){

            // Remove the default id filter
            $filter->disableIdFilter();

            // Add a column filter
            $filter->like('user_id', 'User ID');
            $filter->like('tournament_id', 'Tournament ID');



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
        $show = new Show(PaymentHistory::findOrFail($id));


        $show->id('ID');
        $show->user_id('User ID');
        $show->tournament_id('Tournament ID');
        $show->bomb('Bomb');
        $show->pay('Pay');
        $show->withdrawal('Withdrawal');
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
        $form = new Form(new PaymentHistory());

        $form->select('user_id','User')->options(User::all()->pluck('email','id'))->required();
        $form->select('tournament_id','Tournament')->options(Tournament::all()->pluck('name','id'))->required();
        $form->number('bomb','Bomb');
        $form->number('pay','Pay');
        $form->number('withdrawal','Withdrawal');


        return $form;
    }
}
