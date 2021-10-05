<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Thread;
use App\Services\TelegramBot;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class RatingsController extends Controller
{
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
                    'message' => 'Você já avaliou ' . $phrase . '.',
                ], 409);
            }

            $thread = new Thread();
            $thread->movie_id = $movie->id;
            $thread->user_id = $user->id;
            $thread->comment = $request->input('comment') ?? null;
            $thread->rating = $request->input('rating');
            $thread->save();
            $tb = new TelegramBot();
            $tb->sendMessage($thread);

            $movie = $movie->fresh();

            return response()->json([
                'success' => true,
                'movie' => $movie,
            ], 200);
        } catch (ValidationException $e) {
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
