<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIsAdmin extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
		Schema::table('therapists' , function($table){
			$table->boolean('isAdmin');
		});
		DB::table('therapists')->insert(
			array(
				'name'=> 'admin',
				'phone'=> '',
				'email'=> '',
				'username'=> 'admin',
				'password'=> 'password',
				'created_at'=> date('Y-m-d H:m:s'),
				'updated_at'=> date('Y-m-d H:m:s'),
				'isAdmin' => true
		
			)
		);
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//
		
	}

}
