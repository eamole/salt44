<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddClients extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
		DB::table("clients")->
		insert(array(
			'name'		=> 'Morgan Carey',
			'phone'		=> '0831 776655',
			'email'		=> 'morgan.carey.fyp@gmail.com',
			'address'	=> '12 Haldene Estate, Donnybrook, Dougas, Cork',
			'pps' 		=> '7654321U/A',
			'dob' 	 	=> '2017-01-17',
			'therapist_id' => 1,
			'notes'  	=> 'Morgan suffers from a severe stammer.', 
			'username'	=> 'morgan',
			'password'	=> 'carey01',
			'created_at'=> date('Y-m-d H:m:s'),
			'updated_at'=> date('Y-m-d H:m:s')
		
		));////
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//
		DB::table("clients")->
		where('name','=','Morgan Carey')->
		delete();
	}

}
