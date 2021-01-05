<header class="site-header mo-left header fullwidth">
    <!-- main header -->
    <div class="sticky-header main-bar-wraper navbar-expand-lg">
        <div class="main-bar clearfix">
            <div class="container clearfix">
                <!-- website logo -->
                <div class="logo-header mostion">
                    <a href="index-2.html"><img src="{{ asset('frontend/images/logo.png') }}" class="logo" alt=""></a>
                </div>
                <!-- nav toggle button -->
                <!-- nav toggle button -->
                <button class="navbar-toggler collapsed navicon justify-content-end" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>
                <!-- extra nav -->
                <div class="extra-nav">
                    <div class="extra-cell">
                        @if (empty($user))
                            <a href="{{ route('login.regist') }}" class="site-button"><i class="fa fa-user"></i> Sign Up</a>
                            <a href="{{ route('login.login') }}" class="site-button"><i class="fa fa-lock"></i> login</a>
                        @else
                            <a href="#" id="userDropdown" data-toggle="dropdown" class="site-button">{{ $user->username }}</a>
                            <div class="dropdown-menu dropdown-menu-right"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="{{ url('pencari/profile') }}">
                                    <i class="fa fa-user"></i>
                                    Profile
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt"></i>
                                    Logout
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
                <!-- Quik search -->
                <div class="dez-quik-search bg-primary">
                    <form action="#">
                        <input name="search" value="" type="text" class="form-control" placeholder="Type to search">
                        <span id="quik-search-remove"><i class="flaticon-close"></i></span>
                    </form>
                </div>
                <!-- main nav -->
                <div class="header-nav navbar-collapse collapse justify-content-start" id="navbarNavDropdown">
                    <ul class="nav navbar-nav">
                        <li class="active">
                            <a href="#">Home</a>
                        </li>
                        @if (!empty($user))
                            @if ($user->type == 1)
                                <li>
                                    <a href="#">For Candidates <i class="fa fa-chevron-down"></i></a>
                                    <ul class="sub-menu">
                                        <li><a href="browse-job.html" class="dez-page">Browse Job</a></li>
                                        <li><a href="companies.html" class="dez-page">companies</a></li>
                                    </ul>
                                </li>
                            @elseif($user->type == 2)
                                <li>
                                    <a href="#">For Company <i class="fa fa-chevron-down"></i></a>
                                    <ul class="sub-menu">
                                        <li><a href="browse-candidates.html" class="dez-page">Browse Candidates</a></li>
                                    </ul>
                                </li>
                            @endif
                        @else
                            <li><a href="{{ route('login.login') }}">For Candidates</a></li>
                            <li><a href="{{ route('login.login') }}">For Company</a></li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- main header END -->
</header>
