<?php

class Dashboard_Controller extends Base_Controller {

	public $restful = true;

	public function __construct() {
		parent::__construct();

		$this->filter('before', 'auth');
	}

	public function get_index() {
		if(Account::is_supervisor(Auth::user()->id)) {
			$callback_list = Callback::where('date', '>=', date('m/d/Y'))
									->where('disposition_id' , '!=', '4')
									->order_by('date', 'asc')
									->get();

			$ecallbacks_list =  Callback::where('date', '<', date('m/d/Y'))
									->where('disposition_id' , '!=', '4')
									->order_by('date', 'desc')
									->get();
		} else {
			$account_id = Account::find(Auth::user()->id);
			$callback_list = Callback::where('account_id' ,'=' , $account_id->id)
									->where('disposition_id' , '!=', '4')
									->where('date', '>=', date('m/d/Y'))
									->order_by('date', 'asc')
									->get();

			$ecallbacks_list =  Callback::where('account_id' ,'=' , $account_id->id)
									->where('disposition_id' , '!=', '4')
									->where('date', '<', date('m/d/Y'))
									->order_by('date', 'desc')
									->get();
		}


		return View::make('dashboard')
			->with('today', date('m/d/Y'))
			->with('ecallbacks', $ecallbacks_list)
			->with('callbacks', $callback_list);
	}
}