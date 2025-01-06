<header class="main-header">
    <!-- Logo -->
    <a href="/" class="logo">
        <span class="logo-mini">
            <img src="{{ asset('images/logo.png') }}" style="max-width: 140px; margin-left: -20px;" alt="EDU Logo">
        </span>
        <span class="logo-lg">
            <img src="{{ asset('images/logo.png') }}" style="max-width: 140px; margin-left: -20px;" alt="EDU Logo">
        </span>
    </a>

    <!-- Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button -->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <!-- User Account Dropdown -->
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                        <img src="{{ asset('images/user.jpg') }}" class="user-image" alt="User Image">
                        <span class="hidden-xs">{{ auth()->user()->name }}</span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            <img src="{{ asset('images/user.jpg') }}" class="img-circle" alt="User Image">
                            <p>{{ auth()->user()->name }}</p>
                        </li>
                        <!-- Menu Footer -->
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="{{ route('profile') }}" class="btn btn-default btn-flat">Profile</a>
                            </div>
                            <div class="pull-right">
                                <a href="{{ route('auth.logout') }}" class="btn btn-default btn-flat" 
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    Log Out
                                </a>
                                <form id="logout-form" action="{{ route('auth.logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
    
</header>
