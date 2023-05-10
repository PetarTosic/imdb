@extends('layout.default')

@section('content')
  <form method="POST" action="{{ url('newpw') }}" >
  @csrf
  <p class="h4 mb-3 fw-normal m-2">Change password:</p>
  <div class="form-floating m-2">
    <input type="password" class="form-control" id="floatingPassword" placeholder="Password" name="old_password" required>
    <label for="floatingPassword">Old Password</label>
  </div>
  <div class="form-floating m-2">
    <input type="password" class="form-control" id="floatingPassword" placeholder="Password" name="password" required>
    <label for="floatingPassword">Password</label>
  </div>
  <div class="form-floating m-2">
    <input type="password" class="form-control" id="floatingPassword" placeholder="Password" name="password_confirmation" required>
    <label for="floatingPassword">Password Confirmation</label>
  </div>
  <input type="hidden" name="id" value="{{ $id }}">
  <button class="btn btn-lg btn-primary m-2" type="submit">Change password</button>
  </form>
@endsection