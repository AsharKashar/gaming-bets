<?php

namespace App\Admin\Controllers;

use App\Helpers\FileHelper;
use App\Model\BoxMatches;
use App\Model\Game;
use App\Model\GamePlatform;
use App\Model\GameTypeBoxmatch;
use App\Model\Region;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Layout\Content;
use Illuminate\Routing\Controller;
use Encore\Admin\Grid;
use Encore\Admin\Form;
use Encore\Admin\Show;
use Encore\Admin\Widgets\Box;
use Encore\Admin\Widgets\Tab;
use Carbon\Carbon;
use URL;

class BoxMatcheAllsController extends Controller
{
    use HasResourceActions;

    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Box Match All';

    /**
     * Set description for following 4 action pages.
     *
     * @var array
     */
    protected $description = [
        //        'index'  => 'Index',
        //        'show'   => 'Show',
        //        'edit'   => 'Edit',
        //        'create' => 'Create',
    ];

    /**
     * Index interface.
     *
     * @param Content $content
     *
     * @return Content
     */
    public function index(Content $content)
    {
        return $content
            ->title("Box Matches")
            ->description("All box matches")
            ->body($this->grid());
    }

    /**
     * Show interface.
     *
     * @param mixed   $id
     * @param Content $content
     *
     * @return Content
     */
    public function show($id, Content $content)
    {
        return $content
            ->title("View All Box Matches")
            ->description("show all available box fights")
            ->body($this->detail($id))
            ->row($this->getToolsContent($id));
    }

    /**
     * Edit interface.
     *
     * @param mixed   $id
     * @param Content $content
     *
     * @return Content
     */
    public function edit($id, Content $content)
    {
        return $content
            ->title("test")
            ->description($this->description['edit'] ?? trans('admin.edit'))
            ->body($this->form()->edit($id))
            ->row($this->getToolsContent($id));
    }

    /**
     * Create interface.
     *
     * @param Content $content
     *
     * @return Content
     */
    public function create(Content $content)
    {
        return $content
            ->title($this->title())
            ->description($this->description['create'] ?? trans('admin.create'))
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
        $grid->disableCreateButton();
        $grid->disableRowSelector();
        $grid->column('id', __('Id'));
        $grid->column('boxmatch_name', __('Boxmatch name'));
        $grid->column('bid_amount', __('Bid amount'));
        $grid->game_type_boxmatch_id('Game Type')->display(function () {
            return GameTypeBoxmatch::find($this->game_type_boxmatch_id)->description;
        });
        $grid->platform('Platform')->display(function($data){
            return $data['name'];
        });
        $grid->region('Region')->display(function($data){
            return $data['name'];
        });

        $grid->column('status', __('Status'))->replace([1 => 'Joining in Progress', 2 => 'Match is Full', 3 => 'Match is Live', 4 => 'Match Ended', 5 => 'Match Finished', 6 => 'Match Cancelled']);
        $grid->column('conflict_flag', __('Conflict flag'));
        $grid->game('Game')->display(function($data){
            return $data['name'];
        });
        $grid->column('time', __('Time'));
        $grid->column('matchEnd_time', __('MatchEnd time'));
        $grid->actions(function ($actions) {
            $actions->disableDelete();
            $actions->disableEdit();
        });
        return $grid;
    }


    /**
     * Make a show builder.
     *
     * @param  mixed  $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(BoxMatches::findOrFail($id));
        $show->panel()
        ->tools(function ($tools) {
            $tools->disableEdit();
            // $tools->disableList();
            $tools->disableDelete();
        });
        $show->field('id', __('Id'));
        $show->field('boxmatch_name', __('Boxmatch name'));
        $show->field('bid_amount', __('Bid amount'));
        $show->platform_id()->as(function ($title) {
            return GamePlatform::find($title)->name;
        });
        $show->game_type_boxmatch_id()->as(function ($title) {
            return GameTypeBoxmatch::find($title)->description;
        });
        $show->region_id()->as(function ($title) {
            return Region::find($title)->name;
        });
        $show->status('Status')->replace([1 => 'Joining in Progress', 2 => 'Match is Full', 3 => 'Match is Live', 4 => 'Match Ended', 5 => 'Match Finished', 6 => 'Match Cancelled']);
        $show->game_id()->as(function ($title) {
            return Game::find($title)->name;
        });
        $show->field('time', __('Time'));
        $show->field('matchEnd_time', __('MatchEnd time'));



        $show->boxMatchUsers('Box Match Participants', function ($comments) {

            $comments->disableCreateButton();
            $comments->disableRowSelector();
            $comments->disableActions();
            $comments->model()->orderBy('team_id', 'ASC');
            $comments->user_id();
            $comments->username();
            $comments->column('team_id', 'Team');
            $comments->is_host()->replace([null => 'No', 1 => 'Yes']);
            $comments->result();



            $comments->filter(function ($filter) {
                $filter->like('content');
            });
        });

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

        $form->text('bid_amount', __('Bid amount'));
        $form->number('game_type_boxmatch_id', __('Game type boxmatch id'));
        $form->number('platform_id', __('Platform id'));
        $form->number('region_id', __('Region id'));
        $form->text('status', __('Status'));
        $form->text('conflict_flag', __('Conflict flag'));
        $form->text('game_id', __('Game id'));
        $form->datetime('time', __('Time'))->default(date('Y-m-d H:i:s'));
        $form->datetime('matchEnd_time', __('MatchEnd time'))->default(date('Y-m-d H:i:s'));
        $form->text('boxmatch_name', __('Boxmatch name'));

        return $form;
    }

    private function getToolsContent($id)
    {
        $demoTeams = new \Encore\Admin\Widgets\Form;
        $demoTeams->title = 'Delete Box Fight';
        $demoTeams->action("/admin/box-match/delete-match/$id");
        $demoTeams->method('GET');
        $demoTeams->html('Delete the box fight');
        $demoTeams->confirm('Are you sure?');
        $demoTeams->disableReset();

        $tabs = (new Tab)
        ->add('Delete', $demoTeams->render())
        ->render();

    return (new Box('Box Fight Actions', $tabs))
        ->collapsable()
        ->style('success')
        ->solid()
        ->render();
    }


    public function deleteMatchAdmin($id)
    {

        if (!BoxMatches::find($id)) {
            return response()->json(
                [
                    'message' => 'Not found'
                ],
                400
            );
        }
        // $test = BoxMatches::find($id);
        // $test->delete();
        BoxMatches::deleteMatch($id);
        return redirect("/admin/box-matches-all");
    }

}
