<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRestaurantsTable extends Migration {

	public function up()
	{
		Schema::create('restaurants', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name');
			$table->string('email')->unique();
			$table->string('password');
			$table->integer('region_id')->unsigned()->nullable();
			$table->string('phone')->unique();
			$table->decimal('minimum_order', 4,2);
			$table->decimal('delivery_cost', 4,2);
			$table->string('contact_phone');
			$table->string('whatsapp')->unique();
			$table->string('image');
			$table->enum('status', array('open', 'closed'));
			$table->string('device_name');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('restaurants');
	}
}