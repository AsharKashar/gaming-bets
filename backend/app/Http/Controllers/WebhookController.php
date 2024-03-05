<?php

namespace App\Http\Controllers;

use App\Model\Membership;
use Illuminate\Http\Request;

class WebhookController extends Controller
{
    //
    public function webhookCheck(request $event)
    {
        if($event->type == "subscription_schedule.canceled"){
            $membership = Membership::where('sub_id', $event->data['object']['id'])->first();
            if(!$membership){
                 return response()->json(
                    ['error' => 'Subscription not found'],
                    200
                );
            }
            $ret = Membership::deleteRecord($event->data['object']['id']);
        }
        if($ret){
            return response()->json(
                [
                    'message' => 'done',
                ],
                200
            );
        }

    }
}
