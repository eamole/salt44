<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAuthors extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
		DB::table("authors")->
		insert(array(
			'name'=> 'JRR Tolken',
			'bio'=> 'This is his bio',
			'created_at'=> date('Y-m-d H:m:s'),
			'updated_at'=> date('Y-m-d H:m:s')
		
		));
		DB::table("authors")->
		insert(array(
			'name'=> 'Enid Blyton',
			'bio'=> 'This is her bio',
			'created_at'=> date('Y-m-d H:m:s'),
			'updated_at'=> date('Y-m-d H:m:s')
		
		));
	
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//
		DB::table("authors")->
		where('name','=','JRR Tolken')->
		delete();

		DB::table("authors")->
		where('name','=','Enid Blyton')->
		delete();
	}

}
