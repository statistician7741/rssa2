<?php

//Event::listen('Phphub.Registration.Events.UserHasRegistered', function(){

   //dd('send email notification');
//});

# ------------------ Route patterns---------------------
Route::pattern('id', '[0-9]+');

# ------------------ Page Route ------------------------

Route::get('/', [
    'as' => 'home',
    'uses' => 'PagesController@home',
]);

Route::get('/about', [
    'as' => 'about',
    'uses' => 'PagesController@about',
]);

Route::get('/wiki', [
    'as' => 'wiki',
    'uses' => 'PagesController@wiki',
]);

Route::get('/search', [
    'as' => 'search',
    'uses' => 'PagesController@search',
]);

Route::get('/feed', [
    'as' => 'feed',
    'uses' => 'PagesController@feed',
]);

Route::get('/sitemap', 'PagesController@sitemap');
Route::get('/sitemap.xml', 'PagesController@sitemap');

# ------------------ User stuff ------------------------

Route::get('/users/{id}/replies', [
    'as' => 'users.replies',
    'uses' => 'UsersController@replies',
]);

Route::get('pageme/{fullname}', [
    'as' => 'pageme',
    'uses' => 'UsersController@pageMe',
]);


Route::get('/users/{id}/topics', [
    'as' => 'users.topics',
    'uses' => 'UsersController@topics',
]);

Route::get('/users/{id}/favorites', [
    'as' => 'users.favorites',
    'uses' => 'UsersController@favorites',
]);

Route::get('/users/{id}/refresh_cache', [
    'as' => 'users.refresh_cache',
    'uses' => 'UsersController@refreshCache',
]);

Route::post('/favorites/{id}', [
    'as' => 'favorites.createOrDelete',
    'uses' => 'FavoritesController@createOrDelete',
    'before' => 'auth',
]);

Route::get('/notifications', [
    'as' => 'notifications.index',
    'uses' => 'NotificationsController@index',
    'before' => 'auth',
]);

Route::get('/notifications/count', [
    'as' => 'notifications.count',
    'uses' => 'NotificationsController@count',
    'before' => 'auth',
]);

Route::post('/attentions/{id}', [
    'as' => 'attentions.createOrDelete',
    'uses' => 'AttentionsController@createOrDelete',
    'before' => 'auth',
]);

/**
 * Follows
 */
Route::post('follows', [
    'as' => 'follows_path',
    'uses' => 'FollowsController@store'
]);

Route::delete('follows/{id}', [
    'as' => 'follow_path',
    'uses' => 'FollowsController@destroy'
]);


# ------------------ Authentication ------------------------

Route::get('login', [
    'as' => 'login',
    'uses' => 'AuthController@login',
]);

Route::post('login', [
    'as' => 'login_path',
    'uses' => 'AuthController@store'
]);

Route::get('logout', [
    'as' => 'logout',
    'uses' => 'AuthController@logout'
]);


/*
 * Registration!
 */
Route::get('account/create', [
    'as' => 'register_path',
    'uses' => 'RegistrationController@create'
]);

Route::post('account/create', [
    'as' => 'register_path',
    'uses' => 'RegistrationController@store'
]);

Route::get('login-required', [
    'as' => 'login-required',
    'uses' => 'AuthController@loginRequired',
]);

Route::get('admin-required', [
    'as' => 'admin-required',
    'uses' => 'AuthController@adminRequired',
]);

Route::get('user-banned', [
    'as' => 'user-banned',
    'uses' => 'AuthController@userBanned',
]);

Route::get('oauth', 'AuthController@getOauth');

# ------------------ Resource Route ------------------------

Route::resource('nodes', 'NodesController', ['except' => ['index', 'edit']]);
Route::resource('topics', 'TopicsController');
Route::resource('votes', 'VotesController');
Route::resource('users', 'UsersController');
Route::resource('analysis', 'AnalysisController');
Route::resource('tableGenerator','TableGeneratorController');
Route::resource('fastDesk','TableGeneratorController@fastDesktopIndex');

# ------------------ Replies ------------------------

Route::resource('replies', 'RepliesController', ['only' => ['store']]);
Route::delete('replies/delete/{id}',  [
    'as' => 'replies.destroy',
    'uses' => 'RepliesController@destroy',
    'before' => 'auth',
]);

# ------------------ Votes ------------------------

Route::group(['before' => 'auth'], function () {
    Route::post('/topics/{id}/upvote', [
        'as' => 'topics.upvote',
        'uses' => 'TopicsController@upvote',
    ]);

    Route::post('/topics/{id}/downvote', [
        'as' => 'topics.downvote',
        'uses' => 'TopicsController@downvote',
    ]);

    Route::post('/replies/{id}/vote', [
        'as' => 'replies.vote',
        'uses' => 'RepliesController@vote',
    ]);

    Route::post('/topics/{id}/append', [
        'as' => 'topics.append',
        'uses' => 'TopicsController@append',
    ]);
});

# ------------------ Admin Route ------------------------

Route::group(['before' => 'manage_topics'], function () {
    Route::post('topics/recomend/{id}',  [
        'as' => 'topics.recomend',
        'uses' => 'TopicsController@recomend',
    ]);

    Route::post('topics/wiki/{id}',  [
        'as' => 'topics.wiki',
        'uses' => 'TopicsController@wiki',
    ]);

    Route::post('topics/pin/{id}',  [
        'as' => 'topics.pin',
        'uses' => 'TopicsController@pin',
    ]);

    Route::delete('topics/delete/{id}',  [
        'as' => 'topics.destroy',
        'uses' => 'TopicsController@destroy',
    ]);

    Route::post('topics/sink/{id}',  [
        'as' => 'topics.sink',
        'uses' => 'TopicsController@sink',
    ]);
});

Route::group(['before' => 'manage_users'], function () {
    Route::post('users/blocking/{id}',  [
        'as' => 'users.blocking',
        'uses' => 'UsersController@blocking',
    ]);
});

Route::post('upload_image', [
    'as' => 'upload_image',
    'uses' => 'TopicsController@uploadImage',
    'before' => 'auth',
]);

// Health Checking
Route::get('heartbeat', function () {
    return Node::first();
});

Route::get('/github-api-proxy/users/{username}', [
    'as' => 'users.github-api-proxy',
    'uses' => 'UsersController@githubApiProxy',
]);

Route::get('/github-card', [
    'as' => 'users.github-card',
    'uses' => 'UsersController@githubCard',
]);

/**
 * Password Resets
 */
Route::controller('password', 'RemindersController');

Route::group(['prefix' => 'messages'], function () {
    Route::get('/', ['as' => 'messages', 'uses' => 'MessagesController@index']);
    Route::get('create', ['as' => 'messages.create', 'uses' => 'MessagesController@create']);
    Route::post('/', ['as' => 'messages.store', 'uses' => 'MessagesController@store']);
    Route::get('{id}', ['as' => 'messages.show', 'uses' => 'MessagesController@show']);
    Route::put('{id}', ['as' => 'messages.update', 'uses' => 'MessagesController@update']);
});
