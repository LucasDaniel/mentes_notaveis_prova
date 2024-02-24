<?php

namespace App\Http\Controllers;

use App\Models\Cities;
use Exception;
use Illuminate\Http\Request;

class CitiesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $cities = Cities::all();
            $json = $this->successCollection($cities);
        } catch (Exception $e) {
            $json = $this->error($e);
        }

        return json_encode($json);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $cities = Cities::find($id);
            if (!$cities) $this->exception("Cities not exists");
            $json = $this->successModel($cities);
        } catch (Exception $e) {
            $json = $this->error($e);
        }

        return json_encode($json);
    }
}
