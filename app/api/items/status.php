<?php

/**
 * Get the md5 of the current set of information items
 */
class Status extends EKEApiController {

  /**
	 * Main method, automatically run
	 */
	public function run() {

    if (!USER_LOGGED) {
      $this->response = $this->ERR_NOT_LOGGED;
      return $this;
    }

		require_once MODELS_DIR . '/ItemsManager.php';
    // in future could be cached
    $items = (new ItemsManager())->list();

    if (count($items)>0) {
      $this->response = $this->success(
        'md5 items',
        md5($items)
      );
    } else {
      $this->response = $this->ERROR;
    }

		return $this;
	}

}
