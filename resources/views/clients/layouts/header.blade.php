<header>
    <div class="mx-auto px-4 py-4 items-center justify-between bg-transparent container flex flex-1">
        <div class="flex items-center gap-1" id="logo">
            <a href="{{ route('home') }}">
                <img src="{{ asset('images/main/Logo.png') }}" alt="Logo" class="logo-image">
            </a>
            <a class="logo-text" href="{{ route('home') }}"><span style="color: #AFF5BF;">BMo</span>bileShop</a>
        </div>
        <div class="flex-1 flex justify-center px-24 md:flex">
            <form action="{{ route('all') }}" method="GET" class="w-full">
                <div class="relative">
                    <input type="text" name="search" placeholder="Search for products..."
                        class="w-full px-4 py-2 rounded-full border border-gray-300 focus:outline-none focus:ring-2 focus:ring-[#48a892] focus:border-transparent text-black">
                    <button type="submit"
                        class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-500 hover:text-gray-700">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </button>
                </div>
            </form>
        </div>
        @if (Route::has('clients.login') && Route::currentRouteName() !== 'clients.login')
            <div>
                @auth('client')
                    <button id="dropdownDividerButton" data-dropdown-toggle="dropdownDivider"
                        data-dropdown-placement="bottom-end" class="flex items-center gap-3" type="button">
                        <p class="login-link">{{ Auth::guard('client')->user()->display_name }}</p>
                        @if (Auth::guard('client')->user()->icon)
                            <img src="{{ asset('storage/' . Auth::guard('client')->user()->icon) }}" alt="User Icon"
                                class="w-10 h-10 rounded-full object-cover">
                        @endif
                    </button>
                    <div id="dropdownDivider"
                        class="z-50 hidden bg-neutral-primary-medium border border-default-medium rounded-base divide-y divide-default-medium shadow-lg w-44"
                        style="background-color: white">
                        <ul class="p-2 text-sm text-body font-medium" aria-labelledby="dropdownDefaultButton">
                            <li>
                                <a href="{{ route('getProfile') }}"
                                    class="dropdown-link inline-flex items-center w-full p-2 hover:bg-neutral-tertiary-medium hover:text-heading rounded text-black">
                                    Profile
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('cart') }}"
                                    class="dropdown-link inline-flex items-center w-full p-2 hover:bg-neutral-tertiary-medium hover:text-heading rounded text-black">
                                    Cart
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('orders') }}"
                                    class="dropdown-link inline-flex items-center w-full p-2 hover:bg-neutral-tertiary-medium hover:text-heading rounded text-black">
                                    Orders History
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('logout') }}"
                                    class="dropdown-link inline-flex items-center w-full p-2 hover:bg-neutral-tertiary-medium hover:text-heading rounded text-black">
                                    Log out
                                </a>
                            </li>
                        </ul>
                    </div>
                @endauth
                @guest('client')
                    <a href="{{ route('clients.login') }}">
                        Login
                    </a>
                @endguest
            </div>
        @endif
    </div>
</header>
