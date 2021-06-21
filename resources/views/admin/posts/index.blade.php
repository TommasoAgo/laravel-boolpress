@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Gestisci i tuoi post</h1>

        <div class="row">
            @foreach ($posts as $post)
                <div class="col-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title"> {{ $post->title }} </h5>

                            {{-- SHOW POST --}}
                            <a href="{{ route('admin.posts.show', [
                                'post' => $post->id
                            ]) }}" class="btn btn-primary">Vai al post</a>

                            {{-- EDIT POST --}}
                            <a href="{{ route('admin.posts.edit', [
                                'post' => $post->id
                            ]) }}" class="btn btn-secondary">Modifica</a>

                            {{-- DELETE POST --}}
                            <form style="margin-top: 10px" action=" {{ route('admin.posts.destroy', [
                                'post' => $post->id
                                ]) }} " method="post">
                                @csrf
                                @method('DELETE')

                                <input class="btn btn-danger" type="submit" value="Cancella">
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection