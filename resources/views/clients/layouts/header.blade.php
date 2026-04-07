<header>
    <div class="mx-auto px-4 py-4 items-center justify-between bg-transparent container flex">
        <div class="flex items-center" style="gap: 5px" id="logo">
            <a href="{{ route('home') }}">
                <img src="{{ asset('images/main/Logo.png') }}" alt="Logo" class="logo-image">
            </a>
            <a class="logo-text" href="{{ route('home') }}"><span style="color: #AFF5BF;">BMo</span>bileShop</a>
        </div>
        @if (Route::has('clients.login') && Route::currentRouteName() !== 'clients.login')
            <div class="flex items-center" style="gap: 20px">
                @auth('client')
                    <p class="login-link">{{ Auth::guard('client')->user()->display_name }}</p>
                    <a href="{{ route('logout') }}" class="login-link">
                        <span>Logout</span>
                    </a>
                @endauth
                @guest('client')
                    <a href="{{ route('clients.login') }}" class="login-link">
                        <span>Login</span>
                    </a>
                @endguest
            </div>
        @endif
    </div>
</header>
