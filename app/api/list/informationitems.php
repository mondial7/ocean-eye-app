<?php

/**
 * List information items
 */
class Informationitems extends EKEApiController {

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

		require_once MODELS_DIR . '/ItemsManager.php';
		$this->response = $this->success(
			'items list',
			(new ItemsManager())->list()
		);

		return $this;
	}

}
