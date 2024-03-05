<?php

namespace App\Admin\Controllers;
use App\Model\BoxMatches;
use App\Model\Game;
use App\Model\User;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class BoxMatchController extends Controller
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
            ->header('Box Match List')
            ->description('All Box Match')
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
            ->header('Box Match Detail')
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
            ->description('Edit Box Match')
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
            ->description('Create Box Match')
            ->body($this->form());
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new BoxMatches());

        $grid->id('ID')->sortable();
        $grid->platform('Platform')->display(function($data){
            return $data['name'];
        });
        $grid->region('Region')->display(function($data){
            return $data['name'];
        });;
        $grid->created_at('Created At');
        $grid->updated_at('Updated At');

        $grid->paginate(20);
        $grid->disableExport();
        $grid->disableColumnSelector();

        $grid->filter(function($filter){

            // Remove the default id filter
            $filter->disableIdFilter();

            // Add a column filter
            $filter->like('platform', 'Platform');
            $filter->like('region', 'Region');



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
        $show = new Show(BoxMatches::findOrFail($id));


        $show->id('ID');
        $show->match_id('Match ID');
        $show->team_id('Team ID');
        $show->bid_amount('Bıd Amount');
        $show->game_type('Game Type');
        $show->platform('Platform');
        $show->region('Region');
        $show->user_id('User ID');
        $show->username('Username');
        $show->result('Result');
        $show->proof('Proof');
        $show->status('Status');
        $show->created_at('Created at');
        $show->updated_at('Updated at');
        $show->conflict_flag('Conflict Flag');
        $show->game_id('Game');
        $show->time('Time');
        $show->proof_secondary('Proof Secondary');
        $show->matchEnd_time('Match End Time');

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new BoxMatches());

        $form->select('match_id','Match')->options(BoxMatches::all()->pluck('match_id','id'))->required();
        $form->select('team_id','Team')->options([1 =>'1',2 =>'2'])->required();
        $form->number('bid_amount','Bid Amount')->required();
        $form->text('game_type','Game Type')->required();
        $form->select('platform','Platform')->options(['Xbox','Pc','Playstation','Cross-Platform','All']);
        $form->select('region','Region')->options(['Europe','NA East']);
        $form->select('user_id','User')->options(User::all()->pluck('email','id'))->required();
        $form->text('username','Username');
        $form->select('result','Result')->options(['won','lost']);
        $form->text('proof','Proof');
        $form->select('status','status')->options([1 =>'1', 2 =>'2', 3 => '3', 4 => '4', 5 => '5', 6 => '6'])->required();
        $form->datetime('created_at','Created at');
        $form->datetime('updated_at','Updated at');
        $form->select('conflict_flag','Conflict Flag')->options([1 =>'1', 2 =>'2']);
        $form->select('game_id','Game')->options(Game::all()->pluck('name','id'));
        $form->datetime('time','Time');
        $form->text('proof_secondary','Proof Secondary');
        $form->datetime('matchEnd_time','Match End Time');


        return $form;
    }


    public function test($id, $ed)
    {
        return $ed.' '.$id;
    }
}
