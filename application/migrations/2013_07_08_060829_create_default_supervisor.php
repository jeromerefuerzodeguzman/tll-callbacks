<?php

class Create_Default_Supervisor {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{

		$user = User::create(array(
					'username' => 'admin',
					'password' => Hash::make('admin'),
					'created_at' => date('Y-m-d H:i:s'),
					'updated_at' => date('Y-m-d H:i:s')
				));

			Account::create(array(
					'user_id' => $user->id,
					'type_id' => '1',
					'fname' => 'admin',
					'lname' => 'admin',
					'email' => 'admin@outsource2northstar.com',
					'created_at' => date('Y-m-d H:i:s'),
					'updated_at' => date('Y-m-d H:i:s')
				));

	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
		DB::table('accounts')->delete();
		DB::table('users')->delete();
	}

}