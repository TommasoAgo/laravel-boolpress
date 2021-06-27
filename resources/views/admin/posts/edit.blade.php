@extends('layouts.app')

@section('content')
        
    <div class="container">

        <h1>Modifica il Post: {{ $post->title }}</h1>

        {{-- Validator Errors --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
                </ul>
            </div>
        @endif

        {{-- EDIT Form --}}
        <form action=" {{ route('admin.posts.update', [ 'post' => $post->id ]) }} " method="post">
            @csrf
            @method('PUT')

            {{-- Title --}}
            <div class="form-group">
                <label for="title">Titolo</label>
                <input type="text" class="form-control" name="title" id="title" value="{{ old('title', $post->title) }}">
            </div>

            {{-- Content --}}
            <div class="form-group">
                <label for="content">Contenuto del post</label>
                <textarea name="content" class="form-control" id="content" cols="30" rows="10">{{ old('content', $post->content) }}</textarea>
            </div>

            {{-- Category --}}
            <div class="form-group">
                <label for="category_id">Categoria</label>
                <select class="form-control" name="category_id" id="category_id">
                    <option value="">Nessuna</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" 
                            {{ old('category_id', $post->category_id) == $category->id ? 'selected' : '' }}> {{ $category->name }} 
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Tags --}}
            <h3>Tags</h3>

            @foreach ($tags as $tag)
            <div class="form-check">
                @if ($errors->any())
                    <input class="form-check-input" name="tags[]" type="checkbox" value="{{ $tag->id }}" id="tag-{{ $tag->id }}" {{ in_array($tag->id, old('tags', [])) ? 'checked' : '' }}>
                @else
                    <input class="form-check-input" name="tags[]" type="checkbox" value="{{ $tag->id }}" id="tag-{{ $tag->id }}" {{ $post->tags->contains($tag->id) ? 'checked' : '' }}>
                @endif
                
                <label class="form-check-label" for="tag-{{ $tag->id }}">
                  {{ $tag->name }}
                </label>
              </div>
            @endforeach

            <input class="btn btn-primary" type="submit" value="Modifica Post">
        </form>
    </div>
@endsection
 