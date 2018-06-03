<?php

/**
 * Credentials class
 *
 * Login, Register functions
 *
 */
class Credentials extends EKEModel {

  /**
   * @var Int
   */
  private $user_id;

  /**
   * NOTE refactor to static and upgrade
   *      query declaration with an ORM
   * @var String
   */
  private $USERTABLE = 'oceaneye__user';

  /**
   * @var String
   */
  private $user_email, $user_username;


  function __construct() {

    parent::__construct();

    // Declare database connection
    $this->connectDB();

  }


  /**
   * Evaluate login
   *
   * @param Profile account to log in
   * @return Array account data
   *
   */
  public function login(Profile $user) {

    // set profile attributes
    $userkey = $user->getUserkey();
    $password = $user->getPassword();

    $query = "SELECT id, username, email, password,
                     created, updated
              FROM {$this->USERTABLE}
              WHERE email = ? OR username = ? ;";

    $options = [ 'types' => ['ss'], 'params' => [$userkey, $userkey] ];

    $users = $this->db->query($query, $options);

    if ($this->db->getResultNum() !== 1) {

      // We must have only one account
      $user = null;

      // Handle Error/Exception

    } else {

      // get only first result of the array list
      // since we are looking for only one matched account
      $user = $users[0];

      // Match passwords
      require_once UTILS_DIR . '/PasswordUtility.php';
      $passwordMatch = PasswordUtility::match($password, $user['password']);

      // Store user_id, username, email
      $this->user_id = $user['id'];
      $this->user_email = $user['email'];
      $this->user_username = $user['username'];

      return $passwordMatch;

    }

    return false;

  }


  /**
   * Get the last logged in user_id
   *
   * @return Int
   */
  public function getUserId() {

    return $this->user_id;

  }


  /**
   * Get the last logged in user's email
   *
   * @return String
   */
  public function getUserEmail() {

    return $this->user_email;

  }


  /**
   * Get the last logged in user's username
   *
   * @return String
   */
  public function getUserUsername() {

    return $this->user_username;

  }


  /**
   * Register new user
   *
   * @param Profile new account to register
   * @return Boolean status of registration
   */
  public function register(Profile $user) {

    $email = $user->getEmail();
    // $username = $user->getUsername();
    $password = $user->getPassword();

    /************************************
     *
     * WARNING
     *
     * Password is still in plain here
     * just take care
     ************************************
     */

    // hash password
    require_once UTILS_DIR . '/PasswordUtility.php';
    $password = PasswordUtility::hash($password);

    // $query = "INSERT INTO {$this->USERTABLE} (email, username, password)
    //           VALUES ( ? , ? , ? );";
    $query = "INSERT INTO {$this->USERTABLE} (email, password)
              VALUES ( ? , ? );";

    $options = ['types' => ['ss'], 'params' => [
      $email,
      // $username,
      $password
    ]];

    $this->db->query($query, $options);

    return ($this->db->getAffectedNum() === 1);

  }


  /**
   * Check if email already exists
   *
   * @param String email
   * @return Boolean
   */
  public function emailExists($email) {

    $query = "SELECT id FROM {$this->USERTABLE} WHERE email = ? ;";

    $options = [ 'types' => ['s'], 'params' => [$email] ];

    $result = $this->db->query($query, $options);

    if ($result && $this->db->getResultNum() === 1) {
      $this->temporary_id = $result[0]['id'];
      return true;
    }

    return false;

  }


  /**
   * Check if username already exists
   *
   * @param String username
   * @return Boolean
   */
  public function usernameExists($username) {

    $query = "SELECT id FROM {$this->USERTABLE} WHERE username = ? ;";

    $options = [ 'types' => ['s'], 'params' => [$username] ];

    $result = $this->db->query($query, $options);

    if ($result && $this->db->getResultNum() === 1) {

      $this->temporary_id = $result[0]['id'];
      return true;

    }

    return false;

  }

}
