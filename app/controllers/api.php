<?php

$apiPaths = [
  /**
   * Define API routes
   * Structure: [
   *  folder => [filename, filename, ...],
   *  folder => [filename, filename, ...],
   * ]
   */
  'auth' => ['login','register','recovery',],
];

/**
 * Register logged protected api
 */
if (USER_LOGGED) {
  $apiPaths['account'] = ['update',];
  $apiPaths['project'] = ['collections','members',];
  // 'play' => [],
  // 'information' => ['update',],
}

/**
 * Log each api request
 * @todo not need to explain ... this cannot be in production
 */
(new EKELog())->save('api', ['account' => Session::get('id','ND')]);

/**
 * Evaluate api call
 */
require_once UTILS_DIR . '/APIRouter.php';
(new APIRouter($apiPaths))->evaluate($_GET['feature'], $_GET['action']);
