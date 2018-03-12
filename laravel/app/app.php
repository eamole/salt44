<?php

function yesNo($bool) {
	return ($bool ? "Yes" : "No" );
}

/*
	don't know what namesapce this is in!!
 */
function msg($msg) {
	$myFile = "log.txt";
	$fh = fopen($myFile, 'a') or die("can't open file");
	fwrite($fh, $msg."\n");
	fclose($fh);	
}
function msgs() {
	if(file_exists("log.txt")) {
		$arr = file("log.txt");
		unlink("log.txt");
	} else {
		$arr = [];
	}
	return $arr;
}
function google_key(){
	return 'AIzaSyCDbA9xjzNl7GHZYWvCivfhDhEYM8cZoVI';
}  


function isLoggedIn() {
	return Session::has('user');

}
function isAdmin() {
	if(isLoggedIn()) {
		$user = Session::get('user');
		return $user->isAdmin;
	}
	return false;

}
function userId() {
	if(isLoggedIn()) {
		$user = Session::get('user');
		return $user->id;
	}
}
/*
	pass this to the reirect view using the withErrors() method
 */
function message($str) {

	$mb = new Illuminate\Support\MessageBag();
	$mb->add('message',$str);
	return $mb;
}
/*
	this is a global function to render labels with a std html class
	need to find a better location for this function - somewhere that is loaded for every page 

	$name : the name of the element to attach the label to
	$test : the text to display 
 */
function myLabel($name, $text , $attribs=null ) {

	if(is_null($attribs)) $attribs = [];
	$attribs = array_merge(['class' => 'label'] , $attribs );	// apply last to override

	$tag = Form::label($name,$text,$attribs);

	return $tag;

}	
