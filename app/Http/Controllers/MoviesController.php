<?php

namespace App\Http\Controllers;

use App\Models\Movie;

class MoviesController extends Controller
{
    public function index()
    {
        $movies = Movie::select('movies.*')
            ->join('threads', 'movies.id', '=', 'threads.movie_id')
            ->orderBy('threads.id', 'desc')
            ->paginate(24);

        return response()->json($movies);
    }
}