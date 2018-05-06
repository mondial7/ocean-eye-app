<?php

/**
 * Update user username
 * NOTE -> not used anymore, see: account/update.php
 * TODO delete this
 */
class Username extends EKEApiController {

  /**
	 * Main method, automatically run
	 */
	public function run() {

		global $userLogged;

    if (!$userLogged) {
      $this->response = $this->ERR_NOT_LOGGED;
      return $this;
    }

    // check parameters
		if (!isset($_POST['username']) || is_null($_POST['username'])) {
			$this->response = $this->ERR_BAD_REQUEST;
			return $this;
		}

		// verify user
		require_once MODELS_DIR . '/ProfileManager.php';
		require_once MODELS_DIR . '/Profile.php';

    $user = new Profile();
		$user->setEmail($_POST['username']);

		// validate inputs and try to delete
		if ($user->isValid() && (new ProfileManager())->updateUsername($user)) {
      $this->response = $this->STATUS_OK;
		} else {
			$this->response = $this->ERROR;
		}

		return $this;
	}

}
