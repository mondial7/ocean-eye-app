<?php

/**
 * PasswordUtility class
 *
 * Utilities for passwords management
 *
 */
class PasswordUtility {

  /**
   * Hash a give password and
   * return the hashed string
   *
   * @param String plain-password
   * @return String hashed-password
   */
  public static function hash($password) {

    return password_hash($password, PASSWORD_DEFAULT);

  }

  /**
   * Match hashed password with plain text
   *
   * @param String plain-password
   * @param String hashed-password
   * @return Boolean
   */
  public static function match($plain, $hash) {

    return password_verify($plain, $hash);

  }

}
