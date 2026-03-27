@extends("layouts.master")

@section("main-content")
    <div class="w-full mb-4 flex items-center justify-between">
        <h1>Products → New</h1>
    </div>
    <div class="main-container">
        <form method="post" action="{{ route('products.store') }}">
            @csrf
            <div class="grid grid-cols-10 gap-4">
                <div class="col-span-4">
                    <label for="name">Name:</label><br>
                    <input class="my-3 w-full" type="text" name="name" placeholder="Input product name here..."><br>
                    <div class="flex gap-5">
                        <div class="w-full">
                            <label for="category_id">Category:</label><br>
                            <select class="w-full my-3" name="category_id">
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select><br>
                        </div>
                        <div class="w-full">
                            <label for="manufacturer_id">Manufacturer:</label><br>
                            <select class="w-full my-3" name="manufacturer_id">
                                @foreach($manufacturers as $manufacturer)
                                    <option value="{{ $manufacturer->id }}">{{ $manufacturer->name }}</option>
                                @endforeach
                            </select><br>
                        </div>
                    </div>
                    <label for="released_date">Release date:</label><br>
                    <input class="my-3 w-full" type="date" name="released_date"><br>
                </div>
                <div class="col-span-6">
                    <label for="description">Description:</label><br>
                    <div class="my-3 w-full">
                        <textarea name="description" id="description"
                            placeholder="Input description here..." rows="10">{{ $category->description }}</textarea><br>
                        <script>
                            tinymce.init({
                                selector: '#description',
                            });
                        </script>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="main-container">
        <!-- Product variants and specs-->

    </div>
@endsection