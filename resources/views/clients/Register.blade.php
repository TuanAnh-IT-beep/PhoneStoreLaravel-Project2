<!DOCTYPE html>
<html lang="en">

<head>

    @include('admins.layouts.head')
    <link href="{{ asset('css/login.css') }}" rel="stylesheet">
    <title>Login</title>
</head>
<body>
     @include('clients.layouts.header')
    <div class="login_box grid grid-cols-2 mx-auto">
        <img src="/images/login/banner.png" alt="" class="image_side">
        <div class="login_side">
            <h1>Register</h1>
            <form method="post" action="{{ route('register') }}">
            @csrf
            <div class="">
                    <label for="name">Username:</label><br>
                    <input required class="my-3 w-full" type="text" name="username"
                        placeholder="Input username here..."><br>
                    <label for="password">Password:</label><br>
                    <input required class="my-3 w-full" type="password" name="password"
                        placeholder="Input password here..."><br>
                    <label for="display_name">Display Name:</label><br>
                    <input required class="my-3 w-full" type="text" name="display_name"
                        placeholder="Input display name here..."><br>
                    <label for="email">Email:</label><br>
                    <input required class="my-3 w-full" type="text" name="email" placeholder="Input email here..."><br>
                    <label for="phone">Phone:</label><br>
                    <input required class="my-3 w-full" type="text" name="phone" placeholder="Input phone here..."><br>
                    <div class="flex gap-5">
                        <div class="w-full">
                            <label for="gender">Gender:</label><br>
                            <select class="w-full my-3" name="gender">
                                <option value="M">Male</option>
                                <option value="F">Female</option>
                                <option value="O">Other</option>
                            </select><br>
                        </div>
                        <div class="w-full">
                            <label for="birthday">Birthday:</label><br>
                            <input class="my-3 w-full" type="date" name="birthday"
                                placeholder="Input birthday here..."><br>
                        </div>
                    </div>
                    <label for="address">Address:</label><br>
                    <input class="my-3 w-full" type="text" name="address" placeholder="Input address here..."><br>
                    <input type="hidden" name="icon" value="">
                    <div class="flex gap-2 mt-4">
                        <button class="btn flex-1 icon-only">Register</button>
                    </div>
                
                {{-- <div class="col-span-6">
                    <div class="col-span-5">
                        <label for="icon">Icon:</label><br>
                        <input class="my-3" type="file" name="icon" accept="image/*"
                            onchange="previewIcon(event)"><br>
                        <img id="icon_preview" class="w-32 h-32 object-cover border rounded mb-3 hidden" src="#"
                            alt="Icon Preview"><br>
                        <script>
                            function previewIcon(event) {
                                const output = document.getElementById('icon_preview');
                                if (event.target.files && event.target.files[0]) {
                                    const reader = new FileReader();
                                    reader.onload = function(e) {
                                        output.src = e.target.result;
                                        output.classList.remove('hidden');
                                    };
                                    reader.readAsDataURL(event.target.files[0]);
                                }
                            }
                        </script>
                    </div>
                </div> --}}
            </div>
        </form>
            <hr class="mt-10">
            <div class="my-5 flex flex-col items-center justify-center">
                <img src="{{ asset('images/main/Logo.png') }}" alt="Logo" class="logo-image">
                <p class="logo-text"><span style="color: #AFF5BF;">BMo</span>bileShop</a></p>
            </div>
            <hr>
        </div>
    </div>
</body>

</html>