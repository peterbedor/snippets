<?php

namespace App\Models;

use Auth;

class Notification
{
	public static function markAsRead($notificationId)
	{
		Auth::user()
			->notifications()
			->where('id', $notificationId)
			->first()
			->markAsRead();

		return Auth::user()->unreadNotifications()->get();
	}

	public static function markAllAsRead()
	{
		$notifications = Auth::user()->unreadNotifications()->get();

		$notifications->each(function($notification) {
			$notification->markAsRead();
		});

		return [];
	}
}