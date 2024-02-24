<?php

namespace App\project\states;

use App\project\ProjectController;

class StatesController extends ProjectController {

    public function __construct() {
        parent::__construct(new States());
    }

}