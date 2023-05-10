@extends('layout.default')

@section('content')
<section class="py-5 text-center container">
  <div class="row py-lg-5">
    <div class="col-lg-6 col-md-8 mx-auto">
      <h1 class="fw-light">Title: {{ $movie->title }} - <a class="btn btn-primary" href="/updatemovie/{{$movie->id}}">Update</a></h1>
      <p>Year: {{ $movie->year }}. Duration: {{ $movie->duration }} minutes.</p>
      <p>User score: {{ $movie->user_score }}, Pegi-{{$movie->pegi}}</p>
      <p class="lead text-body-secondary">{{ $movie->description }}</p>
      @foreach ($movie->genres as $genre)
        <a href="/genres/{{$genre->name}}" class="btn btn-primary">{{ $genre->name }}</a>  
      @endforeach
      </p>
    </div>
  </div>
  <h3>Comments:</h3>
  <div class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
  </div>

  @foreach ($comments as $comment)
    <div class="border rounded-3 p-3 m-3">
      <h5>{{$comment->user->name}}:</h5>
      <p>{{$comment->body}}</p>
      <p>{{$comment->created_at->diffForHumans()}}</p>
    </div>
  @endforeach

  <div class="container ml-3">
    {{ $comments }}
  </div>

  @auth
  <form action="/createcomment" method="POST" class="mt-5">
    @csrf
    <div class="mb-3">
        <label class="form-label">Enter your comment</label>
        <textarea type="text" class="form-control" name="body" required></textarea>
        <input type="hidden" name="movie_id" value="{{ $movie->id }}">
        <input type="hidden" name="user_id" value="{{auth()->user()->id}}">
    </div>
    <button type="submit" class="btn btn-primary">Post Comment</button>
  </form>
  @endauth

  <h3 class="mt-5">Movies in the same genre:</h3>
  <div class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
  </div>

  <div class="album py-5 bg-body-tertiary">
    <div class="container">
      <div class="row row-cols-1 row-cols-sm-2 row-cols-md-5 g-5">
      @foreach ($movies as $movie)
        <div class="col">
          <div class="card shadow-sm">
            <img class="bd-placeholder-img card-img-top" width="100%" height="180" src="{{ $movie->image_url }}" role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false">
            <div class="card-body">
              <p class="card-text"><strong>{{$movie->title}}</strong>, Score: {{ $movie->user_score }}</p>
              <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                  <a type="button" class="btn btn-sm btn-outline-secondary" href="/movies/{{$movie->title}}">View</a>
                </div>
                <small class="text-body-secondary">Published at: {{ $movie->published_at }}</small>
              </div>
            </div>
          </div>
        </div>      
      @endforeach
      </div>
    </div>
  </div>
</section>
@endsection