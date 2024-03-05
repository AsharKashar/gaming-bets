<?php

namespace App\Observers\Dathost;


use App\Model\DatHost\CsGoServer;
use App\Model\DatHost\CsGoSettings;
use App\Model\SteamServerToken;
use App\Service\DatHostService;

class CsGoServerObserver
{
    public function created(CsGoServer $csGoServer)
    {
        $datHostService = new DatHostService();
        $config = [
            'game' => $csGoServer->game,
            'name' => $csGoServer->name,
        ];

        $csGoSettings = CsGoSettings::getDefaultSettings();
        foreach ($csGoSettings as $key => $value) {
            $config["csgo_settings.{$key}"] = $value;
        }

        $steamServerToken = SteamServerToken::firstWhere('code', $csGoSettings['steam_game_server_login_token']);

        $server_data = json_decode($datHostService->createGameServer($config));
        if ($datHostServerId = $server_data['id']) {
            $steamServerToken->update([
                'dat_host_cs_go_server_id' => $csGoServer->id
            ]);

            $csGoServer->update([
                'confirmed' => $server_data['confirmed'],
                'csgo_settings' => $server_data['csgo_settings'],
                'steam_server_token_id' => $steamServerToken->id,
                'dat_host_server_id' => $datHostServerId,

            ]);
        }
    }
}
