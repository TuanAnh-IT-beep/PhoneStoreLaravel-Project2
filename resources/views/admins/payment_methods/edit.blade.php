
@extends("admins.layouts.master")
@section("main-content")
<div class="w-full mb-4 flex items-center justify-between">
        <h1>Update a payment_method</h1>
    </div>
    <div class="main-container">
        <form method="post" action="{{ route('payment_methods.update', $payment_method->id) }}">
            @csrf
            <div class="grid grid-cols-10 gap-4">
                <div class="col-span-4">
                    <label for="name">Name:</label><br>
                    @method('PUT')
        <input type="hidden" name="id" value="{{ $payment_method->id }}" />
        Name: <input type="text" name="name" value="{{ $payment_method->name }}"><br>
        <input type="hidden" name="icon" value="">
        <button class="btn flex-1 icon-only" style="padding:7px;margin-top:10px;margin-left:53px">Update</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
