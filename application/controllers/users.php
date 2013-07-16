<?php

class Users_Controller extends Base_Controller {

	/**
	 * @var bool
	 */
	public $restful = true;

	

	public function __construct() {
		parent::__construct();
	}

	/**
	 * login view
	 * @return [type] [description]
	 */
	public function get_login() {
		return View::make('users.login');
	}

	/**
	 * logout
	 * @return [type] [description]
	 */
	public function get_logout() {
		Auth::logout();

		return Redirect::to('login');
	}

	//view for registration form
	public function get_registration() {

		//converts class to array in from dropdown
		$type_list_holder = Accounttype::get(array('id','name'));
		$type_list = parent::convert_to_array($type_list_holder);

		if(Account::is_supervisor(Auth::user()->id)) {
			return View::make('users.registration_form')
				->with('title', 'Add User')
				->with('type', $type_list);
		} else {
			return Redirect::to('login');
		}	
	}

	//login validation
	public function post_authenticate() {
		$validation = User::validate_login(Input::all());

		if($validation->fails()) {
			return  Redirect::to('login')->with_errors($validation)->with_input();
		} else {
			$credentials = array(
			  'username' => Input::get('username'),
			  'password' => Input::get('password')
			);
			
			if (Auth::attempt($credentials)) {
			   		//redirect to agents page
			   		return Redirect::to('dashboard');
			} else {
				return Redirect::to('login')
		            ->with('flash_error', 'Your username/password was incorrect.')
		            ->with_input();	
			}

		}
	}

	public function post_add_user() {
		$validation = User::validate_new_user(Input::all());

		if($validation->fails()) {
			return Redirect::to('registration')->with_errors($validation)->with_input();
		} else {
			$user = User::create(array(
					'username' => Input::get('new_username'),
					'password' => Hash::make(Input::get('new_password')),
					'created_at' => date('Y-m-d H:i:s'),
					'updated_at' => date('Y-m-d H:i:s')
				));

			Account::create(array(
					'user_id' => $user->id,
					'fname' => Input::get('fname'),
					'lname' => Input::get('lname'),
					'type_id' => Input::get('type_id'),
					'email' => Input::get('email'),
					'created_at' => date('Y-m-d H:i:s'),
					'updated_at' => date('Y-m-d H:i:s')
				));

			return Redirect::to('dashboard')
				->with('message', 'Succesfully created');
		}
	}

	public function get_profile() {
		$account = Account::find(Auth::user()->id);

		return View::make('users.profile')
				->with('account', $account)
				->with('title', '<img width="50px" src="' . URL::base() .' /img/user.jpg " /> ' . $account->fname . ' ' . $account->lname);
	}

	//view index page for admin
	public function get_manage_users() {

		$list = Account::where('accounts.user_id', '!=', Auth::user()->id)
					->order_by('updated_at','DESC')
					->get();


		if($list != NULL) {
			return View::make('users.manage_users')
			->with('accounts', $list)
			->with('title', 'Manage Users');
		} else {
			return Redirect::to('registration');
		}
			
	}


}	