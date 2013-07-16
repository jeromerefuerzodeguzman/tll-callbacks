<?php

class Create_Accounts_Table {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('accounts', function($table){
			$table->increments('id');
			$table->integer('user_id');
			$table->integer('type_id');
			$table->string('fname');
			$table->string('lname');
			$table->string('email');
			$table->timestamps();
		});	
	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('accounts');
	}

}