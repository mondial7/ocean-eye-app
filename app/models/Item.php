<?php

/**
 * Information Item Model
 *
 */
class Item extends EKEEntityModel {

    /**
     * @var Int
     */
    private $id,
            $actionable,
            $motivation,
            $leading,
            $frequency;

    /**
     * @var String
     */
    private $name,
            $summary,
            $dimension;

    /**
     * @var Date
     */
    private $created;

    /**
     * @var Date
     */
    private $updated;

    /**
     * @var Array[String]
     */
    private $dimensions = [
      'product',
      'customer',
      'resource',
    ];

    function __construct(){

      parent::__construct();

      $this->properties = [
        'id','creator','name',
        'summary','dimension',
        'created','updated',
        'actionable','motivation',
        'leading','frequency',
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
    public function setCreator($id) {

      $this->creator = $this->cleanNumber($id);

    }

    /**
     * @param String
     */
    public function setName($name) {

      $this->name = $this->cleanText($name);

    }

    /**
     * @param String
     */
    public function setSummary($s) {

      $this->summary = $this->cleanText($s);

    }

    /**
     * @param String
     */
    public function setDimension($d) {

      if (in_array($d, $this->dimensions)) {
        $this->dimension = $d;
      } else {
        $this->valid = false;
      }

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
     * @param Int
     */
    public function setActionable($i) {

      $this->actionable = $this->cleanNumber($i);

    }

    /**
     * @param Int
     */
    public function setMotivation($i) {

      $this->motivation = $this->cleanNumber($i);

    }

    /**
     * @param Int
     */
    public function setLeading($i) {

      $this->leading = $this->cleanNumber($i);

    }

    /**
     * @param Int
     */
    public function setFrequency($i) {

      $this->frequency = $this->cleanNumber($i);

    }

    /**
     * Getters
     */

    public function getId(){

      return $this->id;

    }

    public function getCreator(){

      return $this->creator;

    }

    public function getName(){

      return $this->name;

    }

    public function getSummary(){

      return $this->summary;

    }

    public function getDimension(){

      return $this->dimension;

    }

    public function getCreated(){

      return $this->created;

    }

    public function getUpdated(){

      return $this->updated;

    }

    public function getActionable(){

      return $this->actionable;

    }

    public function getMotivation(){

      return $this->motivation;

    }

    public function getLeading(){

      return $this->leading;

    }

    public function getFrequency(){

      return $this->frequency;

    }

}
