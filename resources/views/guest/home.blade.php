@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Home</h1>

        <a href="{{ route('admin.posts.index') }}">Accedi</a>

        <div>
            oppure
        </div>

        <a href="{{ route('guest.posts.index') }}">Esplora il blog</a>
    </div>
@endsection