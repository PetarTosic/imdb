@extends('layout.default')

@section('content')
<div class="form-signin m-auto container w-25">
<form method="POST" action="{{ url('signup') }}" >
  @csrf
  <h1 class="h3 mb-3 fw-normal m-2">Sign Up</h1>
  <div class="form-floating m-2">
    <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com" name="name" required>
    <label for="floatingInput">Name</label>
  </div>
  <div class="form-floating m-2">
    <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com" name="email" required>
    <label for="floatingInput">Email address</label>
  </div>
  <div class="form-floating m-2">
    <input type="password" class="form-control" id="floatingPassword" placeholder="Password" name="password" required>
    <label for="floatingPassword">Password</label>
  </div>
  <div class="form-floating m-2">
    <input type="password" class="form-control" id="floatingPassword" placeholder="Password" name="password_confirmation" required>
    <label for="floatingPassword">Password Confirmation</label>
  </div>
  <button class="btn btn-lg btn-primary m-2" type="submit">Sign Up</button>
  <p class="mt-5 mb-3 text-body-secondary">&copy; 2023</p>
</form>
</div>

@endsection