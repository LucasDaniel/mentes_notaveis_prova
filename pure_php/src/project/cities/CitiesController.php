<?php

namespace App\project\cities;

use App\project\ProjectController;

class CitiesController extends ProjectController {

    public function __construct() {
        parent::__construct(new Cities());
    }

}