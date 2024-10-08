
<nav class="main-header navbar navbar-expand navbar-white navbar-light">

    <ul class="navbar-nav">
    <a href="/home" class="navbar-brand">
      <img src="/favicon.png" alt="Logo" width="30" height="30" class="d-inline-block align-top img-circle" >
      <span class="brand-text font-weight-light">TecForge Pharmacy</span>
    </a>
    <li class="nav-item d-none d-sm-inline-block">
    <a href="{{ route('home') }}" class="nav-link {{ request()->routeIs('home')?'active':'' }}">Home</a>
    </li>
    <li class="nav-item d-none d-sm-inline-block">
        <a href="/contactez-nous" class="nav-link {{ request()->is('contactez*')? 'active':'' }}">Contact</a>
    </li>
    <li class="nav-item d-none d-sm-inline-block">
    <a href="#" class="nav-link">About</a>
    </li>
    @auth
    @if(Auth::user()->isAdmin )
    <li class="nav-item d-none d-sm-inline-block"><a href="/dashboard" class="nav-link text-danger">Dashboard</a>
    </li>
    @endif
    @endauth
    </ul>
    @if (Route::has('login'))
    <ul class="nav-bar nav ml-auto">
        
        @auth
        <li class="nav-item dropdown">
            <a
            href="#"
           class="nav-link dropdown-toggle" data-toggle="dropdown" id="navbarDropdown"><img class="profile-user-img img-fluid img-circle mr-4" src="/avatar.png" alt="User profile picture" style="width: 36px;height: 36px;" ><strong>
        
            {{  Auth::user()->name }}
           </strong> </a>
           
           <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="/user_profil">Profile</a>
            <a class="dropdown-item" href="/suggestion/user-list">Suggestions</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item text-danger" href="{{ route('logout') }}">Logout</a>
          </div>
        </li>
            
        @else
        <li class="nav-item d-none d-sm-inline-block"><a
                href="{{ route('login') }}"
               class="nav-link bg-success" style="border-radius:30px; ">
            
                Log in
            </a></li>

            @if (Route::has('register'))
            <li class="nav-item d-none d-sm-inline-block"><a href="{{ route('register') }}" class="nav-link d-sm-inline-block">
                    Register
                </a></li>
            @endif
        @endauth
    </div>
@endif
    </ul></nav>
    