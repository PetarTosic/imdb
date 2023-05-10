@extends('layout.default') 

@section('content')
  <div class="form-signin m-auto container w-25 mt-5">
    <form method="POST" action="{{ url('sendmessage') }}" >
      @csrf
      <h1 class="h3 mb-3 fw-normal m-2">Send message:</h1>
      <div class="form-floating m-2">
        <input type="text" class="form-control" id="floatingInput" placeholder="Subject" name="subject" required>
        <label for="floatingInput">Subject</label>
      </div>
      <div class="form-floating m-2">
        <textarea type="text" class="form-control" id="floatingInput" placeholder="Content" name="content" required></textarea>
        <label for="floatingInput">Content</label>
      </div>
      <select class="form-select" name="id">
        @foreach ($users as $user)
          @if ($user->id != Auth::user()->id)
            <option value="{{$user->id}}">{{$user->name}}</option>
          @endif
        @endforeach
      </select>
      <button class="btn btn-lg btn-primary m-2" type="submit">Send</button>
    </form>
  </div>
@endsection