<?php

class Account extends Eloquent {

	public function user() {
		return $this->belongs_to('User');
	}

	public function type() {
		return $this->belongs_to('Accounttype');

	}

	public static function is_supervisor($id) {
		$user = User::find($id)->account;
		$is_supervisor = Accounttype::find($user->type_id);
		return ($is_supervisor->name == 'supervisor' ? true : false);
	}

}