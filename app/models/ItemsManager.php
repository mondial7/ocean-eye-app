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
    // ...

    return $this->db->getAffectedNum() === 1;

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
