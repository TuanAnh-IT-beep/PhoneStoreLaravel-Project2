@extends("admins.layouts.master")
@section("main-content")
<div class="w-full mb-4 flex items-center justify-between">
        <h1>Add a payment method</h1>
    </div>
    <div class="main-container">
        <form method="post" action="{{ route('payment_methods.store') }}">
            @csrf
            <div class="grid grid-cols-10 gap-4">
                <div class="col-span-4">
                    <label for="name">Name:</label><br>
                    <input class="mt-2 w-full" type="text" name="name" placeholder="Input name here..."><br>
                    <div class="flex gap-2 mt-4">
                        <button class="btn flex-1 icon-only">ADD</button>
                        <a class="btn flex-1 icon-only negative" href="{{ route('payment_methods.index') }}">CANCEL</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

