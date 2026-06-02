@extends('clients.layouts.master')
@section('title', 'Update Profile')
@section('main-content')
    <div class="main-content px-6">
        <h1 class="text-3xl font-bold mb-8 text-gray-800">Update Profile</h1>

        @if (session('error'))
            <div class="p-4 text-sm text-red-500 rounded-xl bg-red-50 border border-red-200 font-medium mb-6 flex items-center gap-2"
                role="alert">
                <i class="fa-solid fa-circle-exclamation text-lg"></i>
                <span><span class="font-bold">Error:</span> {{ session('error') }}</span>
            </div>
        @endif

        <form method="post" action="{{ route('updateProfile') }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-12 gap-4">
                <div class="col-span-8">
                    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-200">
                        <div class="space-y-3">
                            <div>
                                <label for="username"
                                    class="block text-sm font-semibold text-gray-700 mb-1.5">Username</label>
                                <input type="text" id="username" name="username" value="{{ $cus->username }}" disabled
                                    class="w-full border border-gray-300 rounded-lg p-2.5 bg-gray-100 text-gray-500 cursor-not-allowed">
                                <p class=" text-gray-500 mt-1" style="font-size:1rem">Username cannot be changed once
                                    created.</p>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                                <div>
                                    <label for="display_name"
                                        class="block text-sm font-semibold text-gray-700 mb-1.5">Display Name</label>
                                    <input type="text" id="display_name" name="display_name"
                                        value="{{ $cus->display_name }}" required placeholder="Enter your display name"
                                        class="w-full border border-gray-300 rounded-lg p-2.5 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-shadow">
                                </div>
                                <div>
                                    <label for="phone" class="block text-sm font-semibold text-gray-700 mb-1.5">Phone
                                        Number</label>
                                    <input type="text" id="phone" name="phone" value="{{ $cus->phone }}" required
                                        placeholder="Enter your phone number"
                                        class="w-full border border-gray-300 rounded-lg p-2.5 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-shadow">
                                </div>
                            </div>

                            <div>
                                <label for="email" class="block text-sm font-semibold text-gray-700 mb-1.5">Email
                                    Address</label>
                                <input type="email" id="email" name="email" value="{{ $cus->email }}" required
                                    placeholder="Enter your email address"
                                    class="w-full border border-gray-300 rounded-lg p-2.5 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-shadow">
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                                <div>
                                    <label for="gender"
                                        class="block text-sm font-semibold text-gray-700 mb-1.5">Gender</label>
                                    <select id="gender" name="gender"
                                        class="w-full border border-gray-300 rounded-lg p-2.5 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-shadow bg-white">
                                        <option value="M" {{ $cus->gender == 'M' ? 'selected' : '' }}>Male</option>
                                        <option value="F" {{ $cus->gender == 'F' ? 'selected' : '' }}>Female</option>
                                        <option value="O" {{ $cus->gender == 'O' ? 'selected' : '' }}>Other</option>
                                    </select>
                                </div>
                                <div>
                                    <label for="birthday"
                                        class="block text-sm font-semibold text-gray-700 mb-1.5">Birthday</label>
                                    <input type="date" id="birthday" name="birthday" value="{{ $cus->birthday }}"
                                        class="w-full border border-gray-300 rounded-lg p-2.5 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-shadow">
                                </div>
                            </div>

                            <div>
                                <label for="address"
                                    class="block text-sm font-semibold text-gray-700 mb-1.5">Address</label>
                                <textarea type="text" id="address" name="address" placeholder="Enter your full address"
                                    class="w-full border border-gray-300 rounded-lg p-2.5 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-shadow">{{ $cus->address }}</textarea>
                            </div>
                        </div>

                        <div class="mt-8 flex flex-col sm:flex-row gap-3 justify-end pt-5 border-t border-gray-100">
                            <a href="{{ route('home') }}"
                                class="btn delete flex items-center justify-center gap-2">
                                Cancel
                            </a>
                            <button type="submit"
                                class="btn flex items-center justify-center gap-2">
                                <i class="fa-solid fa-save"></i> Save Changes
                            </button>
                        </div>
                    </div>
                </div>
                <div class="col-span-4">
                    <div
                        class="bg-white p-6 rounded-2xl shadow-sm border border-gray-200 flex flex-col items-center justify-center text-center sticky top-6">
                        <h2 class="text-lg font-bold text-gray-800 mb-6 w-full text-left border-b border-gray-100 pb-3">
                            Profile Picture</h2>

                        <div class="relative group mb-6">
                            <div
                                class="w-40 h-40 rounded-full border-4 border-white shadow-lg overflow-hidden bg-gray-50 flex items-center justify-center">
                                <img id="icon_preview" src="{{ $cus->icon ? asset('storage/' . $cus->icon) : '' }}"
                                    alt="Profile Picture"
                                    class="w-full h-full object-cover {{ $cus->icon ? '' : 'hidden' }}">
                                @if (!$cus->icon)
                                    <i class="fa-solid fa-user text-5xl text-gray-300" id="default_icon"></i>
                                @endif
                            </div>
                        </div>

                        <div class="w-full">
                            <label for="icon"
                                class="block w-full cursor-pointer bg-gray-50 border border-gray-300 text-gray-700 text-sm rounded-lg hover:bg-gray-100 transition-colors text-center px-4 py-2 font-medium">
                                <i class="fa-solid fa-camera mr-2"></i> Choose New Photo
                                <input type="file" id="icon" name="icon" accept="image/*"
                                    onchange="previewIcon(event)" class="hidden">
                            </label>
                            <p class="text-xs text-gray-500 mt-2" style="font-size: 1rem">JPG, GIF or PNG. Max size of 2MB.</p>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    </div>

    <script>
        function previewIcon(event) {
            const output = document.getElementById('icon_preview');
            const defaultIcon = document.getElementById('default_icon');

            if (event.target.files && event.target.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    output.src = e.target.result;
                    output.classList.remove('hidden');
                    if (defaultIcon) {
                        defaultIcon.classList.add('hidden');
                    }
                };
                reader.readAsDataURL(event.target.files[0]);
            }
        }
    </script>
@endsection
