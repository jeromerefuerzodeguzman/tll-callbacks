<?php

class Callback extends Eloquent {

	public function disposition() {
		return $this->belongs_to('Disposition');
	}

	public function account() {
		return $this->belongs_to('Account');
	}

	public static function validate_agent($data) {
		$rules = array(
			'account_id' => 'required'
		);
		return Validator::make($data,$rules);
	}

	public static function validate($data) {

		$rules = array(
			'date' => 'required|min:2',
			'company_name' => 'required|min:2',
			'telephone_number' => 'required|min:2',
			'contact_name' => 'required|min:2',
			'industry_name' => 'required|min:2',
			'disposition_id' => 'required',
			'comments' => 'required',
			'tags' => 'required'
		);
		return Validator::make($data,$rules);
	}

	public static function validate_update_callback($data) {

		$rules = array(
			'date' => 'required|min:2',
			'disposition_id' => 'required',
			'id' => 'required'
		);
		return Validator::make($data,$rules);
	}

	public static function validate_search($data) {

		$rules = array(
			'field' => 'required',
			'account_type' => 'required',
			'account_id' => 'required',
			'keyword' => 'required|min:2'
		);
		return Validator::make($data,$rules);
	}

	public static function disposition_list() {
		$list = DB::table('dispositions')
				->left_join('callbacks', 'callbacks.disposition_id', '=', 'dispositions.id')
				->select(array('dispositions.name', DB::raw('COUNT(tll_callbacks.disposition_id) as ctr')))
				->group_by('dispositions.name')
				->order_by('ctr', 'desc')
				->get();

		return $list;
	}

	public static function disposition_list_bydate($date) {
		$list =	DB::table('dispositions')
				->left_join('callbacks', 'callbacks.disposition_id', '=', 'dispositions.id')
				->select(array('dispositions.name', DB::raw('COUNT(tll_callbacks.disposition_id) as ctr')))
				->where('date', '=', $date)
				->group_by('dispositions.name')
				->order_by('ctr', 'desc')
				->get();


		return $list;
	}

	public static function agent_list() {
		$list = DB::table('callbacks')
				->join('dispositions', 'callbacks.disposition_id', '=', 'dispositions.id')
				->join('accounts', 'callbacks.account_id', '=', 'accounts.id')
				->join('users', 'accounts.user_id', '=', 'users.id')
				->select(array('accounts.id as account_id', 'users.username', 'dispositions.name', 'dispositions.id', DB::raw('COUNT(*) as ctr')))
				->group_by('users.username')
				->group_by('dispositions.name')
				->order_by('users.username', 'desc')
				->order_by('dispositions.id', 'asc')
				->get();

		return $list;
	}

	public static function agent_list_bydate($date) {
		$list = DB::table('callbacks')
				->join('dispositions', 'callbacks.disposition_id', '=', 'dispositions.id')
				->join('accounts', 'callbacks.account_id', '=', 'accounts.id')
				->join('users', 'accounts.user_id', '=', 'users.id')
				->select(array('accounts.id as account_id', 'users.username', 'dispositions.name', 'dispositions.id', DB::raw('COUNT(*) as ctr')))
				->where('date', '=', $date)
				->group_by('users.username')
				->group_by('dispositions.name')
				->order_by('users.username', 'desc')
				->order_by('dispositions.id', 'asc')
				->get();

		return $list;
	}


	public static function agent_account_id() {
		$list = DB::table('accounts')
				->join('users', 'accounts.user_id', '=', 'users.id')
				->join('accounttypes', 'accounttypes.id', '=', 'accounts.type_id')
				->select(array('accounts.id', 'users.username as name'))
				->where('accounttypes.name', '!=', 'supervisor')
				->group_by('users.username')
				->order_by('users.username')
				->get();

		return $list;
	}



	public static function unassigned_callbacks($id) {
		$affected = DB::table('callbacks')
    					->where('account_id', '=', $id)
  						->update(array('account_id' => '1'));

	}	


}