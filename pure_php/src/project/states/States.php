<?php

namespace App\project\states;

use App\project\model\Model;

class States extends Model {

    private $region_id;
    private $title;
    private $letter;
    private $iso;
    private $slug;
    private $population;

    //When created get table name and get date time to put in created_at, updated_at
    function __construct() {
        parent::__construct();
        $this->table = 'states';
    }

    // ----- GET AND SETTERS -----

    /**
     * Get the value of region_id
     */ 
    public function getRegion_id()
    {
        return $this->region_id;
    }

    /**
     * Set the value of region_id
     *
     * @return  self
     */ 
    public function setRegion_id($region_id)
    {
        $this->region_id = $region_id;

        return $this;
    }

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
     * Get the value of letter
     */ 
    public function getLetter()
    {
        return $this->letter;
    }

    /**
     * Set the value of letter
     *
     * @return  self
     */ 
    public function setLetter($letter)
    {
        $this->letter = $letter;

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

}