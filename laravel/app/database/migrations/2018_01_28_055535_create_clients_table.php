<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
		 Schema::create("clients",function($table){
		 	$table->increments("id");
		 	$table->string("name");
		 	$table->string("phone");
		 	$table->string("email");
		 	$table->text("address");
		 	$table->string("pps");
		 	$table->date("dob");
		 	$table->integer("therapist_id")->unsigned();
		 	$table->foreign("therapist_id")->references('id')->on('therapists');
		 	$table->text("notes");
		 	$table->string("username");
		 	$table->string("password");
		 	$table->timestamps();

		 });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//
		Schema::drop("clients");
	}

}
