@extends('layouts.app')

@section('title', 'Singolo Post')

@section('content')
    <div class="container d-flex justify-content-center align-items-center flex-column">

        <div class="card mb-5" style="width: 30rem;">
            <img src="{{asset('storage/' . $post->cover)}}" class="card-img-top" alt="{{$post->nome}}">
            <div class="card-body">
                <h5 class="card-title">{{$post->nome}}</h5>
                <p class="card-text">{{$post->content}}</p>
            </div>
        </div>
        <a class="btn btn-primary" href="{{route('admin.posts.index')}}">Indietro</a>
    </div>
        
@endsection