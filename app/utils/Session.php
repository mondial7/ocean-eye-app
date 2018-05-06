<?php

/**
 * Manage user sessions
 *
 */
class Session {

  /**
   * Start new session
   *
   * @return Void
   */
  public static function init() {
    // restart existing session or initiate a new one
    session_start();
  }

  /**
   * End session
   *
   * @return Void
   */
  public static function end() {
    // unset all session data
    session_unset();
    // force session cookie deletion
    if (ini_get('session.use_cookies')) {
      $params = session_get_cookie_params();
      setcookie(session_name(), '', time() - 3600,
        $params['path'], $params['domain'],
        $params['secure'], $params['httponly']
      );
    }
    // destroy existing session
    session_destroy();
  }

  /**
   * Add new session variable
   *
   * @param String key
   * @param Mixed value
   * @return Void
   */
  public static function add($key, $value) {
    $_SESSION[$key] = $value;
  }

  /**
   * Add multiple items
   *
   * @param Array[String=>Mixed]
   * @return Void
   */
  public static function addArray($data) {
    foreach ($data as $key => $value) {
      self::add($key, $value);
    }
  }

  /**
   * Key exists
   *
   * @param String key
   * @return Boolean
   */
  public static function exists($key) {
    return isset($_SESSION[$key]);
  }

  /**
   * Get session variable
   *
   * @param String key
   * @param Mixed default return value (optional)
   * @return Mixed
   */
  public static function get($key, $value = null) {
    // Sintax valid since Php > 7.0
    // use
    // isset($_SESSION[$key]) ? $_SESSION[$key] : null
    // for previous versions
    return $_SESSION[$key] ?? $value;
  }

  /**
   * Check if a value exists and is equal to given one
   *
   * @param String key
   * @param Mixed value
   * @return Boolean
   */
  public static function is($key, $value) {
    return static::get($key) === $value;
  }

}
