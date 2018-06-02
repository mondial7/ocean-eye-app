<?php

// NOTE Only to develop in localhost
header('Access-Control-Allow-Origin: *');
/**
 * Prevent showing errors and warnings
 * (uncomment while developing)
 */
//error_reporting(0);
ini_set('display_errors', 'on');

// Run application
require __DIR__ . '/app/core/EKE.php';
EKE::go([
  /**
   * Enable api listener
   * @var Boolean
   */
  'api' => true,
  /**
   * Scripts to be included before the controller
   * Scripts are included in the provided order
   * Scripts are stored in app/controllers/helpers/
   * @var Array[String]
   */
  'before' => [
    '_session',
  ],
  /**
   * Scripts to be included after the controller
   * Scripts are included in the provided order
   * @var Array[String]
   */
  // 'after' => [],
  /**
   * Routes definition, combine routes/parameters
   * with the corresponding controller
   * @var Array[String=>Array[String=>Array[String]]]
   */
  'routes' => [
    '/' => [
      'controller' => 'landing'
    ],
    'dashboard' => [],
  ],
]);
