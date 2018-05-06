<?php

class EKEQuery {

  /**
   * @var array
   */
  private $last_result;

  /**
   * @var int
   */
  private $affected_rows, $result_rows;

  /**
   * Direct query
   * Still parametized query support
   *
   * @return array query result
   */
  public function run($db, $query, $options) {

    $result = [];

    if ($stmt = $db->prepare($query)) {

      // Execute parameters binding
      if ($options !== null) {

        $this->bind_parameters($stmt, $options['types'], $options['params']);

      }

      // run the query
      $stmt->execute();
      $db_result = $stmt->get_result();

      // store affected rows
      $this->affected_rows = $stmt->affected_rows;

      if ($db_result) {

        // store number of result rows
        $this->result_rows = $db_result->num_rows;

        // retrieve real result data (array)
        $result = $db_result->fetch_all(MYSQLI_ASSOC);

      }

      $stmt->close();

    }

    // keep track of last query result
    $this->last_result = $result;

    return $result;

  }


  /**
   * Bind values for prepared statement
   * @todo verify usefulness of method makeValuesReferenced
   */
  private function bind_parameters(&$stmt, $types, $params) {

    $options = array_merge($types, $params);
    return call_user_func_array([&$stmt, 'bind_param'], $this->makeValuesReferenced($options));

  }
  private function makeValuesReferenced($arr) {

    $refs = [];

    foreach($arr as $key => $value) {

      $refs[$key] = &$arr[$key];

    }

    return $refs;

  }


  /**
   * GETTERS
   */

  public function getLastResult() {

    return $this->last_result;

  }

  public function getResultNum() {

    return $this->result_rows;

  }

  public function getAffectedNum() {

    return $this->affected_rows;

  }

}
