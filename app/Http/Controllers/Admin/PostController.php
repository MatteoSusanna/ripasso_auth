<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use App\Post;
use Illuminate\Support\Str;
use Facade\Ignition\Exceptions\ViewException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = $request->all();

        

        if(!array_key_exists('search', $data) ){
            $posts = Post::orderBy('id', 'desc')->get();
        }else{
            $posts = Post::orderBy('id', 'desc')->where('nome', 'LIKE', '%' . $data["search"] . '%')->get();
        }

        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.posts.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $request->validate([
            'nome' => 'required|min:2|max:40',
            'content' => 'required|min:5|max:2000',
            'cover' => 'nullable|image|max:10000',
            'vote' => 'required',
        ],
        [
            'nome.required' => 'Il nome dell\'anime è obligatorio',
            'nome.min' => 'Il nome dell\'anime è compreso tra i 2 e i 40 caratteri',
            'nome.max' => 'Il nome dell\'anime è compreso tra i 2 e i 40 caratteri',

            'content.required' => 'Il nome dell\'anime è obligatorio',
            'content.min' => 'Il nome dell\'anime è compreso tra i 5 e i 2000 caratteri',
            'content.max' => 'Il nome dell\'anime è compreso tra i 5 e i 2000 caratteri',

            'cover.image' => "Il file selezionato deve essere un'immagine",
            'cover.max' => "L'immagine selezionata deve avere una dimensione massima di 10Mb",

            'vote.required' => 'Il voto è obligatorio'
        ]);

        $post = new Post();
        $post->fill($data);
        $post->save();
        
        /* slug */
        $slug = Str::slug($post->nome . '-' . $post->id, '-'); 
        $post->slug = $slug;
        $post->save();

        /* immagine */
        if(array_key_exists('cover', $data)){
            $img_path = Storage::put('uploads', $data['cover']);
            $post->cover = $img_path;
            $post->save();
        }

        /* Categorie */
        if(array_key_exists('categories', $data)){
            $post->categories()->sync($data['categories']);
        }

        return redirect()->route('admin.posts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $categories = Category::all();
        return view('admin.posts.edit', compact('post', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $data = $request->all();

        $request->validate([
            'nome' => 'required|min:2|max:40',
            'content' => 'required|min:5|max:2000',
            'cover' => 'nullable|image|max:10000',
        ],
        [
            'nome.required' => 'Il nome dell\'anime è obligatorio',
            'nome.min' => 'Il nome dell\'anime è compreso tra i 2 e i 40 caratteri',
            'nome.max' => 'Il nome dell\'anime è compreso tra i 2 e i 40 caratteri',

            'content.required' => 'Il nome dell\'anime è obligatorio',
            'content.min' => 'Il nome dell\'anime è compreso tra i 5 e i 2000 caratteri',
            'content.max' => 'Il nome dell\'anime è compreso tra i 5 e i 2000 caratteri',

            'cover.image' => "Il file selezionato deve essere un'immagine",
            'cover.max' => "L'immagine selezionata deve avere una dimensione massima di 10Mb",
        ]);

        if(array_key_exists('cover', $data)){
            
            if($post->cover){
                Storage::delete($post->cover);
            }

            $img_path = Storage::put('uploads', $data['cover']);
            $data['cover'] = $img_path;
        }

        $post->update($data);
        $post->save();

        $slug = Str::slug($post->nome . '-' . $post->id, '-'); 
        $post->slug = $slug;
        $post->save();

        if(array_key_exists('categories', $data)){
            $post->categories()->sync($data['categories']);
        }else{
            $post->categories()->sync([]);
        }

        return redirect()->route('admin.posts.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->categories()->sync([]);
        $post->delete();

        return redirect()->route('admin.posts.index');
    }
}
