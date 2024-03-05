<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Model\Membership;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class MemberShipController extends Controller
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
            ->header('Membership List')
            ->description('All Membership')
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
            ->header('Membership Detail')
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
            ->description('Edit Membership')
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
            ->description('Create Membership')
            ->body($this->form());
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Membership());

        $grid->id('ID')->sortable();
        $grid->stripe_id('Stripe ID')->editable();
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
            $filter->like('stripe_id', 'Stripe ID');
            $filter->like('user_id', 'User ID');



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
        $show = new Show(Membership::findOrFail($id));


        $show->id('ID');
        $show->stripe_id('Stripe ID');
        $show->user_id('User ID');
        $show->sub_id('Sub ID');
        $show->plan_id('Plan ID');
        $show->boxfight_quadtity('Box Fight Quantity');
        $show->daily_allowed('Daily Allowed');
        $show->weekly_allowed('Weekly Allowed');
        $show->monthly_allowed('Monthly Allowed');
        $show->created_at('Created at');
        $show->updated_at('Updated at');
        $show->daily_quantity('Daily Quantity');
        $show->weekly_quantity('Weekly Quantity');
        $show->monthly_quantity('Monthly Quantity');
        $show->membership_quantity('Membership Quantity');
        $show->permission('Permission');
        $show->daily_date('Daily Date');
        $show->weekly_date('Weekly Date');
        $show->mothly_date('Monthly Date');
        $show->sub_update_date('Sub Update Date');



        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Membership());

        $form->text('stripe_id','Stripe ID');
        $form->text('user_id','User ID');
        $form->text('sub_id','Sub ID');
        $form->text('plan_id','Plan ID');
        $form->text('boxfight_quadtity','Box Fight Quantity');
        $form->text('daily_allowed','Daily Allowed');
        $form->text('weekly_allowed','Weekly Allowed');
        $form->text('monthly_allowed','Monthly Allowed');
        $form->datetime('created_at','Created at');
        $form->datetime('updated_at','Updated at');
        $form->text('daily_quantity','Daily Quantity');
        $form->text('weekly_quantity','Weekly Quantity');
        $form->text('monthly_quantity','Monthly Quantity');
        $form->text('membership_quantity','Membership Quantity');
        $form->text('permission','Permission');
        $form->datetime('daily_date','Daily Date');
        $form->datetime('weekly_date','Weekly Date');
        $form->datetime('mothly_date','Monthly Date');
        $form->datetime('sub_update_date','Sub Update Date');

        return $form;
    }
}
