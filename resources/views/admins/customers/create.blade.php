
@extends("admins.layouts.master")
@section("main-content")
<div class="w-full mb-4 flex items-center justify-between">
        <h1>Add a customer</h1>
    </div>
    <div class="main-container">
        <form method="post" action="{{ route('customers.store') }}">
            @csrf
            <div class="grid grid-cols-10 gap-4">
                <div class="col-span-4">
                    Name:<input class="mt-2 w-full" type="text" name="username" placeholder="Input username here..."><br>
                     Display Name: <input type="text" name="display_name"><br>
                      Email: <input type="text" name="email"><br>
                      Phone: <input type="text" name="phone"><br>
                      Birthday: <input type="date" name="birthday" placeholder="can be null"><br>
                       Address: <input type="text" name="address" placeholder="can be null"><br>
                    <div class="flex gap-2 mt-4">
                        <button class="btn flex-1 icon-only">ADD</button>
                        <a class="btn flex-1 icon-only negative" href="{{ route('customers.index') }}">CANCEL</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
