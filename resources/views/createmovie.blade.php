@extends('layout.default') 

@section('content')
  <div class="form-signin m-auto container w-25">
  <form method="POST" action="{{ url('createmovie') }}" >
    @csrf
    <h1 class="h3 mb-3 fw-normal m-2">Create movie:</h1>
    <div class="form-floating m-2">
      <input type="text" class="form-control" id="floatingInput" placeholder="Title" name="title" required>
      <label for="floatingInput">Movie title</label>
    </div>
    <div class="form-floating m-2">
      <input type="number" class="form-control" id="floatingPassword" placeholder="Year made" name="year" required>
      <label for="floatingInput">Year made:</label>
    </div>
    <div class="form-floating m-2">
      <input type="number" class="form-control" id="floatingPassword" placeholder="Duration" name="duration" required>
      <label for="floatingInput">Duration:</label>
    </div>
    <div class="form-floating m-2">
      <input type="number" class="form-control" id="floatingPassword" placeholder="Rate movie" name="user_score" required>
      <label for="floatingInput">Rating:</label>
    </div>
    <div class="form-floating m-2">
      <input type="number" class="form-control" id="floatingPassword" placeholder="Pegi" name="pegi" required>
      <label for="floatingInput">Pegi:</label>
    </div>
    <div class="form-floating m-2">
      <input type="text" class="form-control" id="floatingPassword" placeholder="Image URL" name="image_url" required>
      <label for="floatingInput">Image URL:</label>
    </div>
    <div class="form-floating m-2">
      <textarea type="number" class="form-control" id="floatingPassword" placeholder="Description" name="description" required></textarea>
      <label for="floatingInput">Description:</label>
    </div>
    <select class="form-select" name="genres[]" multiple>
      @foreach ($genres as $genre)
        <option value="{{$genre->id}}">{{$genre->name}}</option>
      @endforeach
    </select>
    <br>
    <button class="btn btn-lg btn-primary m-2" type="submit">Create</button>
  </form>
    <p class="mt-5 mb-3 text-body-secondary">&copy; 2023</p>
  </div>
@endsection