<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;

class MoviesController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('q');
        $filter = ($request->input('filter') === null) ? $request->input('filter') : json_decode(base64_decode($request->input('filter')));

        $columns = ['movies.id', 'movies.title', 'movies.original_title', 'movies.year', 'movies.slug', 'movies.category', 'movies.genre', 'movies.description', 'movies.poster_path', 'movies.backdrop_path'];

        $movies = Movie::select($columns)
            ->join('threads', 'movies.id', '=', 'threads.movie_id')
            ->groupBy($columns)
            ->orderBy('threads.created_at', 'desc');

        if ($filter) {
            if (isset($filter->ratings) && !empty($filter->ratings)) {
                $movies->whereHas('threads', function ($query) use ($filter) {
                    $query->whereIn('rating', $filter->ratings);
                });
            }

            if (isset($filter->categories) && !empty($filter->categories)) {
                $movies->whereIn('category', $filter->categories);
            }
        }

        if ($query) {
            $movies->where('title', 'like', '%' . $query . '%')
                ->orWhere('original_title', 'like', '%' . $query . '%')
                ->orWhere('year', '=', $query);
        }

        return response()->json($movies->paginate(24));
    }
}