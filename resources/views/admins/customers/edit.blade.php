@extends("admins.layouts.master")
@section('pageTitle', 'Customers - Edit')
@section("main-content")
    <div class="w-full mb-4 flex items-center justify-between">
        <h1>Customers → {{$customer->username}} → Edit</h1>
    </div>
    <div class="main-container">
        <form method="post" action="{{ route('customers.update', $customer->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-10 gap-4">
                <div class="col-span-4">
                    <label for="name">Username:</label><br>
                    <input class="my-3 w-full" type="text" name="username" placeholder="Input username here..." value="{{ $customer->username }}"><br>
                    <label for="display_name">Display Name:</label><br>
                    <input class="my-3 w-full" type="text" name="display_name" placeholder="Input display name here..." value="{{ $customer->display_name }}"><br>
                    <label for="email">Email:</label><br>
                    <input class="my-3 w-full" type="text" name="email" placeholder="Input email here..." value="{{ $customer->email }}"><br>
                    <label for="phone">Phone:</label><br>
                    <input class="my-3 w-full" type="text" name="phone" placeholder="Input phone here..." value="{{ $customer->phone }}"><br>
                    <div class="flex gap-5">
                        <div class="w-full">
                            <label for="gender">Gender:</label><br>
                            <select class="w-full my-3" name="gender">
                                <option value="M" {{ $customer->gender == 'M' ? 'selected' : '' }}>Male</option>
                                <option value="F" {{ $customer->gender == 'F' ? 'selected' : '' }}>Female</option>
                                <option value="O" {{ $customer->gender == 'O' ? 'selected' : '' }}>Other</option>
                            </select><br>
                        </div>
                        <div class="w-full">
                            <label for="birthday">Birthday:</label><br>
                            <input class="my-3 w-full" type="date" name="birthday" placeholder="Input birthday here..." value="{{ $customer->birthday }}"><br>
                        </div>
                    </div>
                    <label for="address">Address:</label><br>
                    <input class="my-3 w-full" type="text" name="address" placeholder="Input address here..." value="{{ $customer->address }}"><br>
                    <input type="hidden" name="icon" value="">
                    <div class="flex gap-2 mt-4">
                        <button class="btn flex-1 icon-only">ADD</button>
                        <a class="btn flex-1 icon-only negative" href="{{ route('customers.index') }}">CANCEL</a>
                    </div>
                </div>
                <div class="col-span-5">
                    <label for="icon">Icon:</label><br>
                    <input class="my-3" type="file" name="icon" accept="image/*" onchange="previewIcon(event)"><br>
                    <img id="icon_preview" src="{{ $customer->icon ? asset('storage/' . $customer->icon) : '#' }}"
                        alt="Icon Preview"
                        class="w-64 h-64 object-cover border rounded mb-3 {{ $customer->icon ? '' : 'hidden' }}"><br>

                    <script>
                        function previewIcon(event) {
                            const output = document.getElementById('icon_preview');
                            if (event.target.files && event.target.files[0]) {
                                const reader = new FileReader();
                                reader.onload = function (e) {
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