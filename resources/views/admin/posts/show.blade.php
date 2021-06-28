@extends('layouts.app')

@section('content')
    <div class="container">
        <h1> {{ $post->title }} </h1>

        {{-- Inseriamo l'immagine caricata dall'utente --}}
        <div>
            <img src="{{ asset('storage/' . $post->cover) }}" alt="{{ $post->title }}">
        </div>

        {{-- Come nello show in Guest, faccio un if per verificare se il post ha la categoria --}}
        @if ($post->category)
        <div class="mt-2 mb-2">
            Categoria :{{ $post->category->name }}
        </div>
        
        @endif

        {{-- Tags --}}
        <div class="mt-2 mb-2">
            <strong>Tags:</strong>
            @foreach ($post_tags as $tag)
                {{ $tag->name }}{{ $loop->last ? '' : ', ' }}
            @endforeach
        </div>
        
        <p>
            {{ $post->content }}
        </p>
    </div>
@endsection