<?php

/**
 * Log out a user
 *
 */
class Logout extends EKEApiController {

	/**
	 * @var String
	 */
	private const EMAIL = 'email';

  /**
	 * Main method, automatically run
	 */
	public function run() {

    if (!USER_LOGGED) {
      $this->response = $this->ERR_NOT_LOGGED;
      return $this;
    }

		Session::end();

		// double check session data has been deleted
		if (!Session::exists(self::EMAIL)) {
			$this->response = $this->success('logged out');
		} else {
			$this->response = $this->error('something went wrong', [
				self::EMAIL		=> Session::get(self::EMAIL)
			]);
		}

		return $this;
	}

}
