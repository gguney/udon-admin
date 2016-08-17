<div data-collapse="medium" data-animation="default" data-duration="400" data-contain="1" class="w-nav navbar">
    <div class="w-clearfix menu-container">
        <a href="#" class="w-nav-brand"><img height="59" src="{{ url('/').'/admin/images/udon.png' }}">
        </a>
        <nav role="navigation" class="w-nav-menu w-clearfix nav-menu">
            <a href="{{ url('index') }}" class="w-nav-link nav-link"><b class="menu fa fa-home"></b></a>
            @if (Auth::User())

            <a href="{{ url('user') }}" class="w-nav-link nav-link"><b class="menu fa fa-user"></b></a>
            <a href="{{ url('role') }}" class="w-nav-link nav-link">Roles</a>
            <a href="{{ url('country') }}" class="w-nav-link nav-link">Countries</a>
            <a href="{{ url('city') }}" class="w-nav-link nav-link">Cities</a>
            <a href="{{ url('region') }}" class="w-nav-link nav-link">Regions</a>
            <a href="{{ url('management') }}" class="w-nav-link nav-link"><b class="menu fa fa-institution"></b></a>
            <a href="{{ url('menu') }}" class="w-nav-link nav-link">Menus</a>
            <a href="{{ url('category') }}" class="w-nav-link nav-link">Categories</a>
            <a href="{{ url('food') }}" class="w-nav-link nav-link">Foods</a>
            <a href="{{ url('ingredient') }}" class="w-nav-link nav-link">Ingredients</a>
            <a href="{{ url('content') }}" class="w-nav-link nav-link">Contents</a>



                <div data-delay="0" class="w-dropdown dropdown">
                    <div class="w-dropdown-toggle dropdown-toggle">
                        <div>{{Auth::User()->username}}
                           {{--@foreach(Auth::User()->roles as $role)--}}
                               {{--({{$role->name}})--}}
                           {{--@endforeach--}}
                        </div>
                        <div class="w-icon-dropdown-toggle dropdown-toggle-icon"></div>
                    </div>
                    <nav class="w-dropdown-list dropdown-list">
                        <a href="{{url('logout')}}" class="w-nav-link nav-link">Logout</a>
                    </nav>
                </div>
            @else
                <a href="{{ url('register') }}" class="w-nav-link nav-link">Register</a>
                <a href="{{ url('login') }}" class="w-nav-link nav-link">Login</a>
            @endif
        </nav>
        <div class="w-nav-button">
            <div class="w-icon-nav-menu"></div>
        </div>
    </div>
</div>


