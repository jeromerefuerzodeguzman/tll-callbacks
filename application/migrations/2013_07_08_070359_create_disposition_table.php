<?php

class Create_Disposition_Table {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('dispositions', function($table){
			$table->increments('id');
			$table->string('name');
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
		Schema::drop('dispositions');
	}

}