<?php

/**
 * Information Items Manager
 *
 */
class ItemsManager extends EKEModel {

  /**
   * NOTE refactor to static and upgrade
   *      query declaration with an ORM
   * @var String
   */
  private $ITEMTABLE = 'oceaneye__informationitem';

  /**
   * @var Int
   */
  private $addedId;

  function __construct() {

      parent::__construct();

      // Declare database connection
      $this->connectDB();

  }


  /**
   * Add new information item
   *
   * @param Item
   * @return Boolean
   */
  public function add(Item $item) {

    $query = "INSERT INTO {$this->ITEMTABLE}
              (creator, name, summary, dimension)
              VALUES ( ? , ? , ? , ? );";

    $options = [ 'types' => ['isss'], 'params' => [
      Session::get('id'),
      $item->getName(),
      $item->getSummary(),
      $item->getDimension(),
    ]];

    $this->db->query($query, $options);

    // store last added id
    $this->addedId = $this->db->insert_id();

    return $this->db->getAffectedNum() === 1;

  }

  /**
   * Exposed last added id
   *
   * @return Int
   */
  public function lastAddedId() {
    return $this->addedId;
  }

  /**
   * Get info of information item, given the id
   *
   * @param Int
   * @return Array
   */
  public function info($id) {

    $query = "SELECT *
              FROM {$this->ITEMTABLE}
              WHERE id = ? ;";
    $options = [ 'types' => ['i'], 'params' => [$id] ];
    return $this->db->query($query, $options)[0] ?? [];

  }

  /**
   * List all information items available
   *
   * @return Array[Item]
   */
  public function list() {

    $query = "SELECT * FROM {$this->ITEMTABLE}";
    return $this->db->query($query) ?: [];

  }

}
