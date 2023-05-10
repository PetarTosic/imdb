@extends('layout.default')

@section('content')
  <div class="form-signin m-auto container w-25 mt-5">
    <form method="POST" action="{{ url('creategenre') }}" >
      @csrf
      <h1 class="h3 mb-3 fw-normal m-2">Create genre:</h1>
      <div class="form-floating m-2">
        <input type="text" class="form-control" id="floatingInput" placeholder="Name" name="name" required>
        <label for="floatingInput">Genre name</label>
      </div>
      <button class="btn btn-lg btn-primary m-2" type="submit">Create</button>
    </form>
  </div>
@endsection