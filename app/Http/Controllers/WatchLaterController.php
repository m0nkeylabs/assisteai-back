<?php

namespace App\Http\Controllers;

use App\Models\WatchLater;
use Illuminate\Http\Request;

class WatchLaterController extends Controller
{
    public function store(Request $request)
    {
        $watch_later = new WatchLater();
        $watch_later->movie_id = $request->input('movie_id');
        $watch_later->user_id = app('auth')->user()->id;
        $watch_later->save();

        return response()->json([
            'success' => true,
        ], 200);
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