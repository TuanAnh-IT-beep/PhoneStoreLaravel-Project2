<!DOCTYPE html>
<html lang="en">

<head>
    @include("admins.layouts.head")
    <title>BMobileShop</title>
     @livewireStyles
</head>
<body>
    <div class="flex flex-col min-h-screen">
        @include("clients.layouts.header")
        <div class="container mx-auto flex flex-1" style="gap: 20px">
            <div class="main-content flex-1 p-6">
                @yield("main-content")
            </div>
        </div>
    </div>
    @include('clients.layouts.footer')
    @livewireScripts
</body>

</html>

