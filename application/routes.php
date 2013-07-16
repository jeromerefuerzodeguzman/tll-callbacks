<?php

//users
Route::any('login', array('uses' => 'users@login'));
Route::any('logout', array('uses' => 'users@logout'));
Route::post('users/authenticate', array('uses' => 'users@authenticate'));
Route::post('users/add_user', array('uses' => 'users@add_user'));
Route::any('registration', array('uses' => 'users@registration'));
Route::any('manage_users', array('uses' => 'users@manage_users'));
Route::any('edit_user/(:num)', array('uses' => 'accounts@edit_view'));
Route::post('delete_user', array('uses' => 'accounts@delete'));

//dashboard
Route::any('/', array('before' => 'auth', 'uses' => 'dashboard@index'));
Route::any('dashboard', array('before' => 'auth', 'uses' => 'dashboard@index'));

//callbacks
Route::any('create_callback', array('before' => 'auth', 'uses' => 'callbacks@index'));
Route::post('create_callback/add', array('uses' => 'callbacks@create'));
Route::get('view_callback/(:num)', array('uses' => 'callbacks@view'));
Route::post('transfer_callback', array('uses' => 'callbacks@transfer_callback'));

//ajax for company names autocomplete
Route::get('autocomplete_companyname', array('uses' => 'callbacks@companyname_list'));

//view by dispositions
Route::any('disposition_list', array('uses' => 'callbacks@disposition_list'));

//view by agent
Route::any('agent_list', array('uses' => 'callbacks@agent_list'));

//search
Route::any('search', array('uses' => 'callbacks@search'));
Route::post('search_callback', array('uses' => 'callbacks@search_callback'));

/*	
|--------------------------------------------------------------------------
| Application 404 & 500 Error Handlers
|--------------------------------------------------------------------------
|
| To centralize and simplify 404 handling, Laravel uses an awesome event
| system to retrieve the response. Feel free to modify this function to
| your tastes and the needs of your application.
|
| Similarly, we use an event to handle the display of 500 level errors
| within the application. These errors are fired when there is an
| uncaught exception thrown in the application. The exception object
| that is captured during execution is then passed to the 500 listener.
|
*/

Event::listen('404', function()
{
	return Response::error('404');
});

Event::listen('500', function($exception)
{
	return Response::error('500');
});

/*
|--------------------------------------------------------------------------
| Route Filters
|--------------------------------------------------------------------------
|
| Filters provide a convenient method for attaching functionality to your
| routes. The built-in before and after filters are called before and
| after every request to your application, and you may even create
| other filters that can be attached to individual routes.
|
| Let's walk through an example...
|
| First, define a filter:
|
|		Route::filter('filter', function()
|		{
|			return 'Filtered!';
|		});
|
| Next, attach the filter to a route:
|
|		Route::get('/', array('before' => 'filter', function()
|		{
|			return 'Hello World!';
|		}));
|
*/

Route::filter('before', function()
{
	// Do stuff before every request to your application...
});

Route::filter('after', function($response)
{
	// Do stuff after every request to your application...
});

Route::filter('csrf', function()
{
	if (Request::forged()) return Response::error('500');
});

Route::filter('auth', function()
{
	if (Auth::guest()) return Redirect::to('login')->with('error', 'Login first.');
});