<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateClientsTable extends Migration {

	public function up()
	{
		Schema::create('clients', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('region_id')->unsigned()->nullable();
			$table->string('name');
			$table->string('email')->unique();
			$table->string('phone')->unique();
			$table->string('password');
			$table->string('device_name');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('clients');
	}
}