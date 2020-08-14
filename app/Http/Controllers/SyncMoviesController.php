<?php

namespace App\Http\Controllers;

use App\Models\ExternalId;
use App\Models\Movie;

class SyncMoviesController extends Controller
{
    public function sync()
    {
        dd('Whoa!');
        $data = ExternalId::where('name', '=', 'tmdb')->with('movie')->offset(480)->limit(150)->get();
        // dd($data->toArray());
        $new_data = [];
        foreach($data as $d) {
            // dd($d->movie->id);
            $url = 'http://api.themoviedb.org/3/' . $d->movie->category . '/' . $d->external_id . '?language=pt_BR&api_key=' . env('TMDB_API_KEY');
            // dd($url);
            $tmdb_result_original = self::callCurl($url);
            // dd($tmdb_result_original);
            $d->movie->title = isset($tmdb_result_original->title) ? $tmdb_result_original->title : $tmdb_result_original->name;
            $d->movie->genre = implode(',', array_map(function ($object) { return $object->name; }, $tmdb_result_original->genres));
            $d->movie->description = $tmdb_result_original->overview;
            // $d->movie->poster_path = $tmdb_result_original->poster_path;
            // $d->movie->backdrop_path = $tmdb_result_original->backdrop_path;
            // $d->movie->original_description = $tmdb_result_original->overview;
            $d->movie->save();
            $new_data[] = $d->movie;
        }
        dd($new_data);
    }

    /**
     * @param $url
     * @return mixed
     */
    private static function callCurl($url)
    {
        $ch = curl_init($url);
        curl_setopt_array($ch, [
            CURLOPT_POST => false,
            CURLOPT_RETURNTRANSFER => true,
        ]);
        $result = json_decode(curl_exec($ch));
        curl_close($ch);

        return $result;
    }
}