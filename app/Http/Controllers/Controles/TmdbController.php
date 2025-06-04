<?php

namespace App\Http\Controllers\Controles;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TmdbController extends Controller
{
    public function index()
    {
        return view('tmdb.index');
    }
}