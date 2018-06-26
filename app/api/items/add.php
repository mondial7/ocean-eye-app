<?php

/**
 * Add new information item
 */
class Add extends EKEApiController {

  /**
   * @var String
   */
  private const NAME = 'name';
  private const SUMMARY = 'summary';
  private const DIMENSION = 'dimension';

  /**
   * @var Array[String]
   */
  private const PARAMETERS = [
    self::NAME,
    self::SUMMARY,
    self::DIMENSION,
  ];

  /**
	 * Main method, automatically run
	 */
	public function run() {

    if (!USER_LOGGED) {
      $this->response = $this->ERR_NOT_LOGGED;
      return $this;
    }

    // check parameters
		if (!areset(self::PARAMETERS, TRUE)) {
			$this->response = $this->ERR_BAD_REQUEST;
			return $this;
		}

		require_once MODELS_DIR . '/ItemsManager.php';
		require_once MODELS_DIR . '/Item.php';

    $manager = new ItemsManager();
    $item = new Item();
		$item->setName($_POST[self::NAME]);
		$item->setSummary($_POST[self::SUMMARY]);
		$item->setDimension($_POST[self::DIMENSION]);

		// validate inputs
		if ($item->isValid() && $manager->add($item)) {
      // get info of last insert item
      // NOTE here should be better to have a second
      //      condition, since another query is called
      $this->response = $this->success(
        'info added',
        $manager->info($manager->lastAddedId())
      );
		} else {
			$this->response = $this->ERROR;
		}

		return $this;
	}

}
