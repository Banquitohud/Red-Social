<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LocalizacionController extends Controller
{
    public function index()
    {
        return view('auth/localizacion'); // Asegúrate de que esta vista existe en resources/views/localizacion.blade.php
    }
}

