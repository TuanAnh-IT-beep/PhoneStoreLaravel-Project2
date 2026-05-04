<header>
    <div class="mx-auto px-4 py-4 items-center justify-between bg-transparent container flex">
        <div class="flex items-center" style="gap: 5px" id="logo">
            <a href="{{ route('home') }}">
                <img src="{{ asset('images/main/Logo.png') }}" alt="Logo" class="logo-image">
            </a>
            <a class="logo-text" href="{{ route('home') }}"><span style="color: #AFF5BF;">BMo</span>bileShop</a>
        </div>
        @if (Route::has('admins.users.login') && Route::currentRouteName() !== 'admins.users.login')
            <div class="flex items-center" style="gap: 20px">
                @auth('admin')
                    @if(Auth::guard('admin')->user()->icon)
                        <img src="{{ asset('storage/' . Auth::guard('admin')->user()->icon) }}"
                            class="w-8 h-8 object-cover rounded-full">
                    @endif  
                    <p class="login-link">{{ Auth::guard('admin')->user()->username }}</p>
                    <a href="{{ route('logout') }}" class="login-link">
                        <span>Logout</span>
                    </a>
                @endauth
                @guest('admin')
                    <a href="{{ route('admins.users.login') }}" class="login-link">
                        <span>Login</span>
                    </a>
                @endguest
            </div>
        @endif
    </div>
</header>