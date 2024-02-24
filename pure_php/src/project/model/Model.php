<?php

namespace App\project\model;

use App\data\Database;
use Exception;
use PDO;
use stdClass;

class Model {

    protected $id;
    protected $pdo;
    protected $table;
    public $json;

    /**
     * When create a Model, get the database connection and 
     * create a stdClass to be used when need send something to user
     */
    public function __construct() {
        $database = new Database();
        $this->pdo = $database->getPdo();
        $this->json = new stdClass();
    }

    /**
     * Execute select query when where and params
     * @param string, array
     * @return array
     */
    protected function executeSelect(string $sql="1=1",array $params=[]) {
        try {
            $sql = "SELECT * FROM ".$this->table." WHERE ".$sql;
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute($params);
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            $this->json = $e->getMessage();
            return $this->json;
        }
        return $stmt->fetchAll();
    }

    /**
     * Execute insert query when where and params
     * @param string, array
     * @return int
     */
    protected function executeInsert(string $sql,array $params) {
        try {
            $sql = "INSERT INTO ".$this->table." ".$sql;
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute($params);
            $return = $this->pdo->lastInsertId();
        } catch (Exception $e) {
            $this->json = $e->getMessage();
            return $this->json;
        }
        return $return;
    }

    /**
     * Execute update query whith values
     * @param string, array
     * @return string
     */
    protected function executeUpdate(string $sql, array $params) {
        try {
            $sql = "UPDATE ".$this->table." SET ".$sql;
            $stmt= $this->pdo->prepare($sql);
            $return = $stmt->execute($params);
        } catch (Exception $e) {
            $this->json = $e->getMessage();
            return $this->json;
        }
        return $return;
    }

    /**
     * Execute delete query when where and params
     * @param string, array
     * @return bool
     */
    protected function executeDelete(string $sql, array $params) {
        try {
            $sql = "DELETE FROM ".$this->table." WHERE ".$sql;
            $stmt= $this->pdo->prepare($sql);
            $return = $stmt->execute($params);
        } catch (Exception $e) {
            $this->json = $e->getMessage();
            return $this->json;
        }
        return $return;
    }

    /**
     * Get all values from table model
     * @return json
     */
    public function getAll() {
        $return = $this->executeSelect();
        return json_encode($return);
    }

    /**
     * Get value when id is equal from table model
     * @return json
     */
    public function getById($id) {
        $return = $this->executeSelect("id = ?",[$id]);
        return json_encode($return);
    }

    /**
     * Create the insert value query from model
     * @param Model
     * @return int
     */
    public function save($model) {
        $columns = $model->getSave();
        $inserts = $columns[0];
        $params = "?";
        $arrBind = $model->getInsertValues();
        for ($i = 1; $i < count($columns); $i++) {
            $inserts .= ",".$columns[$i];
            $params .= ",?";
        }
        $inserts = "(".$inserts.") VALUES (".$params.")";
        return $this->executeInsert($inserts,$arrBind);
    }

    /**
     * Create the update value query from model, where stetament is used just with '='
     * @param Model, array, array
     * @return string
     */
    public function update($model,$values,$where) {
        $columns = $model->getUpdate();
        $set = $columns[0];
        $arrBind = $model->getUpdateValues();
        for ($i = 0; $i < count($values); $i++) {
            $arrBind[] = $values[$i];
        }
        for ($i = 1; $i < count($columns); $i++) {
            $set .= "=?,".$columns[$i];
        }
        $set .= "=? WHERE ";
        $set .= $where[0];
        for ($i = 1; $i < count($where); $i++) {
            $set .= "=?,".$where[$i];
        }
        $set .= "=?";
        return $this->executeUpdate($set,$arrBind);
    }

    /**
     * Create the delete value query from model
     * @param Model, array, array
     * @return bool
     */
    public function delete($values,$where) {
        $arrBind = [];
        for ($i = 0; $i < count($values); $i++) {
            $arrBind[] = $values[$i];
        }
        $set = $where[0];
        for ($i = 1; $i < count($where); $i++) {
            $set .= "=?,".$where[$i];
        }
        $set .= "=?";
        return $this->executeDelete($set,$arrBind);
    }   

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the value of table
     */ 
    public function getTable()
    {
        return $this->table;
    }

}