<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTherapists extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
		DB::table("therapists")->
		insert(array(
			'name'=> 'Morgan Carey',
			'phone'=> '0831 776655',
			'email'=> 'morgan.carey.fyp@gmail.com',
			'username'=> 'morgan',
			'password'=> 'carey01',
			'created_at'=> date('Y-m-d H:m:s'),
			'updated_at'=> date('Y-m-d H:m:s')
		
		));//
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//
		DB::table("therapists")->
		where('name','=','Morgan Carey')->
		delete();


	}

}
