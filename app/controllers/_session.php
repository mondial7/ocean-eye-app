<?php

/**
 * Include session class and init new session
 */
require_once UTILS_DIR . '/Session.php';
Session::init();

/**
 * Check if current session contains already the user data
 */
$userLogged = Session::exists('username');

/**
 * Define useful global variables
 */
$account_id = Session::get('id');
