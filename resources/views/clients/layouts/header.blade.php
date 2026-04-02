<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
@vite(['resources/css/app.css', 'resources/js/app.js'])
<link href="{{ asset('css/admin.css') }}" rel="stylesheet">
<link rel="icon" type="image/x-icon" href="/images/main/Logo.png">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link
    href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Rubik:ital,wght@0,300..900;1,300..900&display=swap"
    rel="stylesheet">
<script src="https://cdn.tiny.cloud/1/g0go04b2a4bq8sx34keyt8zzwkyw829rhufwbixtbvr5vyis/tinymce/8/tinymce.min.js" referrerpolicy="origin" crossorigin="anonymous"></script>
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
