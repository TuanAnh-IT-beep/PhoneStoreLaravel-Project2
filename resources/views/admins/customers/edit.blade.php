{{--

<body>
    <h3>Update a customer</h3>
    <form method="post" action="{{ route('customers.update', $customer->id) }}">
        @csrf
        @method('PUT')
        <input type="hidden" name="id" value="{{ $customer->id }}" />
        Username: <input type="text" name="username" value="{{ $customer->username }}"><br>
        Display Name: <input type="text" name="display_name" value="{{ $customer->display_name }}"><br>
        Email: <input type="text" name="email" value="{{ $customer->email }}"><br>
        Phone: <input type="text" name="phone" value="{{ $customer->phone }}"><br>
        Gender: <input type="radio" name="gender" value="{{ $customer->gender }}">{{ $customer->gender }}
        Birthday: <input type="date" name="birthday" value="{{ $customer->birthday }}"><br>
        Address: <input type="text" name="address" value="{{ $customer->address }}"><br>
        <input type="hidden" name="icon" value="">
        <button>Update</button>
    </form>
</body> --}}


@extends("admins.layouts.master")
@section("main-content")
    <div class="w-full mb-4 flex items-center justify-between">
        <h1>Customers → {{$customer->username}} → Edit</h1>
    </div>
    <div class="main-container">
        <form method="post" action="{{ route('customers.update', $customer->id) }}">
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
            </div>
        </form>
    </div>
@endsection