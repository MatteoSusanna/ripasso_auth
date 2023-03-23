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
                <input type="file" id="image" name="cover" class="form-control-file @error('cover') is-invalid @enderror">

                @error('cover')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
    
            {{-- nome --}}
            <div class="mb-3">
                <label for="name" class="form-label" >Name</label>
                <input type="text" class="form-control @error('nome') is-invalid @enderror" id="name" name="nome" value="{{old('nome', $post->nome)}}">

                @error('nome')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
        
            {{-- contenuto --}}
            <div class="mb-3">
                <label for="content" class="form-label">Contenuto</label>
                <textarea class="form-control @error('content') is-invalid @enderror" name="content" id="content" cols="50" rows="7" name="content">{{old('content', $post->content)}}</textarea>

                @error('content')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            {{-- categorie --}}
            <div class="d-flex">
                @foreach ($categories as $category)
                    <div class="form-group form-check mr-4">
                        <input {{(in_array($category->id, old('categories', [])))? 'checked': ''}} type="checkbox" class="form-check-input" id="category_{{$category->id}}" name="categories[]" value="{{$category->id}}">
                        <label class="form-check-label" for="category_{{$category->id}}"><strong>{{$category->nome}}</strong></label>
                    </div>
                @endforeach
            </div>

            {{-- voto --}}
            <div class="mb-3">
                <label for="voto">Scegli un voto da 1 a 5</label>
                <select id="voto" class="form-select @error('vote') is-invalid @enderror" name="vote">
                    <option value="1" required>1</option>
                    <option value="2" required>2</option>
                    <option value="3" required>3</option>
                    <option value="4" required>4</option>
                    <option value="5" required>5</option>
                </select>
    
                @error('vote')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
    
            <button type="submit" class="btn btn-primary">Modifica</button>
            <a type="submit" class="btn btn-primary" href="{{route('admin.posts.index')}}">Indietro</a>
    
        </form>
    </div>

@endsection