<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use \App\Model\Status;

class UpdateStatusColumnInStatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Status::firstWhere('type', 'full')) {
            Status::where('group', 'tournament')->where('order','>=', 3)->get()->map(function ($item) {
                $item->update([
                    'order' => $item->order + 1
                ]);
            });

            Status::create([
                'name' => 'Full',
                'type' => 'full',
                'group' => 'tournament',
                'order' => 3
            ]);
        }
    }
}
