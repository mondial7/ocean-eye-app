<?php

class APIRouter {

  /**
   * @var Array[String]
   */
  private $features;

  /**
   * @var Array[String=>Array[String]]
   */
  private $apiPaths;

  /**
   * @var EKEAPIController
   */
  private $controller;

  /**
   * Initiate the object with the defined APIs
   *
   * @param Array[String=>Array[String]] api paths tree
   */
  public function __construct($apiPaths){
    $this->apiPaths = $apiPaths;
    // store allowed features
    $this->features = array_keys($apiPaths);
    // prepare an instance of EKEAPIController
    // use this controller to send formatted response on errors
    $this->controller = new class extends EKEAPIController {};
  }

  /**
   * Evaluate api request
   *
   * @param String feature
   * @param String action
   */
  public function evaluate($feature, $action) {
    // validate give parameters
    if (!$this->_validate($feature, $action)) {
      // misleading error message for wrong given parameters
      // counter trivial attacks
      $this->controller->error('Access forbidden');
    } else {
      // get api controller absolute path
      $api = $this->_getPath($feature, $action);
      if (!is_file($api)) {
        // define error -> probably due to wrong apiPaths definition
        $this->controller->error('Wrong request');
      } else {
        // include api class
        include_once $api;
        // override the controller with real api
        $this->controller = new $action();
        // execute api controller
        $this->controller->run();
      }
    }
    // print out the answer
    $this->controller->answer();
  }

  /**
   * Build the path to the api controller
   *
   * @param String feature
   * @param String action
   * @return String path
   */
  private function _getPath($feature, $action) {
    return API_DIR . DIRECTORY_SEPARATOR . $feature
                   . DIRECTORY_SEPARATOR . $action . '.php';
  }

  /**
   * Validate parameters
   * check if api exists
   *
   * @param String feature
   * @param String action
   * @return Boolean
   */
  private function _validate($feature, $action) {
    return in_array($feature, $this->features) &&
           in_array($action, $this->apiPaths[$action]);
  }

}
