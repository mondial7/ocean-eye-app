<?php

/**
 * Profile Model
 *
 */
class Profile extends EKEEntityModel {

    /**
     * @var Int
     */
    private $id;

    /**
     * @var String
     */
    private $username,
            $email,
            $password,
            $project;

    /**
     * @var Date
     */
    private $created;

    /**
     * @var Array[String]
     */
    private $projects;

    function __construct(){

      parent::__construct();

      $this->properties = [
        'id','username',
        'email','password',
        'created','projects',
        'project',
      ];

    }

    /**
     * Set profile id
     *
     * @param Int
     */
    public function setId($id) {

      $this->id = $this->cleanNumber($id);

    }

    /**
     * Setter of the username
     *
     * @param String
     */
    public function setUsername($username) {

      $this->username = $this->cleanText($username);

    }

    /**
     * Validate, sanitize and set the account email and validate
     *
     * @param String
     */
    public function setEmail($email) {

      $this->email = $this->validateEmail($email);

    }

    /**
     * Set the account password
     * no need to sanitize or validate since we
     * are going to hash it
     *
     * @param String
     */
    public function setPassword($password) {

      $this->password = $password;

    }

    /**
     * Set created date
     *
     * @param Date
     */
    public function setCreated($date) {

      $this->created = $this->validateDate($date);

    }

    /**
     * Set userkey
     * The userkey is used in the login form
     * this might be the username or the email
     * of the user logging in.
     *
     * @param String
     */
    public function setUserkey($key) {

      $this->userkey = $this->cleanText($key);

    }

    /**
     * Set projects list
     *
     * @param Array[String]
     */
    public function setProjects($projects) {

      $this->projects = array_map($this->cleanText, $projects);

    }

    /**
     * Set the current focused project
     *
     * @param String
     */
    public function setProject($project) {

      $this->project = $this->cleanText($projects);

    }

    /**
     * Getters
     */

    public function getId(){

      return $this->id;

    }

    public function getUsername(){

      return $this->username;

    }

    public function getEmail(){

      return $this->email;

    }

    public function getPassword(){

      return $this->password;

    }

    public function getCreated(){

      return $this->created;

    }

    public function getUserkey(){

      return $this->userkey;

    }

    public function getProjects(){

      return $this->projects;

    }

    public function getProject(){

      return $this->project;

    }

}
