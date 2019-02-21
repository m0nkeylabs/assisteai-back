<?php

namespace App\Http\Controllers;

use App\Models\Movie;

class MoviesController extends Controller
{
    public function index()
    {
        $columns = ['movies.id', 'movies.title', 'movies.original_title', 'movies.year', 'movies.slug', 'movies.category', 'movies.genre', 'movies.description', 'movies.poster_path', 'movies.backdrop_path'];

        $movies = Movie::select($columns)
            ->join('threads', 'movies.id', '=', 'threads.movie_id')
            ->groupBy($columns)
            ->orderBy('threads.id', 'desc')
            ->paginate(24);

        return response()->json($movies);
    }
}