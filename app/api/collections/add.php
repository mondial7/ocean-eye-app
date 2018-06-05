<?php

/**
 * Add new collection
 */
class Add extends EKEApiController {

  /**
   * @var String
   */
  private const ITEMS = 'items';

  /**
   * @var Array[String]
   */
  private const PARAMETERS = [
    self::ITEMS,
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

		require_once MODELS_DIR . '/CollectionsManager.php';
		require_once MODELS_DIR . '/Collection.php';

    $collection = new Collection();

    $items = json_decode($_POST[self::ITEMS], true);
		$collection->setItems($items);
		// validate inputs
		if ($collection->isValid() && (new CollectionsManager())->add($collection)){
      // NOTE might return the recorded collection
      // ...
      $this->response = $this->STATUS_OK;
		} else {
			$this->response = $this->ERROR;
		}

		return $this;
	}

}
