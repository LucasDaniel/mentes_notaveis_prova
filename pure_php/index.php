<?php

require_once realpath("vendor/autoload.php");

/**
 * Load ENV file
 * $_ENV['VALUE_OF_ENV']
 */
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$api = [];
$api['database'] = function ($function) {
    $c = new \App\data\Database();
    switch ($function) {
        case 'migrate':
            echo $c->migrate();
            break;
        case 'seeder':
            echo $c->seeder();
            break;
        default:
            echo "Function not found";
            break;
    }
};
$api['user'] = function ($function) {
    $c = new \App\project\users\UsersController();
    switch ($function) {
        case 'getAll':
            echo $c->getAll();
            break;
        case 'getById':
            echo $c->getById();
            break;
        case 'show':
            echo $c->show();
            break;
        case 'store':
            echo $c->store();
            break;
        case 'update':
            echo $c->update();
            break;
        case 'delete':
            echo $c->destroy();
            break;
        default:
            echo "Function not found";
            break;
    }
};
$api['adress'] = function ($function) {
    $c = new \App\project\adress\AdressController();
    switch ($function) {
        case 'getAll':
            echo $c->getAll();
            break;
        case 'getById':
            echo $c->getById();
            break;
        default:
            echo "Function not found";
            break;
    }
};
$api['region'] = function ($function) {
    $c = new \App\project\region\RegionController();
    switch ($function) {
        case 'getAll':
            echo $c->getAll();
            break;
        case 'getById':
            echo $c->getById();
            break;
        default:
            echo "Function not found";
            break;
    }
};
$api['states'] = function ($function) {
    $c = new \App\project\states\StatesController();
    switch ($function) {
        case 'getAll':
            echo $c->getAll();
            break;
        case 'getById':
            echo $c->getById();
            break;
        default:
            echo "Function not found";
            break;
    }
};
$api['cities'] = function ($function) {
    $c = new \App\project\cities\CitiesController();
    switch ($function) {
        case 'getAll':
            echo $c->getAll();
            break;
        case 'getById':
            echo $c->getById();
            break;
        default:
            echo "Function not found";
            break;
    }
};

$args = explode("&",$_SERVER['QUERY_STRING']);
$controller = explode("=",$args[0]);
$function = explode("=",$args[1]);

$api[$controller[1]]($function[1]);
