@extends('layout.default')

@section('content')
<div class="album py-5 bg-body-tertiary">
  <div class="container">

		@if (@isset($popMovies))
    <div class="border rounded-3 p-1">
			<h3 class="m-2 p-3">Popular movies:</h3>
			<div class="row row-cols-1 row-cols-sm-2 row-cols-md-5 g-4 mt-3 mb-5">
			@foreach ($popMovies as $movie)
				<div class="col">
					<div class="card shadow-sm">
						<img class="bd-placeholder-img card-img-top" width="100%" height="200" src="{{ $movie->image_url }}" role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false">
						<div class="card-body">
							<p class="card-text"><strong>{{$movie->title}}</strong>, Score: {{ $movie->user_score }}</p>
							<div class="d-flex justify-content-between align-items-center">
								<div class="btn-group">
									<a type="button" class="btn btn-sm btn-outline-secondary" href="/movies/{{$movie->title}}">View</a>
								</div>
								<small class="text-body-secondary">{{ $movie->published_at }}</small>
							</div>
						</div>
					</div>
				</div>
			@endforeach
			</div>
    </div>
		@endif

    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4 g-4 mt-3">
      @foreach ($movies as $movie)
          
      <div class="col">
        <div class="card shadow-sm">
          <img class="bd-placeholder-img card-img-top" width="100%" height="225" src="{{ $movie->image_url }}" role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false">
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

      <div class="container m-3">
        {{ $movies }}
      </div>
    </div>
  </div>
</div>
@endsection