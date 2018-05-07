<?php

/**
 * Api class
 * Extended by all api endpoints
 * The 'run()' method is triggered automatically by the APIRouter
 */
class EKEApiController {

  /**
   * @var String
   */
  protected const STATUS = 'status';
  protected const DETAILS = 'details';
  protected const DATA = 'data';
  protected const ERROR = 'ERROR';
  protected const OK = 'OK';

  /**
   * Response
   * Usually a json or html string
   * @var String
   */
  protected $response = null;

  /**
   * Default response bad request, not logged, already logged,...
   * @var String
   */
  protected $ERR_BAD_REQUEST;
  protected $ERR_NOT_LOGGED;
  protected $ERR_ALREADY_LOGGED;

  /**
   * General error
   * @var String
   */
  protected $ERROR;
  protected $ERR;

  /**
   * General success
   * @var String
   */
  protected $SUCCESS;

  public function __construct() {
    // baked error messages
    $this->ERR_TRIVIAL = $this->error('Trivial api');
    $this->ERR_BAD_REQUEST = $this->error('Bad request');
    $this->ERR_NOT_LOGGED = $this->error('Not logged');
    $this->ERR_ALREADY_LOGGED = $this->error('Already logged');
    $this->ERROR = $this->error('abc');
    $this->ERR = $this->error('abc');
    // baked success messages
    $this->SUCCESS = $this->success();
  }

  /**
   * Execute api logic
   * It is supposed to be overriden by any child class
   *
   * @return Void
   */
  protected function run() {
    $this->response = $this->ERR_TRIVIAL;
    return $this;
  }

  /**
   * Factory for messages
   *
   * @param String status
   * @param String message
   * @param Array[Mixed] data
   * @return String json-formatted answer
   */
  protected function message($status, $message = '', $data = null) {
    return json_encode([
      self::STATUS => $status,
      self::DETAILS => $message,
      self::DATA => $data,
    ]);
  }

  /**
   * Factory for error messages
   *
   * @param String message
   * @return String json-formatted answer
   */
  public function error($message) {
    return $this->message(self::ERROR, $message);
  }

  /**
   * Factory for success messages
   *
   * @param String message
   * @param Array[Mixed] data
   * @return String json-formatted answer
   */
  public function success($message = '', $data = null) {
    return $this->message(self::OK, $message, $data);
  }

  /**
   * Print response
   *
   * @param Boolean force exit after answer
   */
  public function answer($exit = false) {
    echo $this->response;
    if ($exit) exit();
  }

}
