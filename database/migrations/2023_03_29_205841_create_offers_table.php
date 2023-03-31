<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOffersTable extends Migration {

	public function up()
	{
		Schema::create('offers', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name');
			$table->longText('description');
			$table->string('image');
			$table->integer('restaurant_id')->unsigned();
			$table->date('start_date');
			$table->date('end_date');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('offers');
	}
}