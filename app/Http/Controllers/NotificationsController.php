<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Auth;
use Illuminate\Http\Request;

class NotificationsController extends Controller
{
	/**
	 * Return a json object with all unread notifications
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function unread()
	{
		$notifications = Auth::user()->unreadNotifications()->get();

		return response()->json([
			'count' => count($notifications),
			'html' => view('partials.notifications.list', compact('notifications'))->render()
		]);
	}

	/**
	 * Mark notifications as read.  If no ID is supplied, we assume all
	 * notifications will be marked as read.
	 *
	 * @param Request $request
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function markAsRead(Request $request)
	{
		$id = $request->input('id', null);

		$unread = $id ?
			Notification::markAsRead($request->input('id')) :
			Notification::markAllAsRead();

		return response()->json([
			'message' => 'Success',
			'payload' => $unread
		]);
	}
}
