<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSettingsTable extends Migration {

	public function up()
	{
		Schema::create('settings', function(Blueprint $table) {
			$table->increments('id');
			$table->longText('about_app');
			$table->float('commission');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('settings');
	}
}