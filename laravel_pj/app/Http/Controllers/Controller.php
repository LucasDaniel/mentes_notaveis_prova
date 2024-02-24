<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    /**
     * Standardize feedback to the customer with status data, a message, and data
     * @param String, any, any
     * @return array
     */
    protected function createJson(string $msg, $status, $data = null): array {
        return [
            'msg' => $msg,
            'status' => $status,
            'data' => $data
        ];
    }

    /**
     * Returns a success message and a collection
     * @param Collection
     * @return array
     */
    protected function successCollection(Collection $collection): array {
        return $this->createJson('Success', 200, $collection);
    }

    /**
     * Returns a success message and a model
     * @param Model
     * @return array
     */
    protected function successModel(Model $model): array {
        return $this->createJson('Success', 200, $model);
    }

    /**
     * Returns a success message and a array
     * @param array
     * @return array
     */
    protected function successArray(array $array): array {
        return $this->createJson('Success', 200, $array);
    }

    /**
     * Returns a error message and the code
     * @param Exception
     * @return array
     */
    protected function error(Exception $e) {
        return $this->createJson($e->getMessage(), $e->getCode());
    }

    /**
     * Send exception to system
     * @param string
     */
    protected function exception(string $msg) {
        throw new Exception($msg);
    }
}
