<!-- Topbar -->
<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top px-4">
    <!-- Sidebar Toggle (Topbar) -->
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars"></i>
    </button>

    <!-- Topbar Search -->
    <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 w-50 navbar-search shadow rounded">
        <div class="input-group">
            <div class="input-group-append">
                <button class="btn btn-light rounded" type="button">
                    <i class="fas fa-search fa-sm text-danger text-md "></i>
                </button>
            </div>
            <input type="text" class="form-control bg-light border-0 small" placeholder="Search for prodcuts or brands"
                aria-label="Search" aria-describedby="basic-addon2">

        </div>
    </form>

    <!-- Topbar Navbar -->
    <ul class="navbar-nav ml-auto " >

        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
        <li class="nav-item dropdown no-arrow d-sm-none">
            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-search fa-fw"></i>
            </a>
            <!-- Dropdown - Messages -->
            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                aria-labelledby="searchDropdown">
                <form class="form-inline mr-auto w-100 navbar-search">
                    <div class="input-group">
                        <input type="text" class="form-control bg-light border-0 small"
                            placeholder="Search for..." aria-label="Search"
                            aria-describedby="basic-addon2">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="button">
                                <i class="fas fa-search fa-sm"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </li>


        <div class="topbar-divider d-none d-sm-block" ></div>
        @if (Auth::user() != null)
            <li class="nav-item">
                <a href="" class="nav-link">
                    <i class="fa fa-shopping-cart" style="font-size: 1.2rem;"></i>
                    <p class="badge badge-pill badge-danger">0</p> 
                </a>
            </li>
            <li class="nav-item dropdown no-arrow">
                <a class="nav-link dropdown-toggle d-flex flex-row justify-content-center" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    @if (Auth::user()->photo == null)
                        <img width="40" height="40" class="rounded-circle m-0" src="https://pixlr.com/images/index/remove-bg.webp" alt="profile-photo">
                    @else
                        <img width="40" height="40" class="rounded-circle m-0" src="{{ Auth::user()->user_photo }}" alt="profile-photo">   
                    @endif
                    <div class="ml-2 d-inline-flex flex-column justify-content-center">
                        <p class="m-0 underlined" style="color: black; font-size: .8rem;">{{ Auth::user()->name  }} </p>
                        <p style="color: grey; font-size: .6rem; margin: 0;">Customer</p>
                    </div>
                </a>
                <!-- Dropdown - User Information -->
                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                    aria-labelledby="userDropdown">
                    <a class="dropdown-item" href="#">
                        <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                        Profile
                    </a>
                    <a class="dropdown-item" href="#">
                        <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                        Settings
                    </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                        {{ __('Logout') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </li>
        @else
            <li class="nav-item">
                <button href="#" class="my-2 my-lg-0 btn btn-danger btn-md rounded-5 " data-toggle="modal" data-target="#loginModal">
                    <span class="px-2">Login</span>
                </button>
            </li>
            <!-- Modal -->
            <div class="modal fade" id="loginModal" role="dialog" aria-labelledby="loginModalTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" style="width: 60vh;" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                            <h4 class="text-center text-md mb-3 lead">Login to continue</h4>
                            <form action="{{ route('login') }}" method="POST" class="p-0">
                                @csrf
                                <label class="sr-only" for="email">Enter Username</label>
                                <div class="input-group mb-3 mr-sm-2 bg-light">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="fa fa-envelope"></i></div>
                                    </div>
                                    <input type="email" name="email" class="form-control text-md" id="email" placeholder="Email" required>
                                </div>
                                <label class="sr-only" for="password">Enter Password</label>
                                <div class="input-group mr-sm-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="fa fa-key"></i></div>
                                    </div>
                                    <input type="password" name="password" class="form-control text-md" id="password" placeholder="Password" required>
                                </div>
                                <small class="form-text text-muted mb-2">
                                    <a href="#" id="forgotPassword" class="text-danger" style="text-decoration: none;">
                                        Forgot Password?
                                    </a>
                                </small>
                                <div class="col-auto mb-3">
                                    <div class="form-check mb-2">
                                    <input class="form-check-input" type="checkbox">
                                    <label class="form-check-label" >
                                        Remember me
                                    </label>
                                    </div>
                                </div>
                                <input type="submit" value="Login" class="btn btn-danger btn-block rounded-5">
                                <div class="w-100 mt-3 text-center">
                                    <button type="button" class="btn btn-block p-0 text-lg" data-dismiss="modal">Cancel</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <li class="nav-item">
                <li class="nav-item">
                    <a href="#" class="text-danger btn border-none"  data-toggle="modal" data-target="#registerModal">
                        SignUp
                    </a>
                </li>
                <div class="mt-3">
                    <div class="modal fade" id="registerModal" tabindex="-1" role="dialog" aria-labelledby="registerModalLabel">
                        <div class="modal-dialog modal-dialog-centered" style="width: 60vh;" role="document">
                          <div class="modal-content">
                            <div class="modal-body">
                                <h4 class="text-center text-md mb-3 lead">SignUp to continue</h4>
                                <form action="{{ route('customerRegister') }}" method="POST" class="p-0" enctype="multipart/form-data">
                                    @csrf
                                    <div class="input-group mb-3 mr-sm-2 bg-light">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><i class="fa fa-user"></i></div>
                                        </div>
                                        <input type="name" name="name" class="form-control text-md"  placeholder="Enter Name" required>
                                    </div>
                                    <div class="input-group mb-3 mr-sm-2 bg-light">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><i class="fa fa-envelope"></i></div>
                                        </div>
                                        <input type="email" name="email" class="form-control text-md" id="email" placeholder="Email" required>
                                    </div>
                                    
                                    <div class="input-group mr-sm-2 mb-3">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><i class="fa fa-key"></i></div>
                                        </div>
                                        <input type="password" name="password" class="form-control text-md" id="password" placeholder="Password" required>
                                    </div>
                                    <div class="input-group mr-sm-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><i class="fa fa-key"></i></div>
                                        </div>
                                        <input type="password" name="password_confirmation" class="form-control text-md" id="password_confirmation" placeholder="Confirm Password" required>
                                    </div>
                                    <div class="input-group mr-sm-2 my-3">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><i class="fa fa-file"></i></div>
                                        </div>
                                        <input type="file" name="photo" id="photo" class="form-control" placeholder="Select Photo">
                                    </div>
                                    <input type="hidden" name="role" value="1">
                                    <input type="submit" value="Sign up" class="btn btn-danger btn-block rounded-5">
                                    <div class="w-100 mt-3 text-center">
                                        <button type="button" class="btn btn-block p-0 text-lg" data-dismiss="modal">Cancel</button>
                                    </div>  
                                </form>
                            </div>
        
                          </div>
                        </div>
                      </div>
                   
            </li>
            <script>
                function showModal(){
                    $('#loginModal').modal('hide')
                    $('#registerModal').modal('show')
                }
  
            </script>
        @endif  
        <!-- Nav Item - User Information -->
        

    </ul>

</nav>
<!-- End of Topbar -->