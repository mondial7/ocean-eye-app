<?php

/**
 * NOTE this version of the ORM is not complete, with the
 * current version you can only execute standard mysql
 * queries with parameters.
 */
class EKE_ORM {

	/**
	 * @var object MySQLi
	 */
	private $db = null;

	/**
	 * @var object EKEQuery
	 */
  private $EKEQuery = null;

	function __construct($db_instance) {

		// Define DB instance
		$this->db = $db_instance;

		// Instantiaze the Query
		require_once CORE_DIR . '/database/EKEQuery.php';
		$this->EKEQuery = new EKEQuery();

	}

	/**
	 * Standard Query
	 *
	 * @param string query
	 * @param array parameters
	 */
	public function query($query, $params = null) {

		return $this->EKEQuery->run($this->db, $query, $params);

	}

	/**
	 * Insert ID
	 *
	 * @return	integer
	 */
	public function insert_id() {

		return @mysqli_insert_id($this->db);

	}

	/**
	 * Get rows number from last executed query
	 *
	 * @return int
	 */
	public function getResultNum() {

		return $this->EKEQuery->getResultNum();

	}

	/**
	 * Get affeced rows number from last executed query
	 *
	 * @return int
	 */
	public function getAffectedNum() {

		return $this->EKEQuery->getAffectedNum();

	}

	/**
	 * Real Escape String on MySQLi object
	 *
	 * @param string
	 * @return string
	 */
	public function real_escape_string($str) {

		return $this->db->real_escape_string($str);

	}

	/**
	 * Multi Query (not parameterized) MySQLi function
	 *
	 * @param string
	 * @return object mysqli result
	 */
	public function multi_query($query) {

		return $this->db->multi_query($query);

	}

}
