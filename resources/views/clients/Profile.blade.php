@extends('clients.layouts.master')
@section('main-content')
    <div class="max-w-4xl mx-auto my-10 p-6 rounded-lg ">
        <h2 class="text-2xl font-semibold text-gray-800 mb-6 border-b pb-3">Profile</h2>
        <a class="btn" href="{{ route('getProfile') }}">Edit profile</a>
        <div class="flex flex-col md:flex-row gap-8 items-center md:items-start">
            <div class="flex flex-col items-center gap-3 w-full md:w-1/3">
                <div class="w-32 h-32 rounded-full overflow-hidden shadow-inner border-2 border-gray-200">
                    <img src="{{ asset('storage/' . $cus->icon) }}" alt="Avatar" class="w-full h-full object-cover">
                </div>
                <span class="text-sm font-medium text-gray-500">Avatar</span>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 w-full md:w-2/3">
                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-1">Username</label>
                    <input name="username" readonly value="{{ $cus->username }}"
                        class="w-full px-3 py-2 bg-gray-50 border border-gray-300 text-gray-500 rounded-md focus:outline-none">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-1">Display name</label>
                    <input readonly value="{{ $cus->display_name }}"
                        class="w-full px-3 py-2 bg-gray-50 border border-gray-300 text-gray-500 rounded-md focus:outline-none">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-1">Email</label>
                    <input readonly value="{{ $cus->email }}"
                        class="w-full px-3 py-2 bg-gray-50 border border-gray-300 text-gray-500 rounded-md focus:outline-none">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-1">Phone number</label>
                    <input readonly value="{{ $cus->phone }}"
                        class="w-full px-3 py-2 bg-gray-50 border border-gray-300 text-gray-500 rounded-md focus:outline-none">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-1">Gender</label>
                    @if ($cus->gender == 'M')
                        <input readonly value="Male"
                            class="w-full px-3 py-2 bg-gray-50 border border-gray-300 text-gray-500 rounded-md focus:outline-none">
                    @endif
                    @if ($cus->gender == 'F')
                        <input readonly value="Female"
                            class="w-full px-3 py-2 bg-gray-50 border border-gray-300 text-gray-500 rounded-md focus:outline-none">
                    @endif
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-1">Birthday</label>
                    <input readonly value="{{ $cus->birthday }}"
                        class="w-full px-3 py-2 bg-gray-50 border border-gray-300 text-gray-500 rounded-md focus:outline-none">
                </div>

                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-600 mb-1">Address</label>
                    <input readonly value="{{ $cus->address }}"
                        class="w-full px-3 py-2 bg-gray-50 border border-gray-300 text-gray-500 rounded-md focus:outline-none">
                </div>
            </div>
        </div>
    </div>
@endsection
