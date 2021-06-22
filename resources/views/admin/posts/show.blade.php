@extends('layouts.app')

@section('content')
    <div class="container">
        <h1> {{ $post->title }} </h1>

        {{-- Come nello show in Guest, faccio un if per verificare se il post ha la categoria --}}
        @if ($post->category)
        <div class="mt-2 mb-2">
            Categoria :{{ $post->category->name }}
        </div>
        
        @endif

        <p>
            {{ $post->content }}
        </p>
    </div>
@endsection