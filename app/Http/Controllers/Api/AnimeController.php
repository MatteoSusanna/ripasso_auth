<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Post;

class AnimeController extends Controller
{
    public function index(){

        $anime = Post::where('visionato', 'si')->paginate(6);
        $inCorsoAnime = Post::where('visionato', 'no')->get();

        $anime->each(function($anime) {
            if ($anime->cover) {
                $anime->cover = asset('storage/' . $anime->cover);
            } else {
                $anime->cover = asset('img/no_cover.jpg');
            }
        });

        $inCorsoAnime->each(function($anime) {
            if ($anime->cover) {
                $anime->cover = asset('storage/' . $anime->cover);
            } else {
                $anime->cover = asset('img/no_cover.jpg');
            }
        });

        return response()->json([
            'status' => true,
            'results' => $anime,
            'secondResults' => $inCorsoAnime,
        ]);

    }

    public function show($slug){

        $anime = Post::where('slug', $slug)->with(['categories'])->firstOrFail();

        if($anime->cover){
            $anime->cover = asset('storage/' . $anime->cover);
        }

        return response()->json([
            'success' => true,
            'results' => $anime
        ]);

    }
}
