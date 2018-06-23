<?php

/**
 * Collections Manager
 *
 */
class CollectionsManager extends EKEModel {

  /**
   * NOTE refactor to static and upgrade
   *      query declaration with an ORM
   * @var String
   */
  private $COLLITEMTABLE = 'oceaneye__collection_informationitem';
  private $COLLTABLE = 'oceaneye__collection';

  function __construct() {

      parent::__construct();

      // Declare database connection
      $this->connectDB();

  }


  /**
   * Add new information item
   *
   * @param Collection
   * @return Boolean
   */
  public function add(Collection $coll) {

    $query = "INSERT INTO {$this->COLLTABLE}
              (creator)
              VALUES ( ? );";
    $options = [ 'types' => ['i'], 'params' => [
      Session::get('id'),
    ]];
    $this->db->query($query, $options);
    if ($this->db->getAffectedNum() !== 1) {
      return false;
    } else {
      // get last insert id
      $collectionId = $this->db->insert_id();
      // save all items
      foreach ($coll->getItems() as $id) {
        $query = "INSERT INTO {$this->COLLITEMTABLE}
                  (collection_id, informationitem_id)
                  VALUES ( ? , ? );";
        $options = [ 'types' => ['ii'], 'params' => [
          $collectionId,
          $id,
        ]];
        $this->db->query($query, $options);
        if ($this->db->getAffectedNum() === 1) {
          // log exception ...
          return false;
        }
      }
    }
    return true;

  }

  /**
   * List all collection items available
   *
   * @return Array[Item]
   */
  public function list() {
    // NOTE will be refactored to target team/project instead of creator
    $query = "SELECT * FROM {$this->COLLTABLE}
              WHERE creator = ? ;";
    $options = [ 'types' => ['i'], 'params' => [
      Session::get('id'),
    ]];
    return $this->db->query($query, $options) ?: [];

  }

}