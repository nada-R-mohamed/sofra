<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOrdersTable extends Migration {

	public function up()
	{
		Schema::create('orders', function(Blueprint $table) {
			$table->increments('id');
			$table->mediumText('note')->nullable();
			$table->enum('status', array('pending', 'accepted', 'rejected', 'delivered', 'decliend'));
			$table->mediumText('address');
			$table->decimal('total_price', 8,2);
			$table->integer('payment_method_id')->unsigned()->nullable();
			$table->decimal('delivery_cost', 4,2);
			$table->decimal('commession', 8,2);
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('orders');
	}
}