@extends('admins.layouts.master')
@section('pageTitle', 'Subproducts - New')
@section('main-content')
    <div class="w-full mb-4 flex items-center justify-between">
        <h1>Products → {{ $product->name }} → Subproducts → New</h1>
    </div>
    @if (session('error'))
        <div class="p-4 text-sm text-red-500 rounded-xl bg-red-50 border border-red-400 font-normal mb-4" role="alert">
            <span class="font-semibold mr-2">Error</span>{{ session('error') }}
        </div>
    @endif
    <form method="post" action="{{ route('subproducts.store', $product) }}">
        @csrf
        <div class="main-container">
            <input type="hidden" name="product_id" value="{{ $product->id }}">
            <div class="grid grid-cols-10 gap-4">
                <div class="col-span-4">
                    <label for="name">Name:</label><br>
                    <input required class="my-3 w-full" type="text" name="name"
                        placeholder="Input subproduct name here..."><br>
                    <div class="flex gap-5">
                        <div class="w-full">
                            <label for="price">Price:</label><br>
                            <input required class="my-3 w-full" type="number" name="price"
                                placeholder="Input price here..."><br>
                        </div>
                        <div class="w-full">
                            <label for="stock">Stock:</label><br>
                            <input required class="my-3 w-full" type="number" name="stock"
                                placeholder="Input stock here..."><br>
                        </div>
                    </div>
                </div>
                <div class="col-span-6">
                    <label>Thumbnail:</label><br>
                    <div class="flex flex-wrap gap-4 mt-3 mb-4" id="thumbnail_selector">
                        @foreach ($product->images as $image)
                            <div class="text-center relative inline-block">
                                <img src="{{ asset('storage/' . $image->path) }}"
                                    class="w-24 h-24 object-cover border-2 rounded {{ $loop->first ? 'border-blue-500' : 'border-gray-300' }}">
                                <br>
                                <input type="radio" name="thumbnail_path" value="{{ $image->path }}"
                                    {{ $loop->first ? 'checked' : '' }} onchange="updateThumbnailSelection(this)">
                                <label class="text-sm">Thumbnail</label>
                            </div>
                        @endforeach
                    </div>
                    <script>
                        function updateThumbnailSelection(radio) {
                            document.querySelectorAll('#thumbnail_selector img').forEach(img => {
                                img.classList.remove('border-blue-500');
                                img.classList.add('border-gray-300');
                            });
                            const img = radio.previousElementSibling.previousElementSibling;
                            if (img) {
                                img.classList.remove('border-gray-300');
                                img.classList.add('border-blue-500');
                            }
                        }
                    </script>
                </div>
            </div>
        </div>
        <div class="main-container mt-3">
            <div class="w-full mb-4 flex items-center justify-between">
                <h1>Specs</h1>
                <button type="button" class="btn" id="new_spec"><i class="fa-solid fa-plus"></i>ADD NEW ITEM</button>
            </div>
            <div id="specs_container" class="grid grid-cols-2 gap-4">
            </div>
            <div class="flex gap-2 mt-4">
                <div class="flex gap-2">
                    <button class="btn flex-1 icon-only">ADD</button>
                    <a class="btn flex-1 icon-only negative" href="{{ route('subproducts.index', $product) }}">CANCEL</a>
                </div>
            </div>
        </div>
    </form>

    <script>
        let specIndex = 0;

        function updateSpecOptions() {
            const selects = document.querySelectorAll('#specs_container select');
            const selectedValues = Array.from(selects).map(s => s.value).filter(v => v !== '');

            selects.forEach(select => {
                Array.from(select.options).forEach(option => {
                    if (option.value !== '') {
                        option.disabled = selectedValues.includes(option.value) && option.value !== select
                            .value;
                    }
                });
            });
        }

        document.getElementById('new_spec').addEventListener('click', function(e) {
            e.preventDefault(); // (chặn reload page sau khi ấn nứt thêm spec)
            const container = document.getElementById('specs_container');
            const html = `
                                <div class="col-span-1 flex gap-2 mb-2 items-center">
                                    <select name="specs[${specIndex}][spec_id]" class="w-full" required>
                                        <option value="" disabled selected>Select a Spec</option>
                                        @foreach ($specs as $spec)
                                            <option value="{{ $spec->id }}">{{ $spec->name }}</option>
                                        @endforeach
                                    </select>
                                    <input type="text" name="specs[${specIndex}][value]" class="w-full" placeholder="Value" required>
                                    <button type="button" class="btn delete icon-only" onclick="this.parentElement.remove(); updateSpecOptions();"><i class="fa-solid fa-trash"></i></button>
                                </div>
                            `;
            container.insertAdjacentHTML('beforeend', html);
            specIndex++;
            updateSpecOptions();
        });

        document.getElementById('specs_container').addEventListener('change', function(e) {
            if (e.target && e.target.matches('select')) {
                updateSpecOptions();
            }
        });
    </script>
@endsection
