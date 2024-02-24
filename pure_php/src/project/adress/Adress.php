<?php

namespace App\project\adress;

use App\project\model\Model;

class Adress extends Model {

    private $city_id;
    private $neighborhood;
    private $name;
    private $number;
    private $complement;
    private $created_at;
    private $updated_at;

    //Value to be used when save in database
    private $save = ['city_id','neighborhood','name','number','complement','created_at','updated_at'];

    //When created get table name and get date time to put in created_at, updated_at
    function __construct() {
        parent::__construct();
        $this->table = 'adress';
        $this->created_at = date("Y-m-d H:i:s");
        $this->updated_at = date("Y-m-d H:i:s");
    }

    /**
     * Get the Adress by city_id, neighborhood, name, complement and number
     * @param int, string, string, string, string
     * @return object
     */
    public function getAdressByValues(int $city_id,string $neighborhood,string $name,string $number,$complement) {
        $return = $this->executeSelect("city_id = ? AND neighborhood = ? AND 
                                        name = ? AND number = ? AND 
                                        complement = ?",[$city_id,$neighborhood,$name,$number,$complement]);
        return $return;
    }

    /**
     * Create the new adress with values city_id, neighborhood, name, complement and number
     * @param int, string, string, string, string
     * @return int
     */
    public function createNewAdress($city_id, $neighborhood, $adress_name, $number, $complement) {
        $this->setCity_id($city_id);
        $this->setName($adress_name);
        $this->setNumber($number);
        $this->setNeighborhood($neighborhood);
        $this->setComplement($complement ?? '');
        return $this->save($this);
    }

    /**
     * Get the values when insert Adress in database
     * @return array
     */
    public function getInsertValues() {
        return [$this->city_id,$this->neighborhood,
               $this->name,$this->number,$this->complement,
               $this->created_at,$this->updated_at];
    }

    // ----- GET AND SETTERS -----

    /**
     * Get the value of city_id
     */ 
    public function getCity_id()
    {
        return $this->city_id;
    }

    /**
     * Set the value of city_id
     *
     * @return  self
     */ 
    public function setCity_id($city_id)
    {
        $this->city_id = $city_id;

        return $this;
    }

    /**
     * Get the value of neighborhood
     */ 
    public function getNeighborhood()
    {
        return $this->neighborhood;
    }

    /**
     * Set the value of neighborhood
     *
     * @return  self
     */ 
    public function setNeighborhood($neighborhood)
    {
        $this->neighborhood = $neighborhood;

        return $this;
    }

    /**
     * Get the value of name
     */ 
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */ 
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of number
     */ 
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * Set the value of number
     *
     * @return  self
     */ 
    public function setNumber($number)
    {
        $this->number = $number;

        return $this;
    }

    /**
     * Get the value of complement
     */ 
    public function getComplement()
    {
        return $this->complement;
    }

    /**
     * Set the value of complement
     *
     * @return  self
     */ 
    public function setComplement($complement)
    {
        $this->complement = $complement;

        return $this;
    }

    /**
     * Get the value of created_at
     */ 
    public function getCreated_at()
    {
        return $this->created_at;
    }

    /**
     * Set the value of created_at
     *
     * @return  self
     */ 
    public function setCreated_at($created_at)
    {
        $this->created_at = $created_at;

        return $this;
    }

    /**
     * Get the value of update_at
     */ 
    public function getUpdated_at()
    {
        return $this->updated_at;
    }

    /**
     * Set the value of update_at
     *
     * @return  self
     */ 
    public function setUpdated_at($updated_at)
    {
        $this->updated_at = $updated_at;

        return $this;
    }

    /**
     * Get the value of save
     */ 
    public function getSave()
    {
        return $this->save;
    }

    /**
     * Set the value of save
     *
     * @return  self
     */ 
    public function setSave($save)
    {
        $this->save = $save;

        return $this;
    }

}