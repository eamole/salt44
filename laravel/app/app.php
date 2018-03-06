<?php 

function displayApptTemplates() {
	$templates = array(
		"Initial Session" => "/initial_session_template",
		"Stutter" => "/stutter_treatment"

	);

	$html = "<div> ";
	foreach ($templates as $title => $template) {
		$html .= "<div class='label'>$title</div>";
	}
	$html .= "</div>";
	return $html;
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
function myLabel($name, $text) {

	$tag = Form::label($name,$text,['class' => 'label']);

	return $tag;

}	
