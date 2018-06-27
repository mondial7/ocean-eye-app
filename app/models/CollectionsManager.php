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
  private $USERTABLE = 'oceaneye__user';

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
      foreach ($coll->getItems() as $item) {
        $query = "INSERT INTO {$this->COLLITEMTABLE}
                  (collection_id, informationitem_id,
                   actionable_, leading_, motivation_, frequency_)
                  VALUES ( ? , ? , ? , ? , ? , ? );";
        $options = [ 'types' => ['iiiiii'], 'params' => [
          $collectionId,
          $item['id'],
          $item['actionable_'],
          $item['leading_'],
          $item['motivation_'],
          $item['frequency_'],
        ]];
        $this->db->query($query, $options);
        if ($this->db->getAffectedNum() !== 1) {
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
    $query = "SELECT coll.id, user.email, coll.updated
              FROM {$this->COLLTABLE} AS coll
              JOIN {$this->USERTABLE} AS user
              ON coll.creator = user.id
              WHERE coll.creator = ?
              ORDER BY coll.updated DESC;";
    $options = [ 'types' => ['i'], 'params' => [
      Session::get('id'),
    ]];
    return $this->db->query($query, $options) ?: [];

  }

}
