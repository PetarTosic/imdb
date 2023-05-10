@extends('layout.default')

@section('content')
  @foreach ($movies as $movie)
      <h4 class="p-3 m-2 border rounded-2">{{ $movie->title }} - <a href="/managemovies/{{$movie->id}}" class="btn btn-primary">Delete</a></h4>
  @endforeach
  <div class="container m-3">
    {{ $movies }}
  </div>
@endsection