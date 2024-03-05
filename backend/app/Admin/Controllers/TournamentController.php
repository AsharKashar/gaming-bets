<?php

namespace App\Admin\Controllers;

use App\Admin\Actions\Tournaments\BatchRandomWinner;
use App\Admin\Actions\Tournaments\CancelMatch;
use App\Admin\Actions\Tournaments\DisqualifyTeam;
use App\Admin\Actions\Tournaments\EditMatch;
use App\Admin\Actions\Tournaments\RandomWinner;
use App\Helpers\FileHelper;
use App\Model\EntryFee;
use App\Model\Frequency;
use App\Model\Game;
use App\Http\Controllers\Controller;
use App\Model\GameMode;
use App\Model\GameType;
use App\Model\GlobalOptions;
use App\Model\Locale;
use App\Model\Match;
use App\Model\MatchTeam;
use App\Model\Region;
use App\Model\Status;
use App\Model\GamePlatform;
use App\Model\Team;
use App\Model\TeamTournament;
use App\Model\Tournament;
use App\Model\TournamentOptions;
use App\Model\TournamentPrize;
use App\Model\TournamentSize;
use App\Model\User;
use Carbon\Carbon;
use DB;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;
use Encore\Admin\Widgets\Box;
use Encore\Admin\Widgets\Tab;

class TournamentController extends Controller
{
    use HasResourceActions;

    /**
     * Index interface.
     *
     * @param  Content  $content
     * @return Content
     */
    public function index(Content $content)
    {
        return $content
            ->header('Tournament List')
            ->description('All Tournaments')
            ->body($this->grid());
    }

    /**
     * Show interface.
     *
     * @param  mixed  $id
     * @param  Content  $content
     * @return Content
     */
    public function show($id, Content $content)
    {
        return $content
            ->header('Tournament Detail')
            ->description('Details')
            ->body($this->detail($id));
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
            ->description('Edit Tournament')
            ->row($this->getStructureContent($id))
            ->row($this->getParticipantsContent($id))
            ->row($this->getToolsContent($id))
            ->body($this->form($id)->edit($id))
            ->row($this->getTournamentOptionsContent($id))
            ->row($this->getTournamentPrizesContent($id));
    }

    private function getStructureContent($id)
    {
        $tournamentMatches = Match::where('tournament_id', $id)->get();
        $rounds = [];
        foreach ($tournamentMatches as $match) {
            $rounds[$match->round][] = $match;
        }

        $tab = new Tab();
        foreach ($rounds as $round => $matches) {
            $roundGrid = new Grid(new Match());
            $roundGrid->model()->where('tournament_id', $id)->where('round', $round);
            $roundGrid->disableCreateButton();
            $roundGrid->disableExport();
            $roundGrid->disableFilter();

            $roundGrid->column('start_at', 'Start at')->display(function ($date) {
                return $date ? Carbon::createFromDate($date)->format('Y-m-d H:i:s') : '-';
            });
            $roundGrid->column('end_at', 'End at')->display(function ($date) {
                return $date ? Carbon::createFromDate($date)->format('Y-m-d H:i:s') : '-';
            });
            $roundGrid->title('Title');
            $roundGrid->column('matchTeams')->display(function ($teams) {
                return implode(',', array_map(function ($team) {
                    return '<a href="'.admin_url("/team/{$team['team_id']}/edit").'" target="_blank">'.Team::find($team['team_id'])->name.'</a> ';
                }, $teams));
            });
            $roundGrid->column('winner')->display(function ($winner) {
                if (!$winner) {
                    return '-';
                }
                $team = Team::find(array_first($winner)['team_id']);
                return '<a href="'.admin_url("/team/{$team->team_id}/edit").'" target="_blank">'.Team::find($team->team_id)->name.'</a> ';
            });
            $roundGrid->column('status')->display(function($status) {
                return $status['name'];
            });

            $roundGrid->actions(function ($actions) {
                $actions->disableDelete();
                $actions->disableEdit();
                $actions->disableView();
                $actions->add(new CancelMatch());
                $actions->add(new EditMatch());
                $actions->add(new RandomWinner());
            });
            $roundGrid->batchActions(function ($actions) {
//                $actions->disableDelete();
//                $actions->add(new CancelMatch());
//                $actions->add(new EditMatch());
                $actions->add(new BatchRandomWinner());
            });
            $tab->add("Round {$round}", $roundGrid->render());
        }

        return (new Box('Structure', $tab->render()))
            ->collapsable()
            ->style('info')
            ->solid()
            ->render();
    }

    private function getParticipantsContent($id)
    {
        $grid = new Grid(new TeamTournament());
        $grid->disableBatchActions();
        $grid->disableTools();
        $grid->disableCreateButton();
        $grid->disableExport();
        $grid->disableFilter();
        $grid->model()->where('is_valid', 1)->where('tournament_id', $id);
        $grid->column('team_id', 'Team name')->display(function ($team_id) {
            return '<a href="'.admin_url("/teams/{$team_id}/edit").'" target="_blank">'.Team::find($team_id)->name.'</a> ';
        });
        $grid->column('tournamentUsers')->display(function ($users) {
            return implode(',', array_map(function ($user) {
                return '<a href="'.admin_url("/user/{$user['user_id']}/edit").'" target="_blank">'.User::find($user['user_id'])->name.'</a> ';
            }, $users));
        });
        $grid->actions(function ($actions) {
            $actions->disableDelete();
            $actions->disableEdit();
            $actions->disableView();
            $actions->add(new DisqualifyTeam());
        });


        return (new Box('Participants', $grid->render()))
            ->style('warning')
            ->solid()
            ->render();
    }

    private function getTournamentOptionsContent($id){

        $tournamentOptions = TournamentOptions::where('tournament_id', $id)->with('locale')->get();

        $locale = Locale::all();

        $data = [
            'locales' => $locale,
            'tournamentOptions' => $tournamentOptions,
            'tournamentId' => $id,
        ];

        return view('admin/form.app', ['components' => ['tournament-options'], 'data' => $data]);
    }

    private function getTournamentPrizesContent($id)
    {
        $grid = new Grid(new TournamentPrize());
        $grid->disableBatchActions();
        $grid->disableTools();
        $grid->disableCreateButton();
        $grid->disableExport();
        $grid->disableFilter();
        $grid->model()->where('tournament_id', $id)->orderBy('position', 'asc');
        $grid->position()->number();
        $grid->prize()->label();
        $grid->team('Winner team')->display(function ($team) {
            return $team ? $team['name'] : 'not rewarded yet';
        });

        $grid->actions(function ($actions) {
            $actions->disableDelete();
            $actions->disableEdit();
            $actions->disableView();
        });

        return (new Box('Tournament prizes', $grid->render()))
            ->style('success')
            ->solid()
            ->render();
    }

    private function getToolsContent($id)
    {
        $demoTeams = new \Encore\Admin\Widgets\Form;
        $demoTeams->title = 'Add demo teams';
        $demoTeams->action("/admin/tournament-tools/add-demo-teams/$id");
        $demoTeams->method('POST');
        $demoTeams->html('It works only when tournament status is "registration"');
        $demoTeams->number('teamCount', 'How many teams?')->default('8');
        $demoTeams->confirm('Are you sure?');
        $demoTeams->disableReset();


        $demoPlayers = new \Encore\Admin\Widgets\Form;
        $demoPlayers->title = 'Add demo players';
        $demoPlayers->action("/admin/tournament-tools/add-demo-players/$id");
        $demoPlayers->method('POST');
        $demoPlayers->number('playerCount', 'Player count')->default('5');
        $demoPlayers->confirm('Are you sure?');
        $demoPlayers->disableReset();
        $demoPlayers->disableSubmit();

        $endRegistration = new \Encore\Admin\Widgets\Form;
        $endRegistration->title = 'End registration';
        $endRegistration->action("/admin/tournament-tools/end-registration/$id");
        $endRegistration->html('This will end registration and trigger the next flow: bracket generation, send refunds, notifications, etc..');
        $endRegistration->datetime('reg_end_at', 'Registration end date (UTC)')->default(Carbon::now());
        $endRegistration->method('GET');
        $endRegistration->confirm('Are you sure?');
        $endRegistration->disableReset();

        $startRegistration = new \Encore\Admin\Widgets\Form;
        $startRegistration->title = 'Start registration';
        $startRegistration->action("/admin/tournament-tools/start-registration/$id");
        $startRegistration->html('This will start registration.');
        $startRegistration->datetime('reg_start_at', 'Registration start date (UTC)')->default(Carbon::now());
        $startRegistration->method('GET');
        $startRegistration->confirm('Are you sure?');
        $startRegistration->disableReset();

        $prepareStructure = new \Encore\Admin\Widgets\Form;
        $prepareStructure->title = 'Prepare Structure';
        $prepareStructure->action("/admin/tournament-tools/prepare-structure/$id");
        $prepareStructure->html('This button will delete all created rounds and matches. No notifications or refunds, only for test purposes.');
        $prepareStructure->method('GET');
        $prepareStructure->confirm('Are you sure?');
        $prepareStructure->disableReset();


        $tabs = (new Tab)
            ->add('Actions',
                $endRegistration->render().
                $startRegistration->render().
                $prepareStructure->render()
                , true)
            ->add('Join demo teams', $demoTeams->render())
            ->add('Join demo players', $demoPlayers->render())
            ->render();

        return (new Box('Tournament Tools', $tabs))
            ->collapsable()
            ->style('success')
            ->solid()
            ->render();
    }

    /**
     * Create interface.
     *
     * @param  Content  $content
     * @return Content
     */
    public function create(Content $content)
    {
        return $content
            ->header('Create')
            ->description('Create Tournament')
            ->body($this->form());
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Tournament());
        $grid->model()->orderBy('start_at', 'DESC');
        $grid->id('ID')->sortable();
        $grid->name('Name')->editable();
        $grid->status('Status')->display(function ($status) {
            return $status['name'];
        })->sortable();
        $grid->column('reg_start_at', 'Reg start at')->date('Y-m-d H:i')->display(function ($date) {
            $color = $date > now() ? 'green' : 'red';
            return "<p style=\"color: $color\">$date</p>";
        })->sortable();
        $grid->column('reg_end_at', 'Reg end at')->date('Y-m-d H:i')->display(function ($date) {
            $color = $date > now() ? 'green' : 'red';
            return "<p style=\"color: $color\">$date</p>";
        })->sortable();
        $grid->column('start_at', 'Start at')->date('Y-m-d H:i')->display(function ($date) {
            $color = $date > now() ? 'green' : 'red';
            return "<p style=\"color: $color\">$date</p>";
        })->sortable();
        $grid->column('end_at', 'End at')->date('Y-m-d H:i')->display(function ($date) {
            $color = $date > now() ? 'green' : 'red';
            return "<p style=\"color: $color\">$date</p>";
        })->sortable();

        $grid->paginate(20);
        $grid->disableExport();
        $grid->disableColumnSelector();

        $grid->filter(function ($filter) {
            $tournamentStatuses = Status::where('group', 'tournament')->orderBy('order')->pluck('name', 'id');
            // Remove the default id filter
//            $filter->disableIdFilter();

            // Add a column filter
            $filter->like('name', 'Name');
            $filter->equal('status_id', 'Status')->select($tournamentStatuses);
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
        $show = new Show(Tournament::findOrFail($id));

        $show->id('ID');
        $show->name('Name');
        $show->description('Description');
        $show->overview('Overview');
        $show->image('Image')->image();
        $show->hosted_by('Hosted by');
        $show->tournamentSizeItem('Tournament size', function ($tournamentSize) {
            $tournamentSize->players_count();
        });
        $show->entryFeeItem('Entry fee', function ($entryFee) {
            $entryFee->fee();
        });
        $show->status('Status', function ($status) {
            $status->name();
        });
        $show->frequency('Repeat', function ($frequency) {
            $frequency->name();
        });
        $show->game('Game', function ($game) {
            $game->name();
        });
        $show->gameMode('Game Mode', function ($gameMode) {
            $gameMode->name();
        });
        $show->gameType('Game Type', function ($gameType) {
            $gameType->name();
        });
        $show->reg_start_at('Registration start at');
        $show->reg_end_at('Registration end at');
        $show->featured('Featured');
        $show->start_at('Start at');
        $show->end_at('End at');
        $show->created_at('Created at');
        $show->updated_at('Updated at');
        $show->prizes('Game Type', function ($prizes) {
            $prizes->position();
            $prizes->team_id();
            $prizes->prize();
        });

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form($tournamentId = null)
    {
        $form = new Form(new Tournament());
        $tournamentStatuses = Status::where('group', 'tournament')->orderBy('order')->pluck('name', 'id');
        $tournamentsFrequency = Frequency::all()->pluck('name', 'id');
        $games = Game::all()->pluck('name', 'id');
        $gameMode = GameMode::all();
        $gameType = GameType::with('teamSize')->get();
        $tournamentSizes = TournamentSize::all();
        $entryFee = EntryFee::all()->pluck('fee', 'id');

        $form->text('name', 'Name')->required();
        $form->tmeditor('description', 'Description');
        $form->textarea('overview', 'Overview');
        $form->select('status_id', 'Status')->options($tournamentStatuses)->required();
        $form->select('frequency_id', 'Heild on')->options($tournamentsFrequency)->required();
        if ($tournamentId === null) {
            $form->select('game_id', 'Game')->options($games)->required();
            $form->html("
            <script>
            $(document).ready(() => {
                const gameModeWrap = $('[for=game_mode_id]').closest('.form-group');
                const gameTypeWrap = $('[for=game_type_id]').closest('.form-group');
                const tournamentSizeWrap = $('[for=tournament_size_id]').closest('.form-group');
                const gameModeId = $('select[name=game_mode_id]');
                const gameTypeId = $('select[name=game_type_id]');
                const tournamentSizeId = $('select[name=tournament_size_id]');
                const gameMode = ".json_encode($gameMode).";
                const gameType = ".json_encode($gameType).";
                const tournamentSize = ".json_encode($tournamentSizes).";
                const createOptions = (arr, appendTo) => {
                    appendTo.html('');
                    $('<option/>', {
                            value: '',
                    }).appendTo(appendTo);
                    arr.map(el => {
                        $('<option/>', {
                            value: el.id,
                            text: el.name || el.players_count,
                        }).appendTo(appendTo);
                    })
                }
                gameModeWrap.hide();
                gameTypeWrap.hide();
                tournamentSizeWrap.hide();

                    $('[name=game_id]').on('change', function (){
                        if($(this).val()){
                            const arr = gameMode.filter(({game_id}) => game_id === +$(this).val());
                            const arr2 = tournamentSize.filter(({game_id}) => game_id === +$(this).val());

                            createOptions(arr, gameModeId);
                            createOptions(arr2, tournamentSizeId);

                            gameModeWrap.slideDown();
                            tournamentSizeWrap.slideDown();
                            return;
                        }
                        gameModeWrap.hide();
                        tournamentSizeWrap.hide();
                    })
                    gameModeId.on('change', function (){
                           if($(this).val()){
                                const arr = gameType.filter(({game_mode_id, team_size}) => game_mode_id === +$(this).val() && team_size.size === 5);
                                createOptions(arr, gameTypeId);
                                gameTypeWrap.slideDown();
                                return;
                           }
                           gameTypeWrap.hide();
                    })
             });
            </script>
        ");
            $form->select('game_mode_id', 'Game mode')->options([])->required();
            $form->select('game_type_id', 'Game Type')->options([])->required();
            $form->select('tournament_size_id', 'Players count in tournament')->options([])->required();
        } else {
            $tournament = Tournament::find($tournamentId);
            $gameTypes = $tournament->gameMode->gameTypes->pluck('name', 'id')->toArray();
            $gameModes = $tournament->game->gameModes->pluck('name', 'id')->toArray();
            $tournamentSizes = $tournament->game->tournamentSizes->pluck('players_count', 'id')->toArray();

            $form->select('game_id', 'Game')->options($games)->disable();
            $form->select('game_mode_id', 'Game mode')->options($gameModes)->disable();
            $form->select('game_type_id', 'Game Type')->options($gameTypes)->disable();
            $form->select('tournament_size_id', 'Players count in tournament')->options($tournamentSizes)->disable();

            $form->html("
            <script>
                            $('input[name=game_mode_id]').val(".$tournament->game_mode_id.");
                            $('input[name=game_type_id]').val(".$tournament->game_type_id.");
                            $('input[name=game_id]').val(".$tournament->game_id.");
                            $('input[name=tournament_size_id]').val(".$tournament->tournament_size_id.");

            </script>
            ");
        }


        $form->select('entry_fee_id', 'Entry Fee')->options($entryFee)->required();

        $form->datetime('reg_start_at', 'Reg Start at')->required()->default(Carbon::now());
        $form->datetime('reg_end_at', 'Reg End at')->required()->default(Carbon::now());

        $form->datetime('start_at', 'Start at')->required()->default(Carbon::now());
        $form->datetime('end_at', 'End at')->required()->default(Carbon::now());

        $filename = '';
        if ($newFile = request()->image) {
            $filename = FileHelper::formatFileName($newFile, true);
        }

        $form->image('image', __('Image'))->move('tournaments', "$filename")->removable()->required();

        $form->text('hosted_by', 'Hosted By')->required();
        $form->text('check_in', 'Check In')->default(0);
        $form->text('kickoff_in', 'Kick Off In')->default(0);
        $states = [
            'on' => ['value' => 1, 'text' => 'Yes', 'color' => 'success'],
            'off' => ['value' => 0, 'text' => 'No', 'color' => 'danger'],
        ];

        $form->switch('featured', 'Featured')->states($states)->default(0);

        $form->multipleSelect('platforms', 'Platforms')->options(GamePlatform::all()->pluck('name', 'id'));
        $form->multipleSelect('regions', 'Regions')->options(Region::all()->pluck('name', 'id'));


        $form->datetime('created_at', 'Created at');
        $form->datetime('updated_at', 'Updated at');
        return $form;
    }
}
