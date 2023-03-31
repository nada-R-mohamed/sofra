<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateNotificationsTable extends Migration {

	public function up()
	{
		Schema::create('notifications', function(Blueprint $table) {
			$table->increments('id');
			$table->morphs('notifiable');
			$table->string('title');
			$table->mediumText('content');
			$table->boolean('is_read')->default(0);
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('notifications');
	}
}