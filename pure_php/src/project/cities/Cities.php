<?php

namespace App\project\cities;

use App\project\model\Model;

class Cities extends Model {

    private $state_id;
    private $title;
    private $iso;
    private $iso_ddd;
    private $status;
    private $slug;
    private $population;
    private $lat;
    private $long;
    private $income_per_capita;

    //When created get table name
    function __construct() {
        parent::__construct();
        $this->table = 'cities';
    }

    /**
     * Verify if City exists
     * @param int
     * @return array
     */
    public function verifyCityExists($id) {
        $return = $this->executeSelect("id = ?",[$id]);
        return $return;
    }

    // ----- GET AND SETTERS -----

    /**
     * Get the value of title
     */ 
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set the value of title
     *
     * @return  self
     */ 
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get the value of state_id
     */ 
    public function getState_id()
    {
        return $this->state_id;
    }

    /**
     * Set the value of state_id
     *
     * @return  self
     */ 
    public function setState_id($state_id)
    {
        $this->state_id = $state_id;

        return $this;
    }

    /**
     * Get the value of iso
     */ 
    public function getIso()
    {
        return $this->iso;
    }

    /**
     * Set the value of iso
     *
     * @return  self
     */ 
    public function setIso($iso)
    {
        $this->iso = $iso;

        return $this;
    }

    /**
     * Get the value of iso_ddd
     */ 
    public function getIso_ddd()
    {
        return $this->iso_ddd;
    }

    /**
     * Set the value of iso_ddd
     *
     * @return  self
     */ 
    public function setIso_ddd($iso_ddd)
    {
        $this->iso_ddd = $iso_ddd;

        return $this;
    }

    /**
     * Get the value of status
     */ 
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set the value of status
     *
     * @return  self
     */ 
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get the value of slug
     */ 
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set the value of slug
     *
     * @return  self
     */ 
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get the value of population
     */ 
    public function getPopulation()
    {
        return $this->population;
    }

    /**
     * Set the value of population
     *
     * @return  self
     */ 
    public function setPopulation($population)
    {
        $this->population = $population;

        return $this;
    }

    /**
     * Get the value of lat
     */ 
    public function getLat()
    {
        return $this->lat;
    }

    /**
     * Set the value of lat
     *
     * @return  self
     */ 
    public function setLat($lat)
    {
        $this->lat = $lat;

        return $this;
    }

    /**
     * Get the value of long
     */ 
    public function getLong()
    {
        return $this->long;
    }

    /**
     * Set the value of long
     *
     * @return  self
     */ 
    public function setLong($long)
    {
        $this->long = $long;

        return $this;
    }

    /**
     * Get the value of income_per_capita
     */ 
    public function getIncome_per_capita()
    {
        return $this->income_per_capita;
    }

    /**
     * Set the value of income_per_capita
     *
     * @return  self
     */ 
    public function setIncome_per_capita($income_per_capita)
    {
        $this->income_per_capita = $income_per_capita;

        return $this;
    }

}