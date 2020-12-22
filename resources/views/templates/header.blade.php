<nav class="navbar navbar-expand-lg navbar-light p-3" style="background-color: white;
-webkit-box-shadow: 0px -2px 10px 0px rgba(214,214,214,1);
-moz-box-shadow: 0px -2px 10px 0px rgba(214,214,214,1);
box-shadow: 0px -2px 10px 0px rgba(214,214,214,1)">
    <a class="navbar-brand" href="{{ url('/home') }}"><b>Iklanin</b>.com</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
      </ul>
      @if(Route::has('login'))
      @auth
        {{-- <a class="btn btn-outline-primary my-2 my-sm-0" href="">{{ $user->name }}</a> --}}
        <a class="btn btn-primary my-2 my-sm-0 mx-3" href="{{ route('logout') }}" onclick="event.preventDefault();
         document.getElementById('logout-form').submit();">
         <i class="fas fa-sign-out-alt"></i>
         {{ __('Logout') }}
         </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
        </form>
      @else
        <a href="{{ route('loginPage') }}" class="btn btn-outline-primary mx-3">Masuk</a>
        <a class="btn btn-primary my-2 my-sm-0" type="button" href="{{ route('registerPage') }}">Daftar</a>
      @endauth
      @endif
    </div>
</nav>
<br>
