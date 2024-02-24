<?php

namespace App\project\users;

use App\project\adress\Adress;
use App\project\cities\Cities;
use App\project\ProjectController;
use Exception;

class UsersController extends ProjectController {

    public function __construct() {
        parent::__construct(new Users());
    }

    /**
     * Display the specified resource.
     */
    public function show() {
        try {
            if (!isset($_GET['id'])) throw new Exception("Id not found!");
            $id = $_GET['id'];
            $user = $this->model->getById($id);
            $adress = new Adress();
            $adress = $adress->getById($this->obj($user)->adress_id);
            $this->model->json->user = json_decode($user);
            $this->model->json->adress = json_decode($adress);
        } catch (Exception $e) {
            $this->model->json = $e->getMessage();
        }
        return json_encode($this->model->json);
    }

    public function store() {
        try {

            $this->model->setEmail($this->verifyPost('email'));

            //Verify if email exists in database
            if ($this->model->verifyEmailExists($this->model->getEmail())) {
                throw new Exception("Email already exists!");
            }
            $this->model->setName($this->verifyPost('name'));
            $this->model->setPassword($this->verifyPost('password'));
            
            $city = new Cities();
            $city_id = $this->verifyPost('city_id');

            //Verify if city exists in database
            if (!$city->verifyCityExists($city_id)) {
                throw new Exception("City not exists!");
            }
            
            //Create the new Adress
            $neighborhood = $this->verifyPost('neighborhood');
            $adress_name = $this->verifyPost('adress_name');
            $number = $this->verifyPost('number');
            $complement = $this->verifyPost('complement','');
            
            //Get the adress in database or create if not exists
            $this->model->setAdress_id($this->createOrGetAdress($city_id, $neighborhood,
                                                                $adress_name, $number,
                                                                $complement));
            
            //Save user
            $return = (int)$this->model->save($this->model);

        } catch (Exception $e) {
            $return = $e->getMessage();
        }
        return json_encode($return);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update()
    {

        try {

            //Verify if id is seted in $_GET
            if (!isset($_GET['id'])) throw new Exception("Id not found!");
            $id = $_GET['id'];

            $city = new Cities();
            $city_id = $this->verifyPost('city_id');
            //Verify if city exists in database
            if (!$city->verifyCityExists($city_id)) {
                throw new Exception("City not exists!");
            }

            //Verify if user changed exists
            $user = json_decode($this->model->getById($id));
            if (!$user) {
                throw new Exception("User not exists");
            }
            
            //Save the new values of users or get the old values
            $this->model->setName($this->verifyPost('name',$user->name));
            $this->model->setEmail($this->verifyPost('email',$user->email));
            $this->model->setPassword(md5($this->verifyPost('password',$user->password)));

            //Get the adress in database or create if not exists
            $neighborhood = $this->verifyPost('neighborhood');
            $adress_name = $this->verifyPost('adress_name');
            $number = $this->verifyPost('number');
            $complement = $this->verifyPost('complement','');
            $this->model->setAdress_id($this->createOrGetAdress($city_id, $neighborhood,
                                                                $adress_name, $number,
                                                                $complement));

            //Update user
            $return = (int)$this->model->update($this->model,[$id],['id']);

        } catch (Exception $e) {
            $return = $e->getMessage();
        }

        return json_encode($return);
    
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy()
    {
        try {

            //Verify if id is seted in $_GET
            if (!isset($_GET['id'])) throw new Exception("Id not found!");
            $id = $_GET['id'];

            //Verify if user changed exists
            $user = json_decode($this->model->getById($id));
            if (!$user) {
                throw new Exception("User not exists");
            }

            //Delete user
            $return = $this->model->delete([$id],['id']);
            
        } catch (Exception $e) {
            $return = $e->getMessage();
        }
        return json_encode($return);
    }

    /**
     * Create the new Adress or Create a new Adress
     * @param int, string, string, string, string
     * @return int  
     */
    private function createOrGetAdress($city_id, $neighborhood, $adress_name, $number, $complement = '') {
        $adress = new Adress();
        
        $adress = $adress->getAdressByValues($city_id, $neighborhood, $adress_name, $number, $complement);
        if (is_countable($adress)) {
            if (count($adress) > 0) {
                return $this->obj(json_encode($adress))->id;
            } else {    
                $adress = new Adress();                                                
                return $adress->createNewAdress($city_id, $neighborhood, $adress_name, $number, $complement);
            }
        } else {
            throw new Exception("Error When verify Adress");
        }
        return "Error When verify Adress";
        
    }

}