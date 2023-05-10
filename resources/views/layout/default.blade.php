<!DOCTYPE html>
<html lang="en">
<head>
  @include('layout.heading')
</head>
<body>
  @include('layout.navigation')
  <div class="container mt-5">
    @include('layout.errors')
    @include('layout.session')
  </div>
  <main>
    @yield('content')
  </main>
</body>
</html>