<?php

/**
 * Account Status e.g. logged, details, etc..
 *
 */
class Status extends EKEApiController {

  /**
	 * Main method, automatically run
	 */
	public function run() {
    $this->response = USER_LOGGED
  		? $this->success('logged', [
        'id' => Session::get('id'),
        'email' => Session::get('email'),
        'created' => Session::get('created'),
      ])
  		: $this->ERR_NOT_LOGGED;
		return $this;
	}

}
