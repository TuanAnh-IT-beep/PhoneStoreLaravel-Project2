@extends('admins.layouts.master')
@section('pageTitle', 'Manufacturers → Edit')
@section('main-content')
    <div class="w-full mb-4 flex items-center justify-between">
        <h1>Manufacturers → {{ $manufacturer->name }} → Edit</h1>
    </div>
    @if (session('error'))
        <div class="p-4 text-sm text-red-500 rounded-xl bg-red-50 border border-red-400 font-normal mb-4" role="alert">
            <span class="font-semibold mr-2">Error</span>{{ session('error') }}
        </div>
    @endif
    <div class="main-container">
        <form method="post" action="{{ route('manufacturers.update', $manufacturer->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-10 gap-4">
                <div class="col-span-4">
                    <label for="name">Name:</label><br>
                    <input required class="mt-2 w-full" type="text" name="name" placeholder="Input name here..."
                        value="{{ $manufacturer->name }}"><br>
                    <div class="flex gap-2 mt-4">
                        <button class="btn icon-only flex-1">UPDATE</button>
                        <a class="btn icon-only negative flex-1" href="{{ route('manufacturers.index') }}">CANCEL</a>
                    </div>
                </div>
                <div class="col-span-6">
                    <label for="description">Description:</label><br>
                    <textarea class="mt-2 w-full" name="description" placeholder="Input description here..." rows="10">{{ $manufacturer->description }}</textarea><br>
                    <div class="flex items-center justify-between mt-2">
                        <div>
                            <label for="icon">Icon:</label>
                            <input class="my-3 mx-3" type="file" name="icon" accept="image/*"
                                onchange="previewIcon(event)">
                        </div>
                    </div>
                    <div class="flex justify-center">
                        <img id="icon_preview"
                            src="{{ $manufacturer->icon ? asset('storage/' . $manufacturer->icon) : '#' }}"
                            class="w-64 h-64 object-cover border rounded mb-3 {{ $manufacturer->icon ? '' : 'hidden' }}"
                            src="#" alt="Icon Preview">
                    </div>
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
            </div>
        </form>
    </div>
@endsection
