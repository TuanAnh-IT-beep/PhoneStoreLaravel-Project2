<header>
    <div class="mx-auto px-4 py-4 items-center justify-between bg-transparent container flex">
        <div class="flex items-center" style="gap: 5px" id="logo">
            <a href="{{ route('admins.home') }}">
                <img src="{{ asset('images/main/Logo.png') }}" alt="Logo" class="logo-image">
            </a>
            <a class="logo-text" href="{{ route('admins.home') }}"><span style="color: #AFF5BF;">BMo</span>bileShop</a>
        </div>
        @if (Route::has('admins.users.login') && Route::currentRouteName() !== 'admins.users.login')
            <div class="flex items-center">
                @auth('admin')
                    <button type="button" class="flex items-center gap-3" id="dropdownDefaultButton"
                        data-dropdown-toggle="dropdown" data-dropdown-placement="bottom-end">
                        <p><i class="fa-solid fa-caret-down"></i> {{ Auth::guard('admin')->user()->username }}</p>
                        @if (Auth::guard('admin')->user()->icon)
                            <img src="{{ asset('storage/' . Auth::guard('admin')->user()->icon) }}"
                                class="w-10 h-10 object-cover rounded-full">
                        @endif
                    </button>
                    <div id="dropdown"
                        class="z-10 hidden bg-neutral-primary-medium border border-default-medium rounded-base shadow-lg w-44">
                        <ul class="p-2 text-sm text-body font-medium" aria-labelledby="dropdownDefaultButton">
                            <li>
                                <a href="{{ route('home') }}"
                                    class="dropdown-link inline-flex items-center w-full p-2 hover:bg-neutral-tertiary-medium hover:text-heading rounded text-black">
                                    Back to Client
                                </a>
                                <a href="{{ route('admins.users.logout') }}"
                                    class="dropdown-link inline-flex items-center w-full p-2 hover:bg-neutral-tertiary-medium hover:text-heading rounded text-black">
                                    Log out
                                </a>
                            </li>
                        </ul>
                    </div>
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
