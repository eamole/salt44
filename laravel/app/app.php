<?php 


$isLoggedIn=false;
$isAdmin=false;
//does session have logged in
if(Session::has('isLoggedIn')){

	$isLoggedIn=Session::get('isLoggedIn');
	$isAdmin=Session::get('isAdmin');
}



/*
	this is a global function to render labels with a std html class
	need to find a better location for this function - somewhere that is loaded for every page 

	$name : the name of the element to attach the label to
	$test : the text to display 
 */
function myLabel($name, $text) {

	$tag = Form::label($name,$text,['class' => 'label']);

	return $tag;

}	
