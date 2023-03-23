@extends('layouts.app')

@section('title', 'Posts')

@section('content')

    <main class="py-4">
        <div class="container mb-4">
            <div class="alert alert-secondary d-flex justify-content-between" role="alert">
                <h3>Benvenuto {{Auth::User()->name}}</h3>

                <form action="{{route('admin.posts.index')}}" method="GET" enctype="multipart/form-data" class="d-flex">
                    <input type="text" class="form-control mr-2" name="search">
                    <button class="btn btn-primary" type="submit">Cerca</button>
                </form>
                
            </div>
            <a href="{{route('admin.posts.create')}}" class="btn btn-success">Crea</a>
        </div>

        <div class="container">
            @if (count($posts) > 0)
                <table class="table text-white">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Immagine</th>
                            <th scope="col">Nome</th>
                            <th scope="col">Voto</th>
                            <th scope="col">Contenuto</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($posts as $post)
        
                            <tr class="table-active text-white">
                                <th>{{$post->id}}</th>
        
                                <td>
                                    <div class="card" style="width: 5rem;">
                                        @if ($post->cover)
                                            <img src="{{asset('storage/' . $post->cover)}}">
                                        @else
                                            <h6>immagine non è presente</h6>
                                        @endif
                                    </div>
                                </td>
        
                                <td>{{$post->nome}}</td>
                                

                                <td>
                                    @if ($post->vote == 1)
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-regular fa-star"></i>
                                        <i class="fa-regular fa-star"></i>
                                        <i class="fa-regular fa-star"></i>
                                        <i class="fa-regular fa-star"></i>
                                    @elseif ($post->vote == 2)
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-regular fa-star"></i>
                                        <i class="fa-regular fa-star"></i>
                                        <i class="fa-regular fa-star"></i>
                                    @elseif ($post->vote == 3)
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-regular fa-star"></i>
                                        <i class="fa-regular fa-star"></i>
                                    @elseif ($post->vote == 4)
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-regular fa-star"></i>
                                    @elseif ($post->vote == 5)
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                    @else
                                        <i class="fa-regular fa-star"></i>
                                        <i class="fa-regular fa-star"></i>
                                        <i class="fa-regular fa-star"></i>
                                        <i class="fa-regular fa-star"></i>
                                        <i class="fa-regular fa-star"></i>
                                    @endif
                                </td>
                                <td>{{substr($post->content, 0, 100) . '...'}}</td>

                                {{-- action --}}
                                <td>
                                    <div class="d-flex">
                                        <a class="btn btn-primary" href="{{route('admin.posts.show', ['post' => $post->id])}}">Vedi</a>
                                        <a class="btn btn-warning ms-1" href="{{route('admin.posts.edit', ['post' => $post->id])}}">Modifica</a>
        
                                        <form action="{{route('admin.posts.destroy', ['post' => $post->id])}}" method="POST">
                                            @csrf
                                            @method('DELETE')
        
                                            <button class="btn btn-danger ms-1" type="submit">Elimina</button>
                                        </form>
                                    </div>
                                </td>
        
                            </tr>
                            
                        @endforeach
                    </tbody>
                </table>
            @else
                <div class="p-3 text-primary-emphasis bg-primary-subtle border border-primary-subtle rounded-3">
                    Nessun elemento disponibile
                </div>
            @endif
        </div>
    </main>

@endsection