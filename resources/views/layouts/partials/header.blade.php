<!--top bar-->
<div class="topbar">
    <div class="topbar-first">
        <div class="text-center">

            <a href="/" class="logo"><img src="{{ asset('images/logo.png') }}" alt=""></a>
        </div>
    </div>
    <div class="menu-toggle">
        <i class="fa fa-bars"></i>
    </div>
    @yield("breadcrumb")
    <ul class="nav navbar-nav  top-right-nav hidden-xs">
        @include("layouts.partials.notifications")
        <li class="dropdown profile-link hidden-xs">
            <div class="clearfix">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" style="text-align: left">
                    <span>{{ auth()->user()->name }} <br></span>
                    <i class="fa fa-user-circle"></i>
                    {{--<img src="{{ asset('images/user.png') }}" alt="">--}}
                </a>
                <ul class="dropdown-menu">
                    {{--<li><a href="#">Account</a></li>
                    <li><a href="#">Settings</a></li>--}}
                    <li>
                        <form method="post" action="{{ route('logout') }}">
                            @csrf
                            <button class="btn-link" type="submit">{{ __("Logout") }}</button>
                        </form>
                    </li>
                </ul>
            </div>

        </li>
    </ul>
</div>
<!--end top bar-->
