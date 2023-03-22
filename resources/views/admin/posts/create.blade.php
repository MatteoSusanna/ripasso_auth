@extends('layouts.app')

@section('title', 'Crea post')

@section('content')
    <div class="container">
        <form action="{{route('admin.posts.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
    
            {{-- immagine --}}
            <div class="mb-3">
                <label for="image" class="form-label">Immagine</label>
                <input type="file" id="image" name="cover" class="form-control-file">
            </div>
    
            {{-- nome --}}
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="nome" value="{{old('name')}}">
            </div>

          
            {{-- contenuto --}}
            <div class="mb-3">
                  <label for="content" class="form-label">Contenuto</label>
                  <textarea class="form-control" name="content" id="content" cols="50" rows="7" name="content">{{old('content')}}</textarea>
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

            <button type="submit" class="btn btn-primary">Crea</button>
    
        </form>   
    </div>

@endsection