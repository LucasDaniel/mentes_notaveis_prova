<?php

namespace App\project\adress;

use App\project\ProjectController;

class AdressController extends ProjectController {

    public function __construct() {
        parent::__construct(new Adress());
    }

}