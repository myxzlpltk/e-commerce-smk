<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
  <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
    <i class="fa fa-bars"></i>
  </button>
  <ul class="navbar-nav ml-auto">
    <li class="nav-item dropdown no-arrow">
      <a class="nav-link dropdown-toggle" href="#" id="userDropdown" data-toggle="dropdown">
        <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ optional(auth()->user())->name }}</span>
        <img class="img-profile rounded-circle" src="{{ asset('img/undraw_profile.svg') }}">
      </a>
      <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in">
        <a class="dropdown-item @if(Route::is('profile')) active @endif" href="{{ route('profile') }}">
          <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
          Profil
        </a>
        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
          <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
          Logout
        </a>
      </div>
    </li>
  </ul>
</nav>
