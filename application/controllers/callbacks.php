<?php

class Callbacks_Controller extends Base_Controller {

	public $restful = true;

	public function __construct() {
		parent::__construct();

	}

	public function get_index() {

		$disposition_list_holder = Disposition::get(array('id','name'));
		$disposition_list = parent::convert_to_array($disposition_list_holder);

		return View::make('callbacks.create')
			->with('disposition_id', $disposition_list);
	}

	public function post_create() {
		$validation = Callback::validate(Input::all());

		if($validation->fails()) {
			return  Redirect::to('create_callback')->with_errors($validation)->with_input();
		} else {
			$account_id = Account::find(Auth::user()->id);

			$callback = Callback::create(array(
					'account_id' => $account_id->id,
					'date' => Input::get('date'),
					'company_name' => Input::get('company_name'),
					'telephone_number' => Input::get('telephone_number'),
					'contact_name' => Input::get('contact_name'),
					'address' => Input::get('address'),
					'industry_name' => Input::get('industry_name'),
					'disposition_id' => Input::get('disposition_id'),
					'comments' => Input::get('comments'),
					'tags' => Input::get('tags'),
					'created_at' => date('Y-m-d H:i:s'),
					'updated_at' => date('Y-m-d H:i:s')
				));

			return Redirect::to('dashboard')
				->with('message', 'Succesfully created');
		}
	}

	public function get_companyname_list() {
		$list_holder = Callback::get(array('company_name'));
		$list = array();
		foreach ($list_holder as $company_list) {
			$list[] = $company_list->company_name;
		}	
		$unique_array = array_values(array_unique($list));
		return Response::json($unique_array);
	}

	public function get_disposition_list() {
		$list = Callback::disposition_list();
		$today = date('m/d/Y');
		$list_bydate = Callback::disposition_list_bydate($today);

		return View::make('callbacks.disposition_list')
			->with('today', $today)
			->with('lists_bydate', $list_bydate)
			->with('lists', $list);
		
	}


	public function post_disposition_list_bydate() {
		$list = Callback::disposition_list();
		$date = Input::get('date');
		$list_bydate = Callback::disposition_list_bydate($date);

		return View::make('callbacks.disposition_list')
			->with('today', $date)
			->with('lists_bydate', $list_bydate)
			->with('lists', $list);
	}
	

	public function get_agent_list() {
		$list = Callback::agent_list();
		$today = date('m/d/Y');
		$list_bydate = Callback::agent_list_bydate($today);

		return View::make('callbacks.agent_list')
			->with('today', $today)
			->with('lists_bydate', $list_bydate)
			->with('lists', $list);
	}

	public function post_agent_list_bydate() {
		$list = Callback::agent_list();
		$date = Input::get('date');
		$list_bydate = Callback::agent_list_bydate($date);

		return View::make('callbacks.agent_list')
			->with('today', $date)
			->with('lists_bydate', $list_bydate)
			->with('lists', $list);
	}

	public function get_view($id) {
		$callback = Callback::find($id);
		$users_holder = Callback::agent_account_id();
		$users = parent::convert_to_array($users_holder);

		$disposition_list_holder = Disposition::get(array('id','name'));
		$disposition_list = parent::convert_to_array($disposition_list_holder);


		return View::make('callbacks.view')
				->with('disposition_id', $disposition_list)
				->with('callback_id', $id)
				->with('users', $users)
				->with('callback', $callback);

	}

	public function get_search() {
		$field = array(
				'' => '',
				'company_name' => 'Company Name',
				'telephone_number' => 'Phone Number',
				'contact_name' => 'Contact Name',
				'tags' => 'Tags',
				'disposition' => 'Disposition'
			);
			return View::make('callbacks.search')
						->with('field', $field);
	}

	public function post_search_callback() {
		$field = array(
				'' => '',
				'company_name' => 'Company Name',
				'telephone_number' => 'Phone Number',
				'contact_name' => 'Contact Name',
				'tags' => 'Tags',
				'disposition' => 'Disposition'
			);
		$validation = Callback::validate_search(Input::all());

		if($validation->fails()) {
			return  Redirect::to('search')->with_errors($validation)->with_input();
		} else {
			if(Input::get('field') == 'disposition') {
				$searching_field = 'disposition_id';
				$search_keyword = Disposition::where('name', 'like', Input::get('keyword') . '%')->first();
				$keyword = $search_keyword->id;
			} else {
				$searching_field = Input::get('field');
				$keyword = Input::get('keyword');
			}

			if(Input::get('account_type') == 'agent') {
				$list = Callback::where($searching_field ,'like' , '%'. $keyword .'%')
								->where('account_id', '=', Input::get('account_id'))
								->get();
			} else {
				$list = Callback::where($searching_field ,'like' , '%'. $keyword .'%')->get();
			}
			

			return View::make('callbacks.search')
						->with('today', date('m/d/Y'))
						->with('list', $list)
						->with('field', $field);
		}
	}

	public function post_transfer_callback() {
		$validation = Callback::validate_agent(Input::all());

		if($validation->fails()) {
			return  Redirect::to('view_callback/'. Input::get('callback_id'))->with_errors($validation)->with_input();
		} else {
			$callback = Callback::find(Input::get('callback_id'));
			$callback->account_id = Input::get('account_id');
			$callback->timestamp();
			$callback->save();

			return Redirect::to('dashboard')
					->with('message', 'Callback Transfered');
		}
	}

	public function post_update() {
		$validation = Callback::validate_update_callback(Input::all());

		if($validation->fails()) {
			return  Redirect::to('view_callback/'. Input::get('id'))->with_errors($validation)->with_input();
		} else {
			var_dump(Input::all());
			$callback = Callback::find(Input::get('id'));
			$callback->disposition_id = Input::get('disposition_id');
			$callback->date = Input::get('date');
			$callback->timestamp();
			$callback->save();

			return Redirect::to('view_callback/'. Input::get('id'))
					->with('message', 'Callback Updated');
		}

	}


	public function get_agent_callbacks($id) {
		$list = Callback::where('account_id', '=', $id)
					->order_by('date', 'desc')
					->get();

		$agent = Account::find($id);

		return View::make('callbacks.agent_callbacks')
				->with('agent', $agent)
				->with('today', date('m/d/Y'))
				->with('callbacks', $list);

	}

}