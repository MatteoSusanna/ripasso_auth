<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Post;

class AnimeController extends Controller
{
    public function index(){

        $anime = Post::All();

        $anime->each(function($anime) {
            if ($anime->cover) {
                $anime->cover = asset('storage/' . $anime->cover);
            } else {
                $anime->cover = asset('img/no_cover.jpg');
            }
        });

        return response()->json([
            'status' => true,
            'results' => $anime,
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
