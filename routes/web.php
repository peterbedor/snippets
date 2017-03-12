<?php

Auth::routes();

Route::get('/', 'SnippetsController@index');
Route::get('snippets/create', 'SnippetsController@create');
Route::get('snippets/{slug}', 'SnippetsController@show');

Route::post('snippets/{slug}/comments', 'CommentsController@store');

Route::get('snippets/{slug}/file/{id}/raw', 'FilesController@raw');
Route::get('snippets/{slug}/file/{id}/download', 'FilesController@download');

Route::post('users/search', 'UsersController@search');
Route::get('users/list', 'UsersController@list');

Route::post('snippets/{slug}/comments/{id}/mentions', 'MentionsController@store');

Route::post('notifications', 'NotificationsController@markAsRead');
Route::get('notifications/unread', 'NotificationsController@unread');

Route::post('likes', 'LikesController@like');
