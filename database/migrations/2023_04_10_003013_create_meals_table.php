<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMealsTable extends Migration {

	public function up()
	{
		Schema::create('meals', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name');
			$table->integer('restaurant_id')->unsigned();
			$table->time('time_to_prepare');
			$table->longText('description');
			$table->decimal('price', 8,2);
			$table->decimal('offer_price', 8,2);
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('meals');
	}
}