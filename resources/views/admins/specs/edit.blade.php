@extends("admins.layouts.master")
@section('pageTitle', 'Specs - Edit {{ $spec->name }}')
@section("main-content")
    <div class="w-full mb-4 flex items-center justify-between">
        <h1>Settings → Specs → {{ $spec->name }} → Edit</h1>
    </div>
    <div class="main-container">
        <form method="post" action="{{ route('specs.update', $spec->id) }}">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-10 gap-4">
                <div class="col-span-4">
                    <label for="name">Name:</label><br>
                    <input class="mt-2 w-full" type="text" name="name" value="{{ $spec->name }}"
                        placeholder="Input name here..."><br>
                    <div class="flex gap-2 mt-4">
                        <button class="btn flex-1 icon-only">UPDATE</button>
                        <a class="btn flex-1 icon-only negative" href="{{ route('admins.settings.index') }}">CANCEL</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection