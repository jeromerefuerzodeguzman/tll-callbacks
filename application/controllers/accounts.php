<?php

class Accounts_Controller extends Base_Controller {

	/**
	 * @var bool
	 */
	public $restful = true;
	

	public function __construct() {
		parent::__construct();
	}

	
	public function get_edit_view($id) {
		$account = Account::find($id);

		return View::make('accounts.edit')
				->with('account', $account);
	}

	public function post_delete() {

		$account = Account::find(Input::get('account_id'));
		$user = User::find($account->user_id);
		$account->delete();
		$user->delete();

		Redirect::to('manage_users')
				->with('message', 'Deleted');
	}
}	