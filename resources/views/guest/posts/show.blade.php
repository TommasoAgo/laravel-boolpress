@extends('layouts.app')

@section('content')
    <div class="container">
        {{-- Titolo --}}
        <h1> {{ $post->title }} </h1>

        {{-- Faccio un if per verificare che il post abbia effettivamente la sua categoria --}}
        @if($post->category)

        {{-- Category --}}
        {{-- La categoria è la foreign key di ogni singolo Post --}}
        <div class="mt-2 mb-2">
            Categoria: {{ $post->category->name }}
        </div>
        @endif

        {{-- Tags --}}
        @if ($post->tags)
        <div class="mt-2 mb-2">
            <strong>Tags:</strong>
            @foreach ($post_tags as $tag)
                {{ $tag->name }}{{ $loop->last ? '' : ', ' }}
            @endforeach
        </div>
         
        @endif
 

        {{-- Content --}}
        <p> {{ $post->content }} </p>
    </div>
@endsection