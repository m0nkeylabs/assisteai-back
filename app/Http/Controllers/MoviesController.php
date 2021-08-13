<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Thread;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class MoviesController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('q');
        $per_page = (int) ($request->input('per_page') ?? 24);
        $filter = ($request->input('filter') === null) ? $request->input('filter') : json_decode(base64_decode($request->input('filter')));

        $group_by = [
            'movies.id',
            'movies.title',
            'movies.original_title',
            'movies.year',
            'movies.slug',
            'movies.category',
            'movies.genre',
            'movies.description',
            'movies.poster_path',
            'movies.backdrop_path'
        ];
        $select = [\DB::raw('MAX(`threads`.`created_at`) AS \'last_thread\'')];

        $movies = Movie::select(array_merge($group_by, $select))
            ->join('threads', 'movies.id', '=', 'threads.movie_id')
            ->groupBy($group_by)
            ->orderBy('last_thread', 'desc');

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

        return response()->json($movies->paginate($per_page));
    }

    public function randomMovie()
    {
        try {
            $movie = Movie::whereNotNull('backdrop_path')->whereHas('threads', function ($query) {
                return $query->whereIn('rating', ['UNMISSABLE', 'VERY_GOOD', 'GOOD', 'COOL']);
            })->inRandomOrder()->limit(1)->first();

            $data = $this->getMovieData($movie);

            return response()->json([
                'success' => true,
                'data' => $data,
            ]);
        } catch (\Exception $e) {
            \Log::error('MoviesController@randomMovie', [$e]);

            return response()->json([
                'success' => false,
                'message' => 'Erro catastrófico.',
            ]);
        }
    }

    public function details(int $id)
    {
        try {
            $movie = Movie::where('id', '=', $id)->with(['threads', 'threads.user'])->firstOrFail();

            $data = $this->getMovieData($movie);

            return response()->json([
                'success' => true,
                'data' => $data,
            ]);
        } catch (\Exception $e) {
            \Log::error('MoviesController@details', [$e]);

            return response()->json([
                'success' => false,
                'message' => 'Erro catastrófico.',
            ]);
        }
    }

    protected function getMovieData($movie)
    {
        return [
            'backdrop_path' => $movie->backdrop_path,
            'original_title' => $movie->original_title,
            'description' => $movie->description,
            'poster_path' => $movie->poster_path,
            'title' => $movie->title,
            'genre' => $movie->genre,
            'year' => $movie->year,
            'rating' => [
                'count' => $movie->rating_count,
                'average' => $movie->average_rating,
                'last' => $movie->last_rating,
                'list' => $movie->threads,
            ],
        ];
    }
}
