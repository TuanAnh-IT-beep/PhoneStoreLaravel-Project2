@extends("admins.layouts.master")

@section("main-content")
    <div class="w-full mb-4 flex items-center justify-between">
        <h1>Products → {{ $product->name }} → Subproducts → New</h1>
    </div>
    <div class="main-container">
        <form method="post" action="{{ route('subproducts.store') }}">
            @csrf
            <input type="hidden" name="product_id" value="{{ $product->id }}">
            <div class="grid grid-cols-10 gap-4">
                <div class="col-span-4">
                    <label for="name">Name:</label><br>
                    <input class="my-3 w-full" type="text" name="name" placeholder="Input subproduct name here..."><br>
                    <div class="flex gap-5">
                        <div class="w-full">
                            <label for="price">Price:</label><br>
                            <input class="my-3 w-full" type="number" name="price" placeholder="Input price here..."><br>
                        </div>
                        <div class="w-full">
                            <label for="stock">Stock:</label><br>
                            <input class="my-3 w-full" type="number" name="stock" placeholder="Input stock here..."><br>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="main-container mt-3">

        <!-- Specs -->
        <div class="w-full mb-4 flex items-center justify-between">
            <h1>Specs</h1>
            <a class="btn" href="#" id="new_spec"><i class="fa-solid fa-plus"></i>ADD NEW ITEM</a>
        </div>
        <div class="grid grid-cols-2 gap-4">
            <div class="col-span-1">
            </div>
        </div>
@endsection