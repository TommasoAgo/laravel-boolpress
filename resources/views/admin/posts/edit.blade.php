@extends('layouts.app')

@section('content')
        
    <div class="container">

        <h1>Modifica il Post {{ $post->title }}</h1>

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

            <input class="btn btn-primary" type="submit" value="Modifica Post">
        </form>
    </div>
@endsection
 