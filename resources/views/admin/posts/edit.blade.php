@extends('layouts.app')

@section('title', 'Modifica post')

@section('content')

    <div class="container text-white">
        
        <form action="{{route('admin.posts.update', ['post' => $post->id])}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="card" style="width: 5rem;">
                @if ($post->cover)
                    <img src="{{asset('storage/' . $post->cover)}}">
                @else
                    <h6>immagine non è presente</h6>
                @endif
            </div>

            {{-- immagine --}}
            <div class="mb-3">
                <label for="image" class="form-label">Immagine</label>
                <input type="file" id="image" name="cover" class="form-control-file">
            </div>
    
            {{-- nome --}}
            <div class="mb-3">
                <label for="name" class="form-label" >Name</label>
                <input type="text" class="form-control" id="name" name="nome" value="{{old('nome', $post->nome)}}">
            </div>
        
            {{-- contenuto --}}
            <div class="mb-3">
                <label for="content" class="form-label">Contenuto</label>
                <textarea class="form-control" name="content" id="content" cols="50" rows="7" name="content">{{old('content', $post->content)}}</textarea>
            </div>

            {{-- voto --}}
            <select class="form-select mb-3" name="vote">
                <option selected>Scegli un voto da 1 a 5</option>
                <option value="1" required>1</option>
                <option value="2" required>2</option>
                <option value="3" required>3</option>
                <option value="4" required>4</option>
                <option value="5" required>5</option>
            </select>
    
            <button type="submit" class="btn btn-primary">Modifica</button>
            <a type="submit" class="btn btn-primary" href="{{route('admin.posts.index')}}">Indietro</a>
    
        </form>
    </div>

@endsection