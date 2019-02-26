<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;

class MoviesController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('q');

        $columns = ['movies.id', 'movies.title', 'movies.original_title', 'movies.year', 'movies.slug', 'movies.category', 'movies.genre', 'movies.description', 'movies.poster_path', 'movies.backdrop_path'];

        $movies = Movie::select($columns)
            ->join('threads', 'movies.id', '=', 'threads.movie_id')
            ->groupBy($columns)
            ->orderBy('threads.created_at', 'desc');

        if ($query) {
            $movies->where('title', 'like', '%' . $query . '%')
                ->orWhere('original_title', 'like', '%' . $query . '%')
                ->orWhere('year', '=', $query)
                ->orWhere('description', 'like', '%' . $query . '%');
        }

        return response()->json($movies->paginate(24));
    }
}