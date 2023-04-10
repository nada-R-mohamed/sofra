<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePaymentsTable extends Migration {

	public function up()
	{
		Schema::create('payments', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('restaurant_id')->unsigned()->nullable();
			$table->mediumText('note')->nullable();
			$table->date('date');
			$table->decimal('price', 8,2);
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('payments');
	}
}