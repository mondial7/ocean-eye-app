<?php

/**
 * Update account
 *
 */
class Update extends EKEApiController {

	/**
	 * @var String
	 */
 	private const OP = 'operation';
	private const EMAIL = 'email';
	private const PASSWORD = 'password';
	private const USERNAME = 'username';

	/**
	 * @var Array[String]
	 */
	private $options = [
		self::EMAIL,
		self::PASSWORD,
		self::USERNAME,
	];

  /**
	 * Main method, automatically run
	 */
	public function run() {

		global $userLogged;

    if (!$userLogged) {
      $this->response = $this->ERR_NOT_LOGGED;
      return $this;
    }

		$op = $_POST[self::OP];

    // check operation parameter
		if (!isset($op) || is_null($op) || !in_array($op, $this->options)) {
			$this->response = $this->ERR_BAD_REQUEST;
			return $this;
		}

		// verify user
		require_once MODELS_DIR . '/ProfileManager.php';
		require_once MODELS_DIR . '/Profile.php';

		// get updater function
		$updater = $this->getUpdater(new Profile(), new ProfileManager());
		// perform update
		$this->response = $updater($op, $_POST[$op])
											? $this->SUCCESS
											: $this->ERROR;

		return $this;
	}

	/**
	 * Updater helper function
	 *
	 * @param Profile entity model
	 * @param ProfileManager model
	 * @return Function updater
	 */
	private function getUpdater($profile, $manager) {
		/**
		 * @param String property to update
		 * @param String value
		 * @return Boolean
		 */
		return function ($property, $value) use ($profile, $manager) {
			// set data
			${'$user->set'.ucfirst($property)}($value);
			// validate and update data
			return (isset($_POST[$property]) && !is_null($_POST[$property]))
						 && $profile->isValid()
						 && ${'$manager->update'.ucfirst($property)}($profile);
		};
	}

}
