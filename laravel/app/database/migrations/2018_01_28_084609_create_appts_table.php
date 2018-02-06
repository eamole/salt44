<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApptsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
	 	Schema::create("appts",function($table){
		 	$table->increments("id");

		 	$table->integer("therapist_id")->unsigned();
		 	$table->foreign("therapist_id")->references('id')->on('therapists');

		 	$table->integer("client_id")->unsigned();
		 	$table->foreign("client_id")->references('id')->on('clients');

		 	$table->date("date");
		 	$table->time("start");
		 	$table->time("finish");

		 	$table->integer("attended")->nullable();
		 	$table->text("notes");
		 	$table->timestamps();

		 });//
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//
		Schema::drop("appts");//
	}

}
