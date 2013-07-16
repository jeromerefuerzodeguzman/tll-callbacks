<?php

class Create_Callbacks_Table {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('callbacks', function($table){
			$table->increments('id');
			$table->integer('account_id');
			$table->string('date');
			$table->string('company_name');
			$table->string('telephone_number');
			$table->string('contact_name');
			$table->string('address');
			$table->string('industry_name');
			$table->string('disposition_id');
			$table->string('comments');
			$table->string('tags');
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
		Schema::drop('callbacks');
	}

}