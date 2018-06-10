<?php

/**
 * List collections according to current project (// user in the first version)
 */
class Collections extends EKEApiController {

  /**
	 * Main method, automatically run
	 */
	public function run() {

		if (!USER_LOGGED) {
      $this->response = $this->ERR_NOT_LOGGED;
      return $this;
    }

		// NOTE pagination => next version
		// // check parameters
		// if (!isset($_GET['page']) || is_null($_GET['page'])) {
		// 	$this->response = $this->ERR_BAD_REQUEST;
		// 	return $this;
		// }

		require_once MODELS_DIR . '/CollectionsManager.php';
		// NOTE USER_ID will have to be refactored to project
		$this->response = json_encode((new CollectionsManager())->list());

		return $this;
	}

}
