@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Crea un nuovo post</h1>

    <div class="container">

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

        {{-- CREATE Form --}}
        <form action=" {{ route('admin.posts.store') }} " method="post">
            @csrf
            @method('POST')

            {{-- Title --}}
            <div class="form-group">
                <label for="title">Titolo</label>
                <input type="text" class="form-control" name="title" id="title" value="{{ old('title') }}">
            </div>

            {{-- Content --}}
            <div class="form-group">
                <label for="content">Contenuto del post</label>
                <textarea name="content" class="form-control" id="content" cols="30" rows="10">{{ old('content') }}</textarea>
            </div>

            {{-- Category --}}
            <div class="form-group">
                <label for="category_id">Categoria</label>
                <select class="form-control" name="category_id" id="category_id">
                    <option value="">Nessuna</option>
                    @foreach ($categories as $category)
                        <option value="
                            {{ $category->id }}" 
                            {{ old('category_id', $category->id) == $category->id ? 'selected' : '' }}> {{ $category->name }} 
                        </option>
                    @endforeach
                </select>
            </div>

            <input class="btn btn-primary" type="submit" value="Salva nuovo Post">
        </form>
    </div>
@endsection
 