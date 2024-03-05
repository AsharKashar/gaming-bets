<?php

namespace App\Admin\Controllers;

use App\Admin\Actions\LoginAsUser;
use App\Http\Controllers\Controller;
use App\Model\User;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
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
            ->header('Users List')
            ->description('All Users')
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
            ->header('Users Detail')
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
            ->description('Edit User')
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
            ->description('Create User')
            ->body($this->form());
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new User());

        $grid->id('ID')->sortable();
        $grid->name('Name')->editable();
        $grid->username('Username');
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
            $filter->like('name', 'Name');
            $filter->like('email', 'Email');



        });

        $grid->actions(function ($actions) {
            $actions->add(new LoginAsUser);
        });

        $grid->model()->orderBy('id', 'desc');

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
        $show = new Show(User::findOrFail($id));


        $show->id('ID');
        $show->name('Name');
        $show->username('Username');
        $show->email('Email');
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
        $form = new Form(new User());

        $form->text('name','Name')->required();
        $form->text('username','Username')->required();
        $form->text('email','Email')->required();
        $form->password('password','Password')->required();

        $form->datetime('email_verified_at','Email Verified At');
        $form->select('user_type','User Type')->options(['admin','user'])->default('admin')->required();

        $form->saving(function (Form $form) {
            if ($form->password) {
                $form->password = Hash::make($form->password);
            }
        });

        return $form;
    }
}
