    <div class="navbar-fixed">
        <nav class="white">
            <div class="nav-wrapper">
                <div style="margin: 0 5vw 0 5vw">
                    <a href="#!" class="brand-logo">
                        <img src="{{asset('image/logo.png')}}" alt="">
                    </a>
                    <a href="#" data-target="mobile-demo" class="sidenav-trigger" style="color: #0C3E7A;">
                        <i class="material-icons">menu</i>
                    </a>
                    <ul class="right hide-on-med-and-down">
                        <!-- <li> -->
                        <!-- <a href="{{route('profile.edit')}}" style="color: #0C3E7A;">Profile</a> -->
                        <!-- </li> -->
                        <li>
                            <a href="{{route('dashboard')}}" style="color: #0C3E7A;">
                                <strong>Device Serial Number</strong>
                            </a>
                        </li>
                        <li>
                            <a href="{{route('clients.index')}}" style="color: #0C3E7A;">
                                <strong>Clients</strong>
                            </a>
                        </li>
                        <li>
                            <a href="{{route('apps.index')}}" style="color: #0C3E7A;">
                                <strong>Apps</strong>
                            </a>
                        </li>
                        <li>
                            <a href="{{route('devices.index')}}" style="color: #0C3E7A;">
                                <strong>Devices</strong>
                            </a>
                        </li>
                        <li>
                            <a>
                                <form method="POST" action="{{ route('logout') }}" id="logout-form">
                                    @csrf
                                    <button type="submit" class="btn-small waves-effect waves-light hoverable"
                                        style="background-color: #0C3E7A; font-size: 11px;" name="action">
                                        Logout
                                    </button>
                                </form>
                            </a>
                        </li>
                    </ul>
                </div>

            </div>
        </nav>
    </div>

    <!-- MOBILE  -->
    <ul class="sidenav" id="mobile-demo">
        <!-- <li style="margin-top: 18px;"> -->
        <!-- <a href="#!" class="valign-wrapper"> -->
        <!-- <img src="{{asset('image/logo.png')}}" alt="" class="center-align" style="width: 30vw;"> -->
        <!-- </a> -->
        </li>
        <li style="margin-top: 5vh;">
            <a href="{{route('dashboard')}}" style="color: #0C3E7A;">
                <strong>Device Serial Number</strong>
            </a>
        </li>
        <li>
            <a href="{{route('clients.index')}}" style="color: #0C3E7A;"><strong>Clients</strong></a>
        </li>
        <div class="divider"></div>
        <li class="center" style="margin-top: 8px;">
            <form method="POST" action="{{ route('logout') }}" id="logout-form">
                @csrf
                <button type="submit" class="btn-small waves-effect waves-light hoverable"
                    style="background-color: #0C3E7A; font-size: 11px;" name="action">
                    Logout
                </button>
            </form>
        </li>
    </ul>
