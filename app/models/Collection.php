<?php

require_once MODELS_DIR . '/Item.php';

/**
 * Collection Model
 *
 */
class Collection extends EKEEntityModel {

    /**
     * @var Int
     */
    private $id,
            $creator,
            $team;

    /**
     * @var String
     */
    private $notes;

    /**
     * @var Date
     */
    private $created;

    /**
     * @var Date
     */
    private $updated;

    /**
     * @var Array[Item]
     */
    private $items;

    /**
     * Helper to validate items
     * @var Item
     */
    private $itemModel;

    function __construct(){

      parent::__construct();

      $this->itemModel = new Item();

      $this->properties = [
        'id','team',
        'creator','notes',
        'created','updated',
        'items',
      ];

    }

    /**
     * @param Int
     */
    public function setId($id) {

      $this->id = $this->cleanNumber($id);

    }

    /**
     * @param Int
     */
    public function setTeam($id) {
      // NOTE team === project
      $this->team = $this->cleanNumber($id);

    }

    /**
     * @param Int
     */
    public function setCreator($id) {

      $this->creator = $this->cleanNumber($id);

    }

    /**
     * @param String
     */
    public function setNotes($n) {

      $this->notes = $this->cleanText($n);

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
     * Set updated date
     *
     * @param Date
     */
    public function setUpdated($date) {

      $this->updated = $this->validateDate($date);

    }

    /**
     * @param Array[Item]
     */
    public function setItems($items) {
      foreach ($items as $item) {
        // reformat item array
        $keys = ['actionable','motivation','leading','frequency'];
        foreach ($keys as $key) {
          $item[$key] = $item[$key.'_'];
          unset($item[$key.'_']);
        }
        $this->itemModel->loadFromArray($item);
        if (!$this->itemModel->isValid()) {
          $this->valid = FALSE;
        }
      }
      $this->items = $this->valid ? $items : [];
    }

    /**
     * Getters
     */

    public function getId(){

      return $this->id;

    }

    public function getTeam(){

      return $this->team;

    }

    public function getCreator(){

      return $this->creator;

    }

    public function getNotes(){

      return $this->notes;

    }

    public function getCreated(){

      return $this->created;

    }

    public function getUpdated(){

      return $this->updated;

    }

    public function getItems(){

      return $this->items;

    }

}
