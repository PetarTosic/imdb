@extends('layout.default')

@section('content')
  <div class="form-signin m-auto container w-25 mt-5">
    <form method="POST" action="{{ url('forgotpw') }}" >
    @csrf
    <p class="h4 mb-3 fw-normal m-2">Enter email address:</p>
    <div class="form-floating m-2">
      <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com" name="email" required>
      <label for="floatingInput">Email address</label>
    </div>
    <button class="btn btn-lg btn-primary m-2" type="submit">Change password</button>
    </form>
  </div>
@endsection