@extends("admins.layouts.master")
@section('pageTitle', 'Subproducts - New')
@section("main-content")
    <div class="w-full mb-4 flex items-center justify-between">
        <h1>Products → {{ $product->name }} → Subproducts → New</h1>
    </div>
    <form method="post" action="{{ route('subproducts.store', $product) }}">
        @csrf
        <div class="main-container">
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
        </div>
        <div class="main-container mt-3">
            <div class="w-full mb-4 flex items-center justify-between">
                <h1>Specs</h1>
                <button type="button" class="btn" id="new_spec"><i class="fa-solid fa-plus"></i>ADD NEW ITEM</button>
            </div>
            <div id="specs_container" class="grid grid-cols-2 gap-4">
            </div>
            <div class="flex gap-2 mt-4">
                <button class="btn flex-1 icon-only">ADD</button>
                <a class="btn flex-1 icon-only negative" href="{{ route('subproducts.index', $product) }}">CANCEL</a>
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
                        option.disabled = selectedValues.includes(option.value) && option.value !== select.value;
                    }
                });
            });
        }

        document.getElementById('new_spec').addEventListener('click', function (e) {
            e.preventDefault();
            const container = document.getElementById('specs_container');
            const html = `
                        <div class="col-span-1 flex gap-2 mb-2 items-center">
                            <select name="specs[${specIndex}][spec_id]" class="w-full" required>
                                <option value="" disabled selected>Select a Spec</option>
                                @foreach($specs as $spec)
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

        document.getElementById('specs_container').addEventListener('change', function (e) {
            if (e.target && e.target.matches('select')) {
                updateSpecOptions();
            }
        });
    </script>
@endsection