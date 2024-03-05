<?php

use Illuminate\Database\Migrations\Migration;
use \App\Model\Status;

class UpdateTypeAndAddStatusToStatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $statuses = Status::where('group', Status::GROUPS['tournament'])->get();

       optional($statuses->firstWhere('type','up-comming'))->update(['name' => 'Upcoming', 'type' => Status::TOURNAMENT_TYPES['upcoming']]);
       optional($statuses->firstWhere('type','ready_to_start'))->update(['name' => 'Full', 'type' => Status::TOURNAMENT_TYPES['full']]);

        $statuses->each(function ($status) {
            if ($status->order >= 4) {
                $status->update([
                    'order' => $status->order + 1
                ]);
            }
        });

        Status::create([
            'name' => 'Finish registration',
            'group' => Status::GROUPS['tournament'],
            'type' => Status::TOURNAMENT_TYPES['finish_registration'],
            'order' => 4,
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $statuses = Status::where('group', Status::GROUPS['tournament'])->get();

        optional($statuses->firstWhere('type','upcoming'))->update(['name' => 'Up comming', 'type' => 'up-comming']);
        optional($statuses->firstWhere('type','full'))->update(['name' => 'Ready to start', 'type' => 'ready_to_start']);
        $statuses->firstWhere('type',  Status::TOURNAMENT_TYPES['finish_registration'])->delete();

        $statuses->each(function ($status) {
            if ($status->order >= 5) {
                $status->update([
                    'order' => $status->order - 1
                ]);
            }
        });
    }
}
