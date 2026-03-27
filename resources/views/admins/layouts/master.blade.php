<!DOCTYPE html>
<html lang="en">

<head>
    @include("admins.layouts.head")
    <title>BMobileShop</title>
</head>

<body>
    <div class="flex flex-col min-h-screen">
        @include("admins.layouts.header")
        <div class="container mx-auto flex flex-1" style="gap: 20px">
            <!-- Sidebar -->
            @include("admins.layouts.sidebar")
            <!-- Main Content -->
            <div class="main-content flex-1 p-6">
                @yield("main-content")
            </div>
        </div>

    </div>
</body>

</html>
