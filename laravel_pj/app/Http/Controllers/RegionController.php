<?php

namespace App\Http\Controllers;

use App\Models\Region;
use Exception;
use Illuminate\Http\Request;

class RegionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $region = Region::all();
            $json = $this->successCollection($region);
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
            $region = Region::find($id);
            if (!$region) $this->exception("Region not exists");
            $json = $this->successModel($region);
        } catch (Exception $e) {
            $json = $this->error($e);
        }

        return json_encode($json);
    }
}
