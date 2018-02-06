<?php

/*
	Eloquent ORM
	Easch class will return one record/object on request
*/
class Author  extends Eloquent {


	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	// protected $table = 'authors'; 	// authors is guessed by ORM
	protected $fillable = array('id','name','bio','created_at','updated_at');	// block updates to this attribute

}
