@extends('layout.default')

@section('content')
  <h3 class="container mt-3">Movies in genre - {{$genre->name}}:</h3>
  <div class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top container">
  </div>

  @foreach ($movies as $movie)
  <div class="container">
    <div class="card mb-3" style="max-width: 100vw;">
      <div class="row g-0">
        <div class="col-md-4">
          <img src="{{$movie->image_url}}" class="img-fluid rounded-start" alt="...">
        </div>
        <div class="col-md-8">
          <div class="card-body">

            <h5 class="card-title"><a type="button" class="btn btn-light" href="/movies/{{$movie->title}}">{{$movie->title}}</a> - Year made: {{$movie->year}}.</h5>
            <p class="card-text">{{$movie->description}}</p>
            @foreach ($movie->genres as $genre)
              <a href="/genres/{{$genre->name}}" class="btn btn-primary">{{ $genre->name }}</a>  
            @endforeach
            <p class="card-text"><small class="text-body-secondary">{{$movie->created_at->diffForHumans()}}</small></p>
          </div>
        </div>
      </div>
    </div>
  </div>
  @endforeach
  <div class="container ml-3">
    {{ $movies }}
  </div>
@endsection