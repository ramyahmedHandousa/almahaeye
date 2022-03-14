<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Api\MasterApiController;
use App\Http\Resources\Notification\NotificationModelResource;
use App\Support\Facade\Responder;
use App\traits\paginationTrait;
use Illuminate\Http\Request;

class NotificationController extends MasterApiController
{
    use paginationTrait;

    public function __construct()
    {
        parent::__construct();
        $this->middleware('auth:api');
    }

    public function __invoke(Request $request)
    {
        $notifications   = auth()->user()->notifications()->latest();

        $totalCount = $notifications->count();

        $this->pagination_query($request,$notifications);

        auth()->user()->unreadNotifications->markAsRead();

        return Responder::success(['total_count' => $totalCount,'data' => NotificationModelResource::collection($notifications->get())]);
    }
}
