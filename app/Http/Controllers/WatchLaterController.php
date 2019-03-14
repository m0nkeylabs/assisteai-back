<?php

namespace App\Http\Controllers;

use App\Models\WatchLater;
use Illuminate\Http\Request;

class WatchLaterController extends Controller
{
    public function store(Request $request)
    {
        try {
            $watch_later = WatchLater::firstOrCreate(['movie_id' => $request->input('movie_id'), 'user_id' => app('auth')->user()->id]);

            return response()->json([
                'success' => true,
                'movie' => $watch_later->movie,
            ], 200);
        } catch (\Exception $e) {
            \Log::error('WatchLaterController@store', [$e]);

            return response()->json([
                'success' => false,
                'message' => 'Erro catastrófico.',
            ]);
        }

    }

    public function destroy($movie_id)
    {
        $query = 'DELETE FROM watch_later WHERE movie_id = ? AND user_id = ?';

        \DB::delete($query, [$movie_id, app('auth')->user()->id]);

        return response()->json([
            'success' => true,
        ], 200);
    }
}