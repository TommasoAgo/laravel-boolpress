@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Categorie</h1>

        <div class="row">
            @foreach ($categories as $category)
                <div class="col-6">
                    <div class="card">
                        <div class="card-body">
                          <h5 class="card-title"> {{ $category->name }} </h5>
                          <a class="btn btn-primary" href="{{ route('category-page',
                           ['slug' => $category->slug]) }}">Vai</a>
                        </div>
                      </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection