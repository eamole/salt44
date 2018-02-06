<?php

/*
	Eloquent ORM
	Easch class will return one record/object on request
*/
class Client extends Eloquent {

	protected $fillable = array('id','name','phone','email','username','password','created_at','updated_at');	


	public function therapist() {
		return $this->hasOne('Therapist','id','therapist_id');
	}

	public function appts() {
		return $this->hasMany('Appt','client_id' , 'id') ;
	}	
}
