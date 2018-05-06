<?php

/**
 * Profile Manager
 *
 * Handle delete accounts, update profile data
 *
 */
class ProfileManager extends EKEModel {

  /**
   * NOTE refactor to static and upgrade
   *      query declaration with an ORM
   * @var String
   */
  private $USERTABLE = 'oceaneye__users';


  function __construct() {

      parent::__construct();

      // Declare database connection
      $this->connectDB();

  }


  /**
   * Delete Profile
   *
   * @param Profile account to log in
   * @return Boolean
   */
  public function delete(Profile $user) {

    // evaluate submitted password with current user
    if (!$this->verify($user)) {
      return false;
    }

    $query = "DELETE FROM {$this->USERTABLE}
              WHERE email = ? AND id = ? ;";

    $options = [ 'types' => ['si'], 'params' => [
      Session::get('email'),
      Session::get('id'),
    ]];

    // options are the same already set above
    $this->db->query($query, $options);

    return $this->db->getAffectedNum() === 1;

  }


  /**
   * Update Profile email
   *
   * @param Profile account
   * @return Boolean
   */
  public function updateEmail(Profile $user) {

    $query = "UPDATE {$this->USERTABLE}
              SET email = ?
              WHERE id = ? ;";

    $options = [ 'types' => ['si'], 'params' => [
      $user->getEmail(),
      Session::get('id'),
    ]];

    $this->db->query($query, $options);

    return $this->db->getAffectedNum() === 1;

  }


  /**
   * Update Profile username
   *
   * @param Profile account
   * @return Boolean
   */
  public function updateUsername(Profile $user) {

    $query = "UPDATE {$this->USERTABLE}
              SET username = ?
              WHERE id = ? ;";

    $options = [ 'types' => ['si'], 'params' => [
      $user->getUsername(),
      Session::get('id'),
    ]];

    $this->db->query($query, $options);

    return $this->db->getAffectedNum() === 1;

  }

  /**
   * Update Profile password
   *
   * @param Profile account
   * @return Boolean
   */
  public function updatePassword(Profile $user) {

      // evaluate submitted password with current user
      if (!$this->verify($user)) {
        return false;
      }

      $query = "UPDATE {$this->USERTABLE}
                SET password = ?
                WHERE id = ? ;";

      $options = [ 'types' => ['si'], 'params' => [
        $user->getPassword(),
        Session::get('id'),
      ]];

      $this->db->query($query, $options);

      return $this->db->getAffectedNum() === 1;

  }

  /**
   * Match user password with current logged in user
   *
   * @param Profile account
   * @return Boolean
   */
  private function verify(Profile $user) {

    $password = $user->getPassword();

    $query = "SELECT password
              FROM {$this->USERTABLE}
              WHERE email = ? AND id = ? ;";

    $options = [ 'types' => ['si'], 'params' => [
      Session::get('email'),
      Session::get('id'),
    ]];

    $users = $this->db->query($query, $options);

    if ($this->db->getResultNum() !== 1) {

      // Handle Error/Exception

      return false;

    } else {

      // get only first result of the array list
      // since we are looking for only one matched account
      $user = $users[0];

      // Match passwords
      require_once MODELS_DIR . '/PasswordUtility.php';

      return PasswordUtility::match($password, $user['password']);

    }

  }

}
