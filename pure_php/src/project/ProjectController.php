<?php

namespace App\project;

use App\project\model\Model;
use Exception;

class ProjectController {

    protected $model;

    /**
     * When created save the model to be used in child controller
     * @param Model (User, State, Region, Citie or Adress)
     */
    public function __construct($obj) {
        $this->model = $obj;
    }

    /**
     * Verify if $_POST is be sended by user
     * @param string, any
     */
    public function verifyPost(string $id,$else = null) {
        if (is_null($else)) return isset($_POST[$id]) ? $_POST[$id] : throw new Exception($id." dont sended");
        else return isset($_POST[$id]) ? $_POST[$id] : $else;
    }

    /**
     * Used to transform the object to be send to the user
     * @param object
     */
    public function obj($obj) {
        return json_decode($obj)[0];
    }

    /**
     * Get all values in the model is executed
     * @return array
     */
    public function getAll() {
        return $this->model->getAll();
    }

    /**
     * Get the value in database if $_GET id is passed
     * @return string or array
     */
    public function getById() {
        if (!isset($_GET['id'])) return "Error";
        $id = $_GET['id'];
        return $this->model->getById($id);
    }

}