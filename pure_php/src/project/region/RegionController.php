<?php

namespace App\project\region;

use App\project\ProjectController;

class RegionController extends ProjectController {

    public function __construct() {
        parent::__construct(new Region());
    }

}