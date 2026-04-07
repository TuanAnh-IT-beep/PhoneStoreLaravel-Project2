@extends("admins.layouts.master")

@section("main-content")
    <div class="w-full mb-4 flex items-center justify-between">
        <h1>Manufacturers → {{ $manufacturer->name }} → Edit</h1>
    </div>
    <div class="main-container">
        <form method="post" action="{{ route('manufacturers.update', $manufacturer->id) }}">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-10 gap-4">
                <div class="col-span-4">
                    <label for="name">Name:</label><br>
                    <input class="mt-2 w-full" type="text" name="name" placeholder="Input name here..."
                        value="{{ $manufacturer->name }}"><br>
                    <div class="flex gap-2 mt-4">
                        <button class="btn icon-only flex-1">UPDATE</button>
                        <a class="btn icon-only negative flex-1" href="{{ route('manufacturers.index') }}">CANCEL</a>
                    </div>
                </div>
                <div class="col-span-6">
                    <label for="description">Description:</label><br>
                    <textarea class="mt-2 w-full" name="description" placeholder="Input description here..."
                        rows="10">{{ $manufacturer->description }}</textarea><br>
                </div>
            </div>
        </form>
    </div>
@endsection
