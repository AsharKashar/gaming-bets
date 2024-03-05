<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSteamServerTokensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
//        Schema::create('dat_host_cs_go_servers', function (Blueprint $table) {
//            $table->id();
//
//            $table->boolean('confirmed')->default(false);
//            $table->string('dat_host_server_id')->nullable();
//            $table->string('name')->default('Banger Games');
//            $table->string('game')->default('csgo');
//            $table->string('autostop')->nullable();
//            $table->integer('autostop_minutes')->nullable();
//            $table->string('custom_domain')->nullable();
//            $table->string('enable_mysql')->default('true');
//            $table->string('location')->default('barcelona');
//            $table->json('scheduled_commands')->nullable();
//            $table->string('user_data')->nullable();
//            $table->json('csgo_settings')->nullable();
//
//            $table->unsignedBigInteger('steam_server_token_id');
//
//            $table->timestamps();
//        });
//
//        Schema::create('steam_server_tokens', function (Blueprint $table) {
//            $table->id();
//            $table->string('code')->unique();
//            $table->timestamps();
//
//            $table->unsignedBigInteger('game_id');
//            $table->foreign('game_id')->references('id')->on('games');
//
//            $table->unsignedBigInteger('dat_host_cs_go_server_id');
//            $table->foreign('dat_host_cs_go_server_id')->references('id')->on('dat_host_cs_go_servers');
//        });
//
//        Schema::table('dat_host_cs_go_servers', function (Blueprint $table) {
//            $table->foreign('steam_server_token_id')->references('id')->on('steam_server_tokens');
//        });
//
//
//        $csGameId = \App\Model\Game::firstWhere('tag', 'csgo')->id;
//        foreach ([
//            '33250F90D3F463D1B334483AA54425D5',
//            'E7A2BF697832949F7EC8BD9539FA2D54',
//            'D611F992731217623FB578D30F7034B5',
//            '93333C099977971014F6B84B37A8F35F',
//            '70032450E122AB7129FC53FDBAE84DD9',
//            '7C106E09E28603EB209433818B416837',
//            'C2F826CB6B5F098ED372FAE90E386051',
//            '7C619B7FC58FE33D074BD25B860649D5',
//            '18393F96B228113CE1A13E1F94FBC8F2',
//            'C90DD6C65D68BD29D8C645C8DC17B8AF',
//            'C1A65F16BF6BDFCEE23EE002A1FA4469',
//            '89BE8576481052658363B3FBD9E104D3',
//            'BF07751B9795339AE7496DEE7F9A9187',
//            '63F3CFFA2EC7229E625D9A4695000004',
//            'F651BCBC2979F46B4CDA7095C1697697',
//            '75734C1EDE8C0BA00796839F98BB5978',
//            '2D7EE0ECDC52D0FB919486DEE776D905',
//            'B96AC295BA2F165EA9C2524D5A4CFA1B',
//            'DAB49A82132BB220119A09A04099B87A',
//            'F44236CA0D70FC0268A2D0ED9E3AC8DF',
//            'BAE456DDBBC312AA0ED90AB2D8C603BC',
//            '10D96B5D2F7B61DE9F08A3CC0950B783',
//            'DFAFBD255C6D53CA02E504861D44DD7F',
//            'E9C864F505398190D80FDE82C584B563',
//            '62FA24100327DB247FBA34B706589033',
//            '4590F500AC324BCD5FA1928549756CE6',
//            'E9753EC61DBCCF77F7C9D5EA6B65415A',
//            'A0CCDDB73978C929754BC3E8BE1F93B9',
//            'BD322590CBC452C441880C8A9239AB08',
//            'C7610F75A011CE4FA5818B79F79763CC',
//            '46C89ACB2153DEB49DB01766174475D9',
//            'E106E3B9F61FAA6C63A34F0BA7944B28',
//            '92DE726EF7ADC39BE870A22B39E2F912',
//            '1EADFFBE186DE27472EA28D61F59E7E3',
//            'EE8F9670C26353F01F2888577CD96D17',
//                 ] as $code) {
//            \App\Model\SteamServerToken::updateOrInsert([
//                'code' => $code,
//                'game_id' => $csGameId,
//            ]);
//        }
    }

    /**
     * 29E2A1F0A3A7B0394C6F381955A564DB
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('steam_server_tokens');
    }
}
