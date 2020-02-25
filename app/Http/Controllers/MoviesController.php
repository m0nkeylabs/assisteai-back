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
        $filter = ($request->input('filter') === null) ? $request->input('filter') : json_decode(base64_decode($request->input('filter')));

        $group_by = ['movies.id', 'movies.title', 'movies.original_title', 'movies.year', 'movies.slug', 'movies.category', 'movies.genre', 'movies.description', 'movies.poster_path', 'movies.backdrop_path'];
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

        return response()->json($movies->paginate(24));
    }

    public function store(Request $request)
    {
        try {
            $this->validate($request, [
                'url' => 'required|url',
                'rating' => 'required'
            ]);

            $movie = Movie::getOrCreate($request->input('url'));
            $user = $request->user();

            $thread = Thread::where('movie_id', '=', $movie->id)
                ->where('user_id', '=', $user->id)
                ->first();

            if ($thread !== null) {
                $phrase = ($movie->category === 'MOVIE') ? 'esse filme' : 'essa série';
                return response()->json([
                    'success' => false,
                    'message' => 'Você já avaliou ' . $phrase . '!',
                ], 409);
            }

            $thread = new Thread();
            $thread->movie_id = $movie->id;
            $thread->user_id = $user->id;
            $thread->comment = $request->input('comment');
            $thread->rating = $request->input('rating');
            $thread->save();

            $movie = $movie->fresh();

            return response()->json([
                'success' => true,
                'movie' => $movie,
            ], 200);
        } catch(ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => $e->validator->getMessageBag()->first(),
            ], 422);
        } catch (\Exception $e) {
            \Log::error('MoviesController@store', [$e]);

            return response()->json([
                'success' => false,
                'message' => ($e->getCode() === 1) ? $e->getMessage() : 'Erro catastrófico.',
            ], 500);
        }
    }
}
