@extends("admins.layouts.master")
@section("main-content")
    <div class="w-full mb-4 flex items-center justify-between">
        <h1>Settings → Roles → New</h1>
    </div>
    <div class="main-container">
        <form method="post" action="{{ route('roles.store') }}">
            @csrf
            <div class="grid grid-cols-10 gap-4">
                <div class="col-span-4">
                    <label for="name">Name:</label><br>
                    <input class="my-3 w-full" type="text" name="name" placeholder="Input name here..."><br>
                    <label class="my-3 block" for="permissions">Permissions:</label>
                    <div class="my-3 grid grid-cols-2 gap-2">
                        @foreach ($permissions as $permission)
                            <div>
                                <input type="checkbox" name="permissions[]" value="{{ $permission->id }}" id="perm_{{ $permission->id }}">
                                <label for="perm_{{ $permission->id }}">{{ $permission->name }}</label>
                            </div>
                        @endforeach
                    </div>

                    <div class="flex gap-2 mt-4">
                        <button class="btn flex-1 icon-only">ADD</button>
                        <a class="btn flex-1 icon-only negative" href="{{ route('admins.settings.index') }}">CANCEL</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection