<?php

namespace App\Admin\Controllers;

use App\Service\DatHostService;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Widgets\Form;
use Encore\Admin\Widgets\Table;
use Encore\Admin\Widgets\Box;
use Encore\Admin\Show;
use Encore\Admin\Layout\Content;
use Illuminate\Http\Request;


class DatHostController extends AdminController
{
    use HasResourceActions;

    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'DatHost Management';

    public function index(Content $content)
    {
        return $content
            ->header('DatHost Management')
            ->description('All Servers')
            ->row($this->account_info())
            ->row($this->create_server_btn())
            ->row($this->server_list());
    }

    public function create(Content $content)
    {
        return $content
            ->header('Create')
            ->description('Create Post')
            ->body($this->form());
    }

    /**
     * Make a grid builder.
     *
     * @return account_info
     */
    protected function account_info()
    {
        $datHostService = new DatHostService();
        $account_data = json_decode($datHostService->getAccountInfo());

        $content = '
        Balance : € '.number_format($account_data->credits, 2).' <br />
        Email : '.$account_data->email.' <br />
        ';


        $box = new Box('Account İnfo', $content);


        $box->style('info');

        $box->solid();

        return $box;
    }

    protected function create_server_btn()
    {
        return '<div style="margin:20px 0px;">
                <a href="/admin/dathost/create" class="btn btn-block btn-success btn-lg">Create New Server</a>
                </div>';
    }

    public function createServer(Request $request)
    {
        $datHostService = new DatHostService();
        $config = [
            'game' => $request->game,
            'name' => $request->name,
            'csgo_settings.game_mode' => $request->game_mode,
            'csgo_settings.rcon' => $request->rcon_password,
            'csgo_settings.slots' => $request->slots,
            'csgo_settings.steam_game_server_login_token' => '29E2A1F0A3A7B0394C6F381955A564DB'
        ];
        $server_data = json_decode($datHostService->createGameServer($config));

        $content = new Content();
        $box = new Box('Server Create', 'Server Created');
        $box->style('success');
        $box->solid();

        return $content
            ->header('Server Create')
            ->description('Server Create')
            ->row($box);
    }

    public function actionServer($action, $id, Request $request)
    {
        $content = new Content();

        $datHostService = new DatHostService();
        switch ($action) {
            case 'start':
                $data = json_decode($datHostService->startGameServer($id));

                $box = new Box('Server Start', 'Server Started');
                $box->style('success');
                $box->solid();

                return $content
                    ->header('Server Start')
                    ->description('Server ID:'.$id)
                    ->row($box);

                break;
            case 'stop':
                $data = json_decode($datHostService->stopGameServer($id));

                $box = new Box('Server Stop', 'Server Stopped');
                $box->style('danger');
                $box->solid();

                return $content
                    ->header('Server Stop')
                    ->description('Server ID:'.$id)
                    ->row($box);

                break;
            case 'delete':
                $data = json_decode($datHostService->deleteGameServer($id));

                $box = new Box('Server Delete', 'Server Deleted');
                $box->style('danger');
                $box->solid();

                return $content
                    ->header('Server Delete')
                    ->description('Server ID:'.$id)
                    ->row($box);

                break;
            case 'edit':
                return $this->editForm($id);
                break;
            case 'save':

                $data = [
                    'game' => $request->game,
                    'name' => $request->name,
                    'csgo_settings.game_mode' => $request->game_mode,
                    'csgo_settings.rcon' => $request->rcon_password,
                    'csgo_settings.slots' => $request->slots,
                ];

                $save = $datHostService->updateGameServerInfo($id, $data);

                $box = new Box('Server Edit', 'Server Saved');
                $box->style('success');
                $box->solid();

                return $content
                    ->header('Server Edit')
                    ->description('Server ID:'.$id)
                    ->row($box);

                break;
        }
        return $action.$id;
    }

    protected function editForm($id)
    {
        $content = new Content();
        $datHostService = new DatHostService();
        $serverDetail = json_decode($datHostService->getGameServerInfo($id));
        $form = new Form();
        $form->action('/admin/dathost/server/save/'.$id);
        $form->method('POST');
        $form->select('game', 'Game')
            ->options(
                [
                    'csgo' => 'CS:GO',
                    'mumble' => 'Mumble',
                    'teamfortress2' => 'Team Fortress 2',
                    'teamspeak3' => 'Team Speak 3'
                ]
            )
            ->value($serverDetail->game)
            ->default($serverDetail->game);
        $form->text('name', 'Name')->placeholder('Set Server Name')->value($serverDetail->name)->default(
            $serverDetail->name
        );

        $form->select('game_mode', 'Game Mode')->options(
            [
                'classic_competitive' => 'Classic Competitive',
                'classic_casual' => 'Classic Casual',
                'arms_race' => 'Arms Race',
                'demolition' => 'Demolition',
                'deathmatch' => 'Deathmatch',
                'custom' => 'Custom',
                'danger_zone' => 'Danger Zone',
                'wingman' => 'Wingman'
            ]
        )->value($serverDetail->csgo_settings->game_mode)->default($serverDetail->csgo_settings->game_mode);

        $form->text('rcon_password', 'Rcon Password')->placeholder('Set Rcon password')->value(
            $serverDetail->csgo_settings->rcon
        )->default($serverDetail->csgo_settings->rcon);

        $slots = [];
        for ($x = 5; $x <= 64; $x++) {
            $slots[$x] = $x;
        }
        $form->select('slots', 'Slots')->options($slots)->value($serverDetail->csgo_settings->slots)->default(
            $serverDetail->csgo_settings->slots
        );


        $box = new Box('Server Edit', $form->render());

        $box->style('success');

        $box->solid();

        return $content
            ->header('Server Edit')
            ->description('Server ID:'.$id)
            ->row($box);
    }

    /**
     * Make a grid builder.
     *
     * @return server_list
     */
    protected function server_list()
    {
        $datHostService = new DatHostService();

        $server_data = json_decode($datHostService->getGameServers());

        $rows = [];

        foreach ($server_data as $server) {
            if ($server->on) {
                $start = 'disabled';
                $stop = null;
            } else {
                $start = null;
                $stop = 'disabled';
            }
            $rows[] = [
                'name' => $server->name,
                'game' => $server->game,
                'ip_adress' => $server->raw_ip.':'.$server->ports->game,
                'slots' => $server->csgo_settings->slots,
                'players' => $server->players_online,
                'location' => $server->location,
                'go_tv_port' => $server->ports->gotv,
                'action' => '
                <a href="/admin/dathost/server/start/'.$server->id.'" class="btn btn-success btn-sm '.$start.'">Start</a>
                <a href="/admin/dathost/server/stop/'.$server->id.'" class="btn btn-danger btn-sm '.$stop.'">Stop</a>
                <a href="/admin/dathost/server/delete/'.$server->id.'" class="btn btn-warning btn-sm">Delete</a>
                <a href="/admin/dathost/server/edit/'.$server->id.'" class="btn btn-info btn-sm">Edit</a>
                ',
            ];
        }

        $headers = ['Name', 'Game', 'IP Adress', 'Slots', 'Active Players', 'Location', 'Go Tv Port', 'Action'];
        $styles = [
            'table',
            'table-responsive',
            'box-body'
        ];

        $table = new Table($headers, $rows, $styles);


        $box = new Box('Server List', $table->render());

        $box->style('primary');

        $box->solid();

        return $box;
    }

    /**
     * Make a show builder.
     *
     * @param  mixed  $id
     * @return Show
     */
    protected function detail($action)
    {
        // Detail
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form();

        $form->action('/admin/dathost/createServer');
        $form->method('POST');

        $form->select('game', 'Game')->options(
            [
                'csgo' => 'CS:GO',
                'mumble' => 'Mumble',
                'teamfortress2' => 'Team Fortress 2',
                'teamspeak3' => 'Team Speak 3'
            ]
        );

        $form->text('name', 'Name')->placeholder('Set Server Name');

        $form->select('game_mode', 'Game Mode')->options(
            [
                'classic_competitive' => 'Classic Competitive',
                'classic_casual' => 'Classic Casual',
                'arms_race' => 'Arms Race',
                'demolition' => 'Demolition',
                'deathmatch' => 'Deathmatch',
                'custom' => 'Custom',
                'danger_zone' => 'Danger Zone',
                'wingman' => 'Wingman'
            ]
        );

        $form->text('rcon_password', 'Rcon Password')->placeholder('Set Rcon password');

        $slots = [];
        for ($x = 5; $x <= 64; $x++) {
            $slots[$x] = $x;
        }
        $form->select('slots', 'Slots')->options($slots);


        $box = new Box('New Server Form', $form->render());

        $box->style('success');

        $box->solid();

        return $box;
    }
}
