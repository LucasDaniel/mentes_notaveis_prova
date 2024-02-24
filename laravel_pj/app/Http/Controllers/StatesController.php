<?php

namespace App\Http\Controllers;

use App\Models\States;
use Exception;

class StatesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $states = States::all();
            $json = $this->successCollection($states);
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
            $states = States::find($id);
            if (!$states) $this->exception("States not exists");
            $json = $this->successModel($states);
        } catch (Exception $e) {
            $json = $this->error($e);
        }

        return json_encode($json);
    }

}
