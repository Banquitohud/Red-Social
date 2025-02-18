<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LocalizacionController extends Controller



{


    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        try {
            return view('auth.localizacion');
        } catch (\Throwable $th) {
            error_log("Se ha producido una excepción: " . $th->getMessage());

    }
}

}
