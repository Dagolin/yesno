<div class="android-header mdl-layout__header mdl-layout__header--waterfall">
    <div class="mdl-layout__header-row">
        <!-- Logo -->
        <a href="{{ url('/') }}"><img class="android-logo-image" src="{{ URL::asset('images/android-logo.png') }}"></a>
        <!-- Add spacer, to align navigation to the right in desktop -->
        <div class="android-header-spacer mdl-layout-spacer"></div>
        <div class="android-navbar-title">
            <h5>Start a poll, react.</h5>
        </div>
            @if(Auth::check())
                <button id="mdl-avatar-button" class="mdl-button mdl-js-ripple-effect mdl-js-button mdl-button--fab">
                    <img src="{{ URL::asset('images/user.jpg') }}" class="demo-avatar">
                </button>
                <ul class="mdl-menu mdl-menu--bottom-right mdl-js-menu mdl-js-ripple-effect" for="mdl-avatar-button">
                    <li class="mdl-menu__item"><a href="{{ url('user/profile') }}"><div style="width:100%;height:100%">Profile</div></a></li>
                    <li class="mdl-menu__item"><a href="{{ url('user/history') }}"><div style="width:100%;height:100%">My votes</div></a></li>
                    <li class="mdl-menu__item"><a href="{{ url('vote/create') }}"><div style="width:100%;height:100%">New idea</div></a></li>
                    <li class="mdl-menu__item"><a href="{{ url('logout') }}"><div style="width:100%;height:100%">Logout</div></a></li>
                </ul>
            @else
            <a href="{{ url('login') }}">
                <button id="mdl-avatar-button" class="mdl-button mdl-js-ripple-effect mdl-js-button mdl-button--fab">
                    <i class="material-icons">people</i>
                </button>
            </a>
            @endif
    </div>
</div>
