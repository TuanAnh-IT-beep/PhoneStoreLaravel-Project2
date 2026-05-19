<header>
    <div class="mx-auto px-4 py-4 items-center justify-between bg-transparent container flex flex-1">
        <div class="flex items-center" style="gap: 5px" id="logo">
            <a href="{{ route('home') }}">
                <img src="{{ asset('images/main/Logo.png') }}" alt="Logo" class="logo-image">
            </a>
            <a class="logo-text" href="{{ route('home') }}"><span style="color: #AFF5BF;">BMo</span>bileShop</a>
        </div>
        @if (Route::has('clients.login') && Route::currentRouteName() !== 'clients.login')
            <div class="flex items-center" style="gap: 20px">
                @auth('client')
                    <button id="dropdownDividerButton" data-dropdown-toggle="dropdownDivider"
                        class="inline-flex items-center justify-center text-white bg-brand box-border border border-transparent hover:bg-brand-strong shadow-xs font-medium leading-5 rounded-base text-sm focus:outline-none"
                        type="button">
                        <img src="{{ asset('storage/' . Auth::guard('client')->user()->icon) }}" alt="User Icon"
                            class="w-10 h-10 rounded-full object-cover border-2 border-[#AFF5BF]">
                    </button>
                    <div id="dropdownDivider"
                        class="z-10 hidden bg-neutral-primary-medium border border-default-medium rounded-base divide-y divide-default-medium shadow-lg w-44" style="background-color: white">
                        <ul class="p-2 text-sm font-medium" aria-labelledby="dropdownDividerButton"> 
                            <li>
                                <a href="{{ route ('cart') }}" class="login-link">
                                    <span style="color: black">Cart</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route ('orders')}}" class="login-link">
                                    <span style="color: black">Orders History</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('logout') }}" class="login-link">
                                    <span style="color: black">Logout</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <p  class="login-link">{{ Auth::guard('client')->user()->display_name }}</p>
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
