<?php

/**
 * Register
 *
 */
class Register extends EKEApiController {

	/**
	 * @var String
	 */
	private const PASSWORD = 'password';
	private const PASSWORD_CHECK = 'passwordcheck';
	private const USERNAME = 'username';
	private const EMAIL = 'email';

	/**
	 * @var Array[String]
	 */
	private $parameters = [
		self::PASSWORD,
		self::PASSWORD_CHECK,
		self::USERNAME,
		self::EMAIL,
	];

  /**
	 * Main method, automatically run
	 */
	public function run() {

		global $userLogged;

    if ($userLogged) {
      $this->response = $this->ERR_ALREADY_LOGGED;
      return $this;
    }

		if (!areset($this->parameters, TRUE)) {
			$this->response = $this->ERR_BAD_REQUEST;
			return $this;
		}

    /**
     * passwords match
     */
    if ($_POST[self::PASSWORD] !== $_POST[self::PASSWORD_CHECK]) {
    	$this->response = $this->error('Passwords do not match');
    	return $this;
    }

    /**
     * password is long enough
     */
    if (strlen($_POST[self::PASSWORD]) < 5) {
    	$this->response = $this->error('Password is too short');
    	return $this;
    }

    /**
     * Include and instatiate models
     */
    require_once MODELS_DIR . '/Profile.php';
    $account = new Profile();
    require_once MODELS_DIR . '/Credentials.php';
    $credentials = new Credentials();

    /**
     * Set account data
     */
    $account->setEmail($_POST[self::EMAIL]);
    $account->setUsername($_POST[self::USERNAME]);
    $account->setPassword($_POST[self::PASSWORD]);

    /**
     * Check if email already exists
     */
    if ($credentials->emailExists($account->getEmail())) {
    	$this->response = $this->error('Email already exists');
    	return $this;
    }

    /**
     * Check if username already exists
     */
    if ($credentials->usernameExists($account->getUsername())) {
    	$this->response = $this->error('Username already exists');
    	return $this;
    }

		// validate input and try to register
		if ($account->isValid() && (new Credentials())->register($account)) {
      $this->response = $this->SUCCESS;
 		} else {
 			$this->response = $this->ERROR;
 		}

    return $this;

  }

}
