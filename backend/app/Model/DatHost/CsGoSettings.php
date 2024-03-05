<?php


namespace App\Model\DatHost;


use App\Model\SteamServerToken;

class CsGoSettings
{
    public static function getDefaultSettings()
    {
        $availableServerToken = SteamServerToken::firstWhere('dat_host_cs_go_server_id', 'IS EMPTY');
        return [
            'autoload_configs' => '', // json,
            'disable_bots' => 'true', // string
            'enable_csay_plugin' => 'true', // string
            'enable_gotv' => 'false', // string
            'enable_sourcemod' => 'true', // string
            'game_mode' => 'classic_competitive', // string, default: classic_competitive
            'insecure' => 'false', // string
            'mapgroup' => 'mg_active', // string
            'mapgroup_start_map' => 'de_dust2', // string
            'maps_source' => 'mapgroup', // default: mapgroup
            'password' => '', // server password
            'pure_server' => '', // string
            'rcon' => 'b4ngerg4m3s' . microtime(true), // string
            'slots' => 12, // integer, default: 12
            'sourcemod_admins' => '', // string
            'sourcemod_plugins' => '', // json list IDs
            'steam_game_server_login_token' => $availableServerToken->code, // string
            'tickrate' => 128, // 128
            'workshop_authkey' => '', // ""
            'workshop_id' => '', // ""
            'workshop_start_map_id' => '', // ""
        ];
    }


}
