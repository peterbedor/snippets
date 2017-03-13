<?php

Auth::routes();

Route::get('logout', function() {
	Auth::logout();

	return redirect('/');
});

Route::get('/', 'SnippetsController@index');
Route::get('favorites', 'SnippetsController@favorites');

Route::get('settings', 'SettingsController@getHighlightThemes');
Route::post('settings/theme', 'SettingsController@theme');

Route::get('snippets/create', 'SnippetsController@create');
Route::get('snippets/{slug}', 'SnippetsController@show');

Route::post('snippets/{slug}/comments', 'CommentsController@store');
Route::delete('snippets/{slug}/comments', 'CommentsController@destroy');
Route::post('snippets/{slug}/comments/{id}/mentions', 'MentionsController@store');

Route::get('snippets/{slug}/file/{id}/raw', 'FilesController@raw');
Route::get('snippets/{slug}/file/{id}/download', 'FilesController@download');

Route::post('users/search', 'UsersController@search');
Route::get('users/list', 'UsersController@list');


Route::post('notifications', 'NotificationsController@markAsRead');
Route::get('notifications/unread', 'NotificationsController@unread');

Route::get('users/{username}', 'SnippetsController@user');
Route::get('users/{username}/favorites', 'SnippetsController@favorites');

Route::get('languages/{slug}', 'SnippetsController@language');

Route::post('likes', 'LikesController@like');
