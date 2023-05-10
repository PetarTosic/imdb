@extends('layout.default')

@section('content')
  <h3 class="container mb-3">Messages:</h3>
  @foreach ($messages as $message)
    <div class="row mb-3 text-center align-items-center border rounded-3">
      <div class="col-4 themed-grid-col"><strong>Subject:</strong><br>{{$message->subject}}</div>
      <div class="col-4 themed-grid-col border p-3"><strong>Content:</strong><br>{{$message->content}}</div>
      <div class="col-4 themed-grid-col">
        @foreach ($users as $user)
          @if ($user->id == $message->sender_id)
            {{$user->name}}
          @endif
        @endforeach
      </div>
    </div>
  @endforeach
@endsection