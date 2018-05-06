<?php

// NOTE Only to develop in localhost
header('Access-Control-Allow-Origin: *');

/**
 * Prevent showing errors and warnings
 * (uncomment while developing)
 */
//error_reporting(0);
ini_set('display_errors', 'on');

/**
 * Load application core
 */
require __DIR__ . '/app/core/autoload.php';

/**
 * Handle user sessions
 */
require CONTROLLERS_DIR . '/_session.php';

/**
 * Define application routes
 */
DumpRouter::route('api',['pretty_parameters' => ['feature','action']]);

/**
 * Trigger the router and evaluate the uri path
 */
require DumpRouter::loadController(
  $_SERVER['REQUEST_URI'],
  './app/controllers/pages/'
);
