<?php

namespace App\Http\Controllers;

use App\Models\Movie;

class MoviesController extends Controller
{
    public function index()
    {
        $movies = Movie::paginate(24);

        return response()->json($movies);
    }
}