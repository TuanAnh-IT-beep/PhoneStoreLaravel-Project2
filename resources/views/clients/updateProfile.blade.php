@extends('clients.layouts.master')
@section('main-content')
    @if (session('error'))
        <div class="p-4 text-sm text-red-500 rounded-xl bg-red-50 border border-red-400 font-normal mb-4" role="alert">
            <span class="font-semibold mr-2">Error</span>{{ session('error') }}
        </div>
    @endif
    <div class="main-container">
        <form method="post" action="{{ route('updateProfile') }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-10 gap-4">
                <div class="col-span-4">
                    <label for="name">Username:</label><br>
                    <input required class="my-3 w-full" type="text" name="username" placeholder="Input username here..."
                        value="{{ $cus->username }}"><br>
                    <label for="display_name">Display Name:</label><br>
                    <input required class="my-3 w-full" type="text" name="display_name"
                        placeholder="Input display name here..." value="{{ $cus->display_name }}"><br>
                    <label for="email">Email:</label><br>
                    <input required class="my-3 w-full" type="text" name="email" placeholder="Input email here..."
                        value="{{ $cus->email }}"><br>
                    <label for="phone">Phone:</label><br>
                    <input required class="my-3 w-full" type="text" name="phone" placeholder="Input phone here..."
                        value="{{ $cus->phone }}"><br>
                    <div class="flex gap-5">
                        <div class="w-full">
                            <label for="gender">Gender:</label><br>
                            <select class="w-full my-3" name="gender">
                                <option value="M" {{ $cus->gender == 'M' ? 'selected' : '' }}>Male</option>
                                <option value="F" {{ $cus->gender == 'F' ? 'selected' : '' }}>Female</option>
                                <option value="O" {{ $cus->gender == 'O' ? 'selected' : '' }}>Other</option>
                            </select><br>
                        </div>
                        <div class="w-full">
                            <label for="birthday">Birthday:</label><br>
                            <input class="my-3 w-full" type="date" name="birthday" placeholder="Input birthday here..."
                                value="{{ $cus->birthday }}"><br>
                        </div>
                    </div>
                    <label for="address">Address:</label><br>
                    <input class="my-3 w-full" type="text" name="address" placeholder="Input address here..."
                        value="{{ $cus->address }}"><br>
                    <input type="hidden" name="icon" value="">
                    <div class="flex gap-2 mt-4">
                        <button class="btn flex-1 icon-only">Update</button>
                        <a class="btn flex-1 icon-only negative" href="{{ route('profile') }}">CANCEL</a>
                    </div>
                </div>
                <div class="col-span-5">
                    <label for="icon">Icon:</label><br>
                    <input class="my-3" type="file" name="icon" accept="image/*" onchange="previewIcon(event)"><br>
                    <img id="icon_preview" src="{{ $cus->icon ? asset('storage/' . $cus->icon) : '#' }}"
                        alt="Icon Preview"
                        class="w-64 h-64 object-cover border rounded mb-3 {{ $cus->icon ? '' : 'hidden' }}"><br>

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
