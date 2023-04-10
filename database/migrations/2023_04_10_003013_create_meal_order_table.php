<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMealOrderTable extends Migration {

	public function up()
	{
		Schema::create('meal_order', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('meal_id')->unsigned();
			$table->integer('order_id')->unsigned();
			$table->decimal('price', 8,2);
			$table->integer('quantity');
			$table->mediumText('special_request')->nullable();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('meal_order');
	}
}