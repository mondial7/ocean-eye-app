<?php

$apiPaths = [
  /**
   * Define API routes
   * Structure: [
   *  folder => [filename, filename, ...],
   *  folder => [filename, filename, ...],
   * ]
   */
  'auth'        => ['login','register','recovery',],
  'account'     => ['status',],
  'collections' => [],
  'items'       => [],
  'list'        => [],
];

/**
 * Register logged protected api
 */
if (USER_LOGGED) {
  array_push($apiPaths['auth'],
    'logout'
  );
  array_push($apiPaths['account'],
    'update'
  );
  array_push($apiPaths['collections'],
    'add'
  );
  array_push($apiPaths['items'],
    'add'
  );
  array_push($apiPaths['list'],
    'collections',
    'informationitems'
  );
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
