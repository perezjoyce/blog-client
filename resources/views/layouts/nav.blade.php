  <nav class="white z-depth-0" role="navigation">
    <div class="nav-wrapper container">
      <a id="logo-container" class="brand-logo grey-text text-darken-3" href="{{ url('/') }}">Blogger</a>
        
      <!-- Large Screen -->
      @if(!isset($user))
        <a href="#" data-target="mobile" class="right sidenav-trigger grey-text text-darken-2 show-on-medium-and-down"><i class="material-icons">menu</i></a>
        <ul class="right hide-on-med-and-down">
          <li><a class="btn-flat modal-trigger grey-text text-darken-2" href="#loginForm">Log In</a></li>
          <li><a class="waves-effect waves-light btn blue" href="{{url('register')}}">Sign Up</a></li>
        </ul>
        @else
        <a href="#" data-target="mobile" class="right sidenav-trigger grey-text text-darken-2 show-on-medium-and-down"><i class="material-icons">menu</i></a>
        <ul class="right hide-on-med-and-down">
          <li><a class="btn-flat modal-trigger grey-text text-darken-2" href="#logoutForm">Log Out</a></li>
          <li><a class="btn-flat dropdown-trigger grey-text text-darken-2" href="#!" data-target="manage-sections">Manage<i class="material-icons right">arrow_drop_down</i></a></li>
        </ul>
      @endif


      <!-- Table and mobile -->
      <ul class="sidenav grey-text text-darken-3 show-on-medium-and-down" id="mobile">
          <li><a href="{{ url('dashboard') }}">Profile</a></li>
          <li><a href=" {{ url('write-blog-post') }}">Write A Blog</a></li>
          <li><a href="{{ url('blogposts') }}">Blog Posts</a></li>
          <li><a href="{{ url('users') }}">Users</a></li>
          <li class="divider"></li>
          <li><a class="modal-trigger grey-text text-darken-2" href="#logoutForm">Log Out</a></li>
      </ul>
  


      <!-- Dropdown Structure -->
      <ul id="manage-sections" class="dropdown-content grey-text text-darken-3 show-on-large-only hide-on-med-and-down">
        <li><a href="{{ url('dashboard') }}">Profile</a></li>
        <li><a href="{{ url('blogposts') }}">Blog Posts</a></li>
        <li><a href="{{ url('users') }}">Users</a></li>
        <li class="divider"></li>
        <li><a href=" {{ url('write-blog-post') }}">Write New Blog</a></li>
      </ul>

    </div>
  </nav>


  <!-- Categories -->
  <nav class="blue-grey lighten-5 z-depth-0">
    <div class="container nav-wrapper center">
      <ul class="center">
        <li class="active center"><a href="sass.html" class="grey-text text-darken-2">All</a></li>
        <li><a href="#" class="grey-text text-darken-2">Curriculum</a></li>
        <li><a href="#" class="grey-text text-darken-2">SPED</a></li>
        <li><a href="#" class="grey-text text-darken-2">Tech</a></li>
        <li><a href="#" class="grey-text text-darken-2 hide-on-small-only">Training</a></li>
      </ul>
    </div>
  </nav>


  <!-- Modals -->
  <div id="loginForm" class="modal">
    <div class="modal-content">
      <h4>Log In</h4>
        <form action="{{url('login-user')}}" method="post">
        {{ csrf_field() }}
            <input type="email" name="login-email" id="login-email" placeholder="Email">
            <input type="password" name="login-password" id="login-password" placeholder="Password">
            <input type="submit" value="Login" class='btn'>
        </form>
    </div>
  </div>

  @if(isset($user))
  <div id="logoutForm" class="modal">
    <div class="modal-content">
      <h4>Log Out</h4>
      <p>Do you want to log out?</p>
        <form action="{{url('logout')}}" method="post">
          {{ csrf_field() }}
            <input type="hidden" name="_id" id="_id" value="{{ $user->_id }}">
            <input type="submit" value="Logout" class='btn'>
        </form>
      </div>
  </div>
  @endif
