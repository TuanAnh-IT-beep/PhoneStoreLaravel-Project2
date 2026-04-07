@extends("admins.layouts.master")
@section('pageTitle', 'Products - Edit {{ $product->name }}')
@section("main-content")
    <div class="w-full mb-4 flex items-center justify-between">
        <h1>Products → {{ $product->name }} → Edit</h1>
    </div>
    <div class="main-container">
        <form method="post" action="{{ route('products.update', $product->id) }}">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-10 gap-4">
                <div class="col-span-4">
                    <label for="name">Name:</label><br>
                    <input class="my-3 w-full" type="text" name="name" placeholder="Input product name here..." value="{{ $product->name }}"><br>
                    <div class="flex gap-5">
                        <div class="w-full">
                            <label for="category_id">Category:</label><br>
                            <select class="w-full my-3" name="category_id">
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select><br>
                        </div>
                        <div class="w-full">
                            <label for="manufacturer_id">Manufacturer:</label><br>
                            <select class="w-full my-3" name="manufacturer_id">
                                @foreach($manufacturers as $manufacturer)
                                    <option value="{{ $manufacturer->id }}" {{ $product->manufacturer_id == $manufacturer->id ? 'selected' : '' }}>
                                        {{ $manufacturer->name }}
                                    </option>
                                @endforeach
                            </select><br>
                        </div>
                    </div>
                    <label for="released_date">Release date:</label><br>
                    <input class="my-3 w-full" type="date" name="released_date" value="{{ $product->released_date }}"><br>
                    <div class="flex gap-2 mt-4">
                        <button class="btn flex-1 icon-only">UPDATE</button>
                        <a class="btn flex-1 icon-only negative" href="{{ route('products.index') }}">CANCEL</a>
                    </div>
                </div>
                <div class="col-span-6">
                    <label for="description">Description:</label><br>
                    <div class="my-3 w-full">
                        <textarea name="description" id="description" placeholder="Input description here..."
                            rows="10">{{ $product->description }}</textarea><br>
                        <script>
                            tinymce.init({
                                selector: '#description',
                                onboarding: false
                            });
                        </script>
                    </div>
                </div>
            </div>
        </form>
    </div>
    {{-- <div class="main-container mt-3">

        <!-- Product variants and specs-->

    </div> --}}
@endsection