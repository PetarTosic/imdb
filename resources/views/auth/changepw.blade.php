@extends('layout.default')

@section('content')
  <div class="form-signin m-auto container w-25 mt-5">
  <form method="POST" action="{{ url('changepw') }}" >
  @csrf
  <p class="h4 mb-3 fw-normal m-2">Enter new password:</p>
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
</div>
@endsection