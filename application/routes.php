<?php

return array(

	/*
	|--------------------------------------------------------------------------
	| Application Routes
	|--------------------------------------------------------------------------
	|
	| Here is the public API of your application. To add functionality to your
	| application, you just add to the array located in this file.
	|
	| Simply tell Laravel the HTTP verbs and request URIs it should respond to.
	| You may respond to the GET, POST, PUT, or DELETE verbs. Enjoy the simplicity
	| and elegance of RESTful routing.
	|
	| Here is how to respond to a simple GET request to http://example.com/hello:
	|
	|		'GET /hello' => function()
	|		{
	|			return 'Hello World!';
	|		}
	|
	| You can even respond to more than one URI:
	|
	|		'GET /hello, GET /world' => function()
	|		{
	|			return 'Hello World!';
	|		}
	|
	| It's easy to allow URI wildcards using the (:num) or (:any) place-holders:
	|
	|		'GET /hello/(:any)' => function($name)
	|		{
	|			return "Welcome, $name.";
	|		}
	|
	*/

	'GET /' => function()
	{
		return View::make('layout/default')->partial('content', 'home.index');
	},
	
	'GET /supdawg' => function ()
	{
		return View::make('layout/default')->partial('content', 'sup');
	},

	/***
	 * Users / Registration
	 */
	
	'GET /register' => function () 
	{
		return View::make('layout/default')->partial('content', 'register');
	},
	
	'POST /register' => function () 
	{
		$post = Input::get();

		$user = new User();
		
		if ($user->validate_add($post)) {
			return Redirect::to('/login')->with('message', 'Account Created Successfully!');
		}
		else {
			return Redirect::to('/register');
		}
	},
	
	'GET /login' => array('name' => 'login', function () 
	{
		return View::make('layout/default')->partial('content', 'login');
	}),
	
	'POST /login' => function ()
	{
		if (Auth::login(Input::get('username'), Input::get('password')))
			return Redirect::to('/secret');
		else
			return Redirect::to('/login')->with('error', 'Login Failed');
	},
	
	'GET /logout' => function ()
	{
		Auth::logout();
		
		return Redirect::to('/');
	},
	
	'GET /secret' => array('before' => 'auth', function () {
		return View::make('layout/default')->partial('content', 'secret');
	}),

	/***
	 * REST Items
	 */

	 // index
	'GET /items' => function () {
		$items = Item::all();

		return View::make('layout/default')->partial('content', 'item.index', compact('items'));
	},

	// new
	'GET /items/new' => array('name' => 'item', function () {
		return View::make('layout/default')->partial('content', 'item.new');
	}),

	// create
	'POST /items' => array('before' => 'auth, csrf', function () {
		$post = Input::get();

		$item = new Item();

		if (!$item->validate($post)) {
			return Redirect::to('items/new');
		}

		$item->title = $post['title'];
		$item->content = htmlentities($post['content']);
		$item->user_id = Auth::user()->id;

		if ($item->save()) {
			return Redirect::to('items/'.$item->id);
		}
		else {
			return Redirect::to('items/new')->with('error', 'Unable to save item!');
		}
	}),

	// show
	'GET /items/(:num)' => function ($id) {
		$item = Item::find($id);

		return View::make('layout/default')->partial('content', 'item.item', array('item' => $item));
	},

	// edit
	'GET /items/(:num)/edit' => function ($id) {
		$item = Item::find($id);

		return View::make('layout/default')->partial('content', 'item.edit', array('item' => $item));
	},

	// update
	'PUT /items/(:num)' => array('before' => 'auth, csrf', function ($id) {
		$post = Input::get();
		$item = Item::find($id);
		
		if (Auth::user() != $item->user) {
			return Redirect::to('items')->with('error', 'You don\'t own that item.');
		}

		if (!$item->validate($post)) {
			return Redirect::to("items/$id/edit");
		}

		$item->title = $post['title'];
		$item->content = htmlentities($post['content']);

		if ($item->save()) {
			return Redirect::to("items/$id")->with('message', 'Item saved.');
		}
		else {
			return Redirect::to("items/$id/edit")->with('error', 'Unable to save item!');
		}
	}),

	// destroy
	'DELETE /items/(:num)' => array('before' => 'auth, csrf', function ($id) {
		$item = Item::find($id);

		if (Auth::user() != $item->user) {
			return Redirect::to('items')->with('error', 'You don\'t own that item.');
		}

		if ($item->delete()){
			return Redirect::to('items')->with('message', 'Item Deleted.');
		}
		else {
			return Redirect::to('items')->with('error', 'Failed to delete item!');
		}
	})
);
