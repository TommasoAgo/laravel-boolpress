@extends('layouts.app')

@section('content')
    <div class="container text-center">
        <h1>Home</h1>

        <a class="btn btn-primary" href="{{ route('admin.posts.index') }}">Gestisci le tue ricette</a>

        <div>
            oppure
        </div>

        <a class="btn btn-primary" href="{{ route('blog') }}">Esplora il blog</a>
    </div>
@endsection