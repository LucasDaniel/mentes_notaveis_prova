<?php

namespace App\project\region;

use App\project\model\Model;

class Region extends Model {

    protected $title;
    protected $slug;

    //When created get table name
    function __construct() {
        parent::__construct();
        $this->table = 'region';
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

}