<?php

class BaseController extends Controller {

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}

	public function msg($msg) {

		$messages=Config::get('app.messages');
		Log::info($msg);
		$messages[]=$msg;
		Config::set('app.messages',$messages);
	}

}
