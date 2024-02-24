<?php

namespace App\project\users;

use App\project\adress\Adress;
use App\project\model\Model;
use Exception;

class Users extends Model {

    private $adress_id;
    private $name;
    private $email;
    private $password;
    private $created_at;
    private $updated_at;

    //Value to be used when save in database
    private $save = ['adress_id','name','email','password','created_at','updated_at'];

    //Value to be used when updated in database
    private $update = ['adress_id','name','email','password','updated_at'];

    //When created get table name and get date time to put in created_at, updated_at
    function __construct() {
        parent::__construct();
        $this->table = 'users';
        $this->created_at = date("Y-m-d H:i:s");
        $this->updated_at = date("Y-m-d H:i:s");
    }

    /**
     * Get the values when insert Users in database
     * @return array
     */
    public function getInsertValues() {
        return [$this->adress_id,$this->name,
               $this->email,md5($this->password),
               $this->created_at,$this->updated_at];
    }

    /**
     * Get the values when update Users in database
     * @return array
     */
    public function getUpdateValues() {
        $this->updated_at = date("Y-m-d H:i:s");
        return [$this->adress_id,$this->name,
               $this->email,md5($this->password),
               $this->updated_at];
    }

    /**
     * Find User By email
     * @param string
     * @return array
     */
    public function verifyEmailExists($email) {
        $return = $this->executeSelect("email = ?",[$email]);
        return $return;
    }

    // ----- GET AND SETTERS -----

    /**
     * Get the value of adress_id
     */ 
    public function getAdress_id()
    {
        return $this->adress_id;
    }

    /**
     * Set the value of adress_id
     *
     * @return  self
     */ 
    public function setAdress_id($adress_id)
    {
        $this->adress_id = $adress_id;

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
     * Get the value of email
     */ 
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */ 
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of password
     */ 
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set the value of password
     *
     * @return  self
     */ 
    public function setPassword($password)
    {
        $this->password = $password;

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

    /**
     * Get the value of update
     */ 
    public function getUpdate()
    {
        return $this->update;
    }

    /**
     * Set the value of update
     *
     * @return  self
     */ 
    public function setUpdate($update)
    {
        $this->update = $update;

        return $this;
    }
}