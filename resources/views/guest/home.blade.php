@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Home</h1>

        <a class="btn btn-primary" href="{{ route('admin.posts.index') }}">Gestisci i tuoi post</a>

        <div>
            oppure
        </div>

        <a class="btn btn-primary" href="{{ route('blog') }}">Esplora il blog</a>
    </div>
@endsection