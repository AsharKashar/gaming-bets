<?php

namespace App\Admin\Controllers;

use App\Model\GlobalOptions;
use App\Model\Match;
use App\Model\MatchTeam;
use App\Model\Status;
use App\Model\Tournament;
use App\Model\User;
use Carbon\Carbon;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Encore\Admin\Layout\Content;
use Encore\Admin\Widgets\Box;
use Illuminate\Http\Request;

class MatchesController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Match';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Match());

        $grid->column('match_id', __('Match id'));
        $grid->column('title', __('Title'));
        $grid->status_id('Status')->display(function($statusId){
            return Status::find($statusId)->name;
        })->sortable();
        $grid->column('hosted_by','Hosted by')->display(function($userId){
            $user=User::find($userId);
            return $user ? '('.$user->id.') '.$user->name : 'Host is not defined';
        })->sortable();
        $grid->column('tournament_id','Tournament')->display(function($tournamentId){
            $tournament=Tournament::find($tournamentId);
            return '('.$tournament->id.') '.$tournament->name;
        })->sortable();
        $grid->column('round', __('Round'));
        $grid->column('start_at', __('Start at'));
        $grid->column('end_at', __('End at'));
        $grid->column('is_final', __('Is final'));

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
        $show = new Show(Match::findOrFail($id));

        $show->field('title', __('Title'));
        $show->field('status', __('Status'));
        $show->field('hosted_by', __('Hosted by'));
        $show->field('tournament_id', __('Tournament id'));
        $show->field('round', __('Round'));
        $show->field('start_at', __('Start at'));
        $show->field('end_at', __('End at'));
        $show->field('is_final', __('Is final'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        return $show;
    }

    /**
     * Edit interface.
     *
     * @param  mixed  $id
     * @param  Content  $content
     * @return Content
     */
    public function edit($id, Content $content)
    {
        return $content
            ->header('Edit')
            ->description('Edit Match')
            ->body($this->form($id)->edit($id))
            ->row($this->getTeamsContent($id));

    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form($matchId = null)
    {
        $tournaments = Tournament::all();
        $tournamentsOptions = [];
        $usersOptions = [];

        foreach ($tournaments as $tournament) {
            $tournamentsOptions[$tournament->id] = '('.$tournament->id.') '.$tournament->name;
        }
        $statuses = Status::where('group',Status::GROUPS['match'])->pluck('name','id');
        $form = new Form(new Match());

        $form->text('title', __('Title'));
        $form->select('status_id', 'Status')->options($statuses)->required();
        $form->datetime('start_at', 'Start at')->required()->default(Carbon::now());
        $form->datetime('end_at_min', 'End at(min)')->required()->default(Carbon::now())->required();
        $form->datetime('end_at_max', 'End at(max)')->required()->default(Carbon::now())->required();
        $form->select('tournament_id', 'Tournament')->options($tournamentsOptions)->required();

        if ($matchId === null) {
            $users = User::all();
        } else {
            $match =  Match::find($matchId);
            $users = $match? $match->players : [];
        }

        foreach ($users as $user) {
            $usersOptions[$user->id] = '('.$user->id.') '.$user->name;
        }

        $form->select('hosted_by', 'Hosted by')->options($usersOptions)->required();

        $form->number('round', __('Round'));
        $form->switch('is_final', __('Is final'));

        return $form;
    }

    private function getTeamsContent($id){
        $match = Match::find($id);
        $teams = $match->itemsMatchTeams()->with(['team','evidence'])->get();

        $data = [
            'teams' => $teams,
            'match' => $match
        ];

        return view('admin/form.app', ['components' => ['match-teams-editable'], 'data' => $data]);
    }

    public function setPlaces(Match $match, Request $request)
    {
        $places = $request->input('places');

        foreach ($places as $matchTeamId => $place) {
            MatchTeam::find($matchTeamId)->update([
                'place' => (int) $place
            ]);
        }

        $responseData = [
            'status' => 'success',
        ];

        return response()->json($responseData);
    }
}
