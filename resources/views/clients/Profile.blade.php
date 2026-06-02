@extends('clients.layouts.master')
@section('main-content')
    <div class="max-w-4xl mx-auto my-10 p-6 rounded-lg ">
        <h2 class="text-2xl font-semibold text-gray-800 mb-6 border-b pb-3">Profile</h2>
        <a class="btn" href="{{ route('getProfile') }}">Edit profile</a>
        <a class="btn" href="#" onclick="toggleModal('{{ route('changePass') }}')">Change password</a>
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
    <div id="ChangepasswordModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 backdrop-blur-sm"
        style="@if(session('error') || session('success')) display: flex; @else display: none; @endif position: fixed; top: 0; left: 0; width: 100%; height: 100%;">

        <div
            class="bg-white rounded-[2.5rem] p-8 md:p-12 shadow-2xl max-w-md w-full mx-4 text-center border border-gray-100 flex flex-col">
            @if (session('success'))
                <div class="mb-4 p-3 bg-green-100 border border-green-400 text-green-700 rounded-lg text-sm font-medium">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="mb-4 p-3 bg-red-100 border border-red-400 text-red-700 rounded-lg text-sm font-medium">
                    {{ session('error') }}
                </div>
            @endif
            <div class="flex justify-center mb-8">
                <p>Password Change</p>
            </div>
            <form action="" method="POST" id="ChangepasswordForm">
                <div>
                    <label for="currentPass">Current Password:</label>
                    <input type="password" name="currentPass">
                </div>
                <div>
                    <label for="newPass">New Password:</label>
                    <input type="password" name="newPass">
                </div>
                <div>
                    <label for="newPassrepeat">Re-enter New Password:</label>
                    <input type="password" name="newPassrepeat">
                </div>
                <div class="flex flex-row justify-between gap-4 w-full" style="margin-top:5px">
                    <button type="button" onclick="toggleModal()"
                        class="py-4 bg-[#c4c4c4] text-gray-800 font-bold text-lg rounded-full hover:bg-gray-400 transition-colors border-0"
                        style="width:100px">
                        Close
                    </button>

                    @csrf
                    @method('PUT')
                    <button type="submit"
                        class=" py-4 bg-[#ff2d20] font-bold text-lg rounded-full hover:bg-red-700 shadow-md transition-all border-0"
                        style="width:100px">
                        Change
                    </button>
                </div>
            </form>
        </div>
    </div>
    </div>
    <script>
        function toggleModal(actionUrl = null) {
            const modal = document.getElementById('ChangepasswordModal');
            const form = document.getElementById('ChangepasswordForm');

            if (modal.style.display === 'none' || modal.style.display === '') {
                if (actionUrl) form.action = actionUrl;
                modal.style.display = 'flex';
            } else {
                modal.style.display = 'none';
            }
        }
    </script>
@endsection
