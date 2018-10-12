<header class="app-header"><a class="app-header__logo" href="index.html"><i class="fa fa-book"> LMS</i></a>
    <!-- Sidebar toggle button-->
    <a class="app-sidebar__toggle" href="#" data-toggle="sidebar" aria-label="Hide Sidebar"></a>
    <!-- Navbar Right Menu-->
    <ul class="app-nav">
        <li class="app-search">
            <input class="app-search__input" type="search" placeholder="Search">
            <button class="app-search__button"><i class="fa fa-search"></i></button>
        </li>
         
        <!-- User Menu-->
        <li class="dropdown"><a class="app-nav__item" href="#" data-toggle="dropdown" aria-label="Open Profile Menu"><i class="fa fa-user fa-lg"></i></a>


            <ul class="dropdown-menu settings-menu dropdown-menu-right">
    
                <li><a class="dropdown-item" onclick="event.preventDefault();
                                                     document.getElementById('user-profile').submit();"><i class="fa fa-user fa-lg"></i> Profile</a></li>
                <li><a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        <i class="fa fa-sign-out"></i>{{ __('Logout') }}
                </a></li>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
                @if (auth()->user())
                <form id="user-profile" method="POST" style="display: none;" action="{{ url('admin/user/profile') }}">
                    @csrf
                    <input type="text" name="id" value="{{ auth()->user()->id }}">
                </form>
                @endif
            </ul>
        </li>
    </ul>
</header>