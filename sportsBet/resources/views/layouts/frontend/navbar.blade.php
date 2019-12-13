<header>
    <!-- header-area start -->
    <div id="sticker" class="header-area">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-12">

                    <!-- Navigation -->
                    <nav class="navbar navbar-default">
                        <!-- Brand and toggle get grouped for better mobile display -->
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                                data-target=".bs-example-navbar-collapse-1" aria-expanded="false">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                            <!-- Brand -->
                            <a class="navbar-brand page-scroll sticky-logo" href="">
                                <h1><span>soccer</span>tipstar</h1>
                                <!-- Uncomment below if you prefer to use an image logo -->
                                <!-- <img src="img/logo.png" alt="" title=""> -->
                            </a>
                        </div>
                        <!-- Collect the nav links, forms, and other content for toggling -->
                        <div class="collapse navbar-collapse main-menu bs-example-navbar-collapse-1"
                            id="navbar-example">
                            <ul class="nav navbar-nav navbar-right">
                                <li class="active">
                                    <a class="page-scroll" href="{{ route('home') }}">Home</a>
                                </li>
                                <li>
                                    <a class="page-scroll" href="{{ route('home') }}#about">About</a>
                                </li>
                                <li>
                                    <a class="page-scroll" href="{{ route('home') }}#pricing">Pricing</a>
                                </li>
                                {{-- <li>
                                    <a class="page-scroll" href="#blog">Blog</a>
                                </li> --}}
                                <li>
                                    <a class="page-scroll" href="{{ route('home') }}#contact">Contact</a>
                                </li>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle"
                                        data-toggle="dropdown"> @guest Login/Signup @else {{ Auth::user()->first_name }} @endguest </a>
                                    <ul class="dropdown-menu" role="menu">
                                        @guest
                                            <li><a href="{{ route('login') }}">Login</a></li>
                                            <li><a href="{{ route('register') }}">Register</a></li>
                                        @else
                                            @if (Auth::user()->hasRole('administrator'))
                                                <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                                            @endif
                                            <li><a href="{{ route('account.index') }}">Account</a></li>
                                            <li><a href="{{ route('logOut') }}">Logout</a></li>
                                        @endguest
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <!-- navbar-collapse -->
                    </nav>
                    <!-- END: Navigation -->
                </div>
            </div>
        </div>
    </div>
    <!-- header-area end -->
</header>
<!-- header end -->
