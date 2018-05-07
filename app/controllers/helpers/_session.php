<?php

/**
 * Include session class and init new session
 */
require_once UTILS_DIR . '/Session.php';
Session::init();

/**
 * Check if current session contains already the user data
 *
 * @var Boolean
 */
define('USER_LOGGED', Session::exists('username'));

/**
 * Logged user id
 *
 * @var Mixed[String|Int]
 */
define('USER_ID', Session::get('id'));
