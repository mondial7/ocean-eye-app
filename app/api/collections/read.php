<?php

/**
 * Read collection
 */
class Read extends EKEApiController {

  /**
   * @var String
   */
  private const ID = 'id';

  /**
   * @var Array[String]
   */
  private const PARAMETERS = [
    self::ID,
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
		if (!areset(self::PARAMETERS)) {
			$this->response = $this->ERR_BAD_REQUEST;
			return $this;
		}

		require_once MODELS_DIR . '/CollectionsManager.php';
		require_once MODELS_DIR . '/Collection.php';

    $collection = new Collection();
    $collection->setId($_GET[self::ID]);

    // validate inputs
		if ($collection->isValid()){
      $this->response = $this->success(
        'collection details',
        (new CollectionsManager())->read($collection)
      );
		} else {
			$this->response = $this->ERROR;
		}

		return $this;
	}

}
