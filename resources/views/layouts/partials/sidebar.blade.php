<!--left menu start-->
<div class="side-menu left" id="side-menu">

    <ul class="metismenu clearfix" id="menu">
        <li class="profile-menu visible-xs">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <img src="{{ asset('images/user.png') }}" alt="">
                <span>{{ auth()->user()->name }}<br></span>
            </a>
            <ul class="dropdown-menu profile-drop">
                <li>
                    <form method="post" action="{{ route('logout') }}">
                        @csrf
                        <button class="btn-link" type="submit">{{ __("logout") }}</button>
                    </form>
                </li>
            </ul>
        </li>
        <li class="@if(Route::current()->getName() == 'letters' || Route::current()->getName() == 'letters.show' ||
                    Route::current()->getName() == 'dashboard' || Route::current()->getName() == 'letters.edit') active @endif">
            <a href="{{ route("letters") }}">
                <i class="fa fa-list"></i>
                <span>{{ __('Letters List') }}</span>
            </a>
        </li>
        <li class="@if(Route::current()->getName() == 'letters.create') active @endif">
            <a  href="{{ route("letters.create") }}">
                <i class="fa fa-mail-bulk"></i>
                <span>{{ __('Register Letter In Indicator') }}</span>
            </a>
        </li>
        <li class="@if(Route::current()->getName() == 'users') active @endif">
            <a  href="{{ route("users") }}">
                <i class="fa fa-user-friends"></i>
                <span>{{ __('Users List') }}</span>
            </a>
        </li>
        @if(auth()->user()->role == "admin")
            <li class="@if(Route::current()->getName() == 'users.create') active @endif">
                <a  href="{{ route("users.create") }}">
                    <i class="fa fa-user-alt"></i>
                    <span>{{ __('Create New User') }}</span>
                </a>
            </li>
        @endif
    </ul>
    <div class="nav-bottom clearfix">
        <a href="#" style="border-right: 0;"><i class="fa fa-lock"></i></a>
        <a href="#" style="border-right: 0;"><i class="fa fa-download"></i></a>
        <a href="#" style="border-right: 0;"><i class="fa fa-globe"></i></a>
        <a href="#" style="border-right: 0;"><i class="fa fa-phone"></i></a>
    </div>
</div>
<!--left menu end-->
