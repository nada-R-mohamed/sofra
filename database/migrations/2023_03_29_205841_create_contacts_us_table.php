<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateContactsUsTable extends Migration {

	public function up()
	{
		Schema::create('contacts_us', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('name');
			$table->string('email');
			$table->string('phone');
			$table->longText('message');
			$table->tinyInteger('type_of_request');
		});
	}

	public function down()
	{
		Schema::drop('contacts_us');
	}
}