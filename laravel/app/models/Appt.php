<?php

/*
	Eloquent ORM
	Easch class will return one record/object on request
*/
class Appt extends Eloquent {



	protected $fillable = array('id','name','phone','email','username','password','created_at','updated_at');	


	/*
		It appears I have to be explicit with the FK - L4 is making mistakes
		returning the wrong objects unless I explicitly state
	 */
	public function therapist() {
		return $this->hasOne('Therapist','id' , 'therapist_id' );
	}

	public function client() {
		return $this->hasOne('Client','id' , 'client_id' );
	}
}
