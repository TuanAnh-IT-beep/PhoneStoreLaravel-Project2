@extends("layouts.master")

@section("main-content")
    <h1>Add a category</h1>
    <div class="main-container">
        <form method="post" action="{{ route('categories.store') }}">
            @csrf
            <div class="grid grid-cols-10 gap-4">
                <div class="col-span-4">
                    <label for="name">Name:</label><br>
                    <input class="mt-2 w-full" type="text" name="name" placeholder="Input name here..."><br>
                    <div class="flex gap-2 mt-4">
                        <button class="btn flex-1">Add</button>
                        <a class="btn flex-1" href="{{ route('categories.index') }}">Cancel</a>
                    </div>
                </div>
                <div class="col-span-6">
                    <label for="description">Description:</label><br>
                    <textarea class="mt-2 w-full" name="description" placeholder="Input description here..."
                        rows="10"></textarea><br>
                </div>
            </div>
        </form>
    </div>
@endsection