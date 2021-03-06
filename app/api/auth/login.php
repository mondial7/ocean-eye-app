<?php

/**
 * Log in a user
 *
 */
class Login extends EKEApiController {

	/**
	 * @var String
	 */
	private const PASSWORD = 'password';
	private const USERKEY = 'userkey';
	private const USERNAME = 'username';
	private const EMAIL = 'email';
	private const ID = 'id';

	/**
	 * @var Array[String]
	 */
	private const PARAMETERS = [
		self::PASSWORD,
		self::USERKEY,
	];

  /**
	 * Main method, automatically run
	 */
	public function run() {

    if (USER_LOGGED) {
      $this->response = $this->ERR_ALREADY_LOGGED;
      return $this;
    }

		// check parameters
		if (!areset(self::PARAMETERS, TRUE)) {
			$this->response = $this->ERR_BAD_REQUEST;
			return $this;
		}

		// verify user
		require_once MODELS_DIR . '/Credentials.php';
		require_once MODELS_DIR . '/Profile.php';

    $user = new Profile();
		$user->setPassword($_POST[self::PASSWORD]);
    $user->setUserkey($_POST[self::USERKEY]);

		$credentials = new Credentials();

		// validate inputs and try login
		if ($user->isValid() && $credentials->login($user)) {

			// use profile model to parse data
			$user->setId($credentials->getUserId());
			$user->setEmail($credentials->getUserEmail());
			$user->setUsername($credentials->getUserUsername());
			$userData = [
				self::ID 				=> $user->getId(),
				self::USERNAME 	=> $user->getUsername(),
				self::EMAIL 		=> $user->getEmail(),
			];
			// save in session
			Session::addArray($userData);
			// return access parameters
			$this->response = $this->success('logged in', $userData);

		} else {

			$this->response = $this->ERROR;

		}

		return $this;
	}

}
