<?php

namespace App\Http\Controllers;

use App\Models\Adress;
use Exception;
use Illuminate\Http\Request;

class AdressController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $adress = Adress::all();
            $json = $this->successCollection($adress);
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
            $adress = Adress::find($id);
            if (!$adress) $this->exception("Adress not exists");
            $json = $this->successModel($adress);
        } catch (Exception $e) {
            $json = $this->error($e);
        }

        return json_encode($json);
    }
}
