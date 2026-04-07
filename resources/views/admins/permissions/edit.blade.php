@extends("admins.layouts.master")
@section("main-content")
    <div class="w-full mb-4 flex items-center justify-between">
        <h1>Settings → Permissions → {{ $permission->name }} → Edit</h1>
    </div>
    <div class="main-container">
        <form method="post" action="{{ route('permissions.update', $permission->id) }}">
            @csrf
            <div class="grid grid-cols-10 gap-4">
                <div class="col-span-4">
                    <label for="name">Name:</label><br>
                    <input class="my-3 w-full" type="text" name="name" placeholder="Input name here..." value="{{ $permission->name }}"><br>
                    <div class="flex gap-2 mt-4">
                        <button class="btn flex-1 icon-only">UPDATE</button>
                        <a class="btn flex-1 icon-only negative" href="{{ route('admins.settings.index') }}">CANCEL</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection