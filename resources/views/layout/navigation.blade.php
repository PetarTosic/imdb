<nav class="navbar navbar-expand-lg bg-info">
  <div class="container-fluid container">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarText">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="/">Home</a>
        </li>
      </ul>
      <span>
        
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          @if (@isset($genres))
          <li class="nav-item">
            <div class="dropdown">
            <a class="btn dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Genres
            </a>
            <ul class="dropdown-menu">
              @foreach ($genres as $genre)
                <li><a class="dropdown-item" href="/{{$genre->name}}">{{$genre->name}}</a></li>
              @endforeach
            </ul>
           </div> 
          </li>
          @endif

          @if (!auth()->check())
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="/signup">Sign Up</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="/signin">Sign In</a>
          </li>
          @endif
          @auth
            <li class="nav-item">
              <div class="dropdown">
              <a class="btn dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                {{ auth()->user()->name }}
              </a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#">Profile</a></li>
                <li><a class="dropdown-item" href="/settings">Settings</a></li>
                <li><a class="dropdown-item" href="/messages">Messages</a></li>
                <li><a class="dropdown-item" href="/sendmessage">Send Message</a></li>
                @if (auth()->user()->admin)
                  <li><a class="dropdown-item" href="/createmovie">Create movie</a></li>
                  <li><a class="dropdown-item" href="/creategenre">Create genre</a></li>
                  <li><a class="dropdown-item" href="/managemovies">Manage movies</a></li>
                @endif
                <li><a class="dropdown-item" href="/signout">Sign Out</a></li>
              </ul>
             </div> 
            </li>
          @endauth
        </ul>
      </span>
    </div>
  </div>
</nav>