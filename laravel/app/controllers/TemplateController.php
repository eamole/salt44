<?php

class TemplatesController extends BaseController {

	/*
		a list of 'templates'
		this would be better done as an external file....maybe json
		each 'template' is avisible name, and a 'oath' to a template file...
		maybe assume a /app/views/templates folder
		this is a simulated table, with id as key
	 */
	private static $templates = array(
			'1' => ['title' => "Initial Session", 'url'  => "/initial_session_template" ],
			'2' => ['title' => "Stutter" , 'url' => "/stutter_treatment"]
			);
	/*
		need to accept the appointment ID to bind the buttons to the appointment
	 */
	public static function displayAll($apptId) {

		$html = "<span class='templates_bar'> ";
		foreach (self::$templates as $templateId => $template) {
			$html .= self::makeButton($apptId,$template['title'],$templateId);
			// $html .= "<div class='label'>$title</div>";
		}
		$html .= "</span>";
		return $html;
	}
	public static function makeButton($apptId,$title,$templateId) {
		// construct a link button to the template
		return HTML::linkAction(
				'TemplatesController@insertTemplate',
				$title , 
				array($apptId,$templateId), 
				['class' => 'button']
		);
	}

	public function insertTemplate($apptId,$templateId) {
		
		// load the appointment
		$appt=Appt::findOrFail($apptId);
		// load the template, pass appt in as scope/data
		$template = self::getTemplate($templateId,$appt);

		ApptsController::insertTemplate($apptId,$template);
		
		// reload the appt page
		return Redirect::route('apptEdit',array($apptId));

	}

	public static function getTemplate($templateId,$appt) {
		$template = self::$templates[$templateId];
		// should be able to pass data in to the template
		$view = View::make('templates.'.$template['url'],[
			'appt'=>$appt
			]);
		return $view;
	}


}