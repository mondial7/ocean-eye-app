<?php

/**
 * Password Recovery utility
 * TODO incomplete class
 */
class Recovery extends EKEApiController {

  /**
	 * Main method, automatically run
	 */
	public function run() {

		global $userLogged;

    //
    if ($userLogged) {
      $this->response = $this->ERROR;
      return $this;
    }

    // check parameters
		if (!isset($_POST['email'])) {
			$this->response = $this->ERR_BAD_REQUEST;
			return $this;
		}

		// TODO ...
		// TODO ...
		// TODO ...

		if ($this->credentials->recover('')) {
			$this->response = $this->STATUS_OK;
		} else {
			$this->response = $this->ERROR;
		}

		return $this;

  }

}
