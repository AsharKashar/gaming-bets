<?php

namespace App\Http\Controllers;

use App\Events\UserEvent;
use App\Model\Tournament;
use App\Model\UserNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;

/**
 * Class UserNotificationController
 * @package App\Http\Controllers
 */
class UserNotificationController extends Controller
{

    /**
     * @OA\Get(
     *     path="/api/notifications",
     *     tags={"notifications"},
     * @OA\Parameter(
     *     name="read",
     *     in="query",
     *     description="read or unread notifications (0/1)",
     *     required=false,
     *   ),
     * @OA\Parameter(
     *          name="types[]",
     *          description="Specific notification types",
     *          in="query",
     *          required=false,
     *          @OA\Schema(
     *              type="array",
     *              @OA\Items(type="string"),
     *          )
     *      ),
     * @OA\Parameter(
     *     name="from_date",
     *     in="query",
     *     description="Notifications for date rage (from date) (YYYY-MM-DD)",
     *     required=false
     *   ),
     * @OA\Parameter(
     *     name="to_date",
     *     in="query",
     *     description="Notifications for date rage (to date) (YYYY-MM-DD)",
     *     required=false
     *   ),
     * @OA\Parameter(
     *     name="per_page",
     *     in="query",
     *     description="Notifications per page (default 20)",
     *     required=false,
     *     @OA\Schema(
     *              type="number",
     *          )
     *   ),
     * @OA\Parameter(
     *     name="page",
     *     in="query",
     *     description="Notifications page",
     *     required=false,
     *     @OA\Schema(
     *              type="number",
     *          )
     *   ),
     * @OA\Parameter(
     *     name="to_date",
     *     in="query",
     *     description="Notifications for date rage (to date)",
     *     required=false
     *   ),
     *     @OA\Response(response="200", description="Get user's notifications"),
     *      security={
     *         {"query_token": {}}
     *     }
     * )
     */
    public function getUserNotifications(Request $request)
    {
        $read = $request->input('read');
        $types = $request->input('types');
        $fromDate = $request->input('from_date');
        $toDate = $request->input('to_date');
        $perPage = $request->input('per_page') ?? 20;

        $query = $request->user()->notifications();

        if ($read!=null) {
            $query = $query->where('read', $read);
        }

        if ($types) {
            $query->whereIn('reason', $types);
        }

        if ($fromDate && $toDate) {
            $fromDate = Carbon::parse($fromDate)->startOfDay();
            $toDate = Carbon::parse($toDate)->endOfDay();

            $query = $query->whereBetween('created_at', [$fromDate, $toDate]);
        } elseif ($fromDate) {
            $fromDate = Carbon::parse($fromDate)->startOfDay();
            $query = $query->whereDate('created_at', '>=', $fromDate);
        } elseif ($toDate) {
            $toDate = Carbon::parse($toDate)->endOfDay();
            $query = $query->whereDate('created_at', '<=', $toDate);
        }

        $query = $query->paginate($perPage);
        return $this->successApiResponse($query);
    }

    /**
     * @OA\Post(
     *     path="/api/notifications/read",
     *     tags={"notifications"},
     * @OA\Parameter(
     *          name="read_notifications_ids[]",
     *          description="Ids of read notifications",
     *          in="query",
     *          required=false,
     *          @OA\Schema(
     *              type="array",
     *              @OA\Items(type="number"),
     *          )
     *      ),
     *     @OA\Response(response="200", description="Mark selected notifications as read"),
     *      security={
     *         {"query_token": {}}
     *     }
     * )
     * @param  Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function readAllUserNotifications(Request $request)
    {
        $readNotificationsIds = $request->input('read_notifications_ids');
        $unreadNotifications = $request->user()->notifications();
        if ($readNotificationsIds) {
            $unreadNotifications = $unreadNotifications->whereIn('id', $readNotificationsIds)->get();
        } else {
            $unreadNotifications = $unreadNotifications->where('read', false)->get();
        }

        foreach ($unreadNotifications as $unreadNotification) {
            $unreadNotification->update(
                [
                    'read' => true
                ]
            );
        }

        $notifications = $request->user()->notifications()->paginate(200);

        return $this->successApiResponse($notifications);
    }


    /**
     * @OA\Get(
     *     path="/api/notifications/filters",
     *     tags={"notifications"},
     *     @OA\Response(response="200", description="Get notifications filters")
     * )
     */
    public function getNotificationFilters(){
        $data = [
            'notificationTypes' => array_values(UserNotification::$NOTIFICATION_REASON)
        ];

        return $this->successApiResponse($data);
    }

    public function getall($id)
    {
        $data = UserNotification::where('user_id', $id)->get();
        return $data;
    }

    public function send(request $request, $id)
    {
        $tournament = Tournament::find($request->tournament_id);
        $data = [
            'tournament' => $tournament? $tournament->toArray() : []
        ];

        $event = new UserEvent(UserNotification::$NOTIFICATION_REASON['join_tournament'], $data, $id);
        if (app()->isLocal()) {
            broadcast($event);
        }
        return response()->json(
            [
                'message' => 'done'
            ],
            200
        );
    }
}
