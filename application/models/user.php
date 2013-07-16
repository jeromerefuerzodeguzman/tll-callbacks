<?php

class User extends Eloquent {

	public function account() {
		return $this->has_one('Account');
	}

	public static function validate_login($data) {
		$rules = array(
			'username' => 'required|min:2',
			'password' => 'required|min:2'
		);

		return Validator::make($data,$rules);
	}

	public static function validate_new_user($data) {

		$rules = array(
			'new_username' => 'unique:users,username|required|min:2',
			'new_password' => 'required|min:2|confirmed',
			'new_password_confirmation' => 'required|min:2',
			'fname' => 'required|min:2',
			'lname' => 'required|min:2',
			'type_id' => 'required',
			'email' => 'unique:accounts,email|required|min:2'
		);
		return Validator::make($data,$rules);
	}

}