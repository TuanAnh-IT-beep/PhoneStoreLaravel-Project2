@extends('admins.layouts.master')
@section('pageTitle', 'Products → Edit')
@section('main-content')
    <div class="w-full mb-4 flex items-center justify-between">
        <h1>Products → {{ $product->name }} → Edit</h1>
    </div>
    @if (session('error'))
        <div class="p-4 text-sm text-red-500 rounded-xl bg-red-50 border border-red-400 font-normal mb-4" role="alert">
            <span class="font-semibold mr-2">Error</span>{{ session('error') }}
        </div>
    @endif
    <div class="main-container">
        <form method="post" action="{{ route('products.update', $product->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-10 gap-4">
                <div class="col-span-4">
                    <label for="name">Name:</label><br>
                    <input required class="my-3 w-full" type="text" name="name"
                        placeholder="Input product name here..." value="{{ $product->name }}"><br>
                    <label for="featured">Featured:</label><br>
                    <input class="my-3" type="checkbox" name="featured" value="1"
                        {{ $product->featured ? 'checked' : '' }}><br>
                    <div class="flex gap-5">
                        <div class="w-full">
                            <label for="category_id">Category:</label><br>
                            <select required class="w-full my-3" name="category_id">
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ $product->category_id == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select><br>
                        </div>
                        <div class="w-full">
                            <label for="manufacturer_id">Manufacturer:</label><br>
                            <select required class="w-full my-3" name="manufacturer_id">
                                @foreach ($manufacturers as $manufacturer)
                                    <option value="{{ $manufacturer->id }}"
                                        {{ $product->manufacturer_id == $manufacturer->id ? 'selected' : '' }}>
                                        {{ $manufacturer->name }}
                                    </option>
                                @endforeach
                            </select><br>
                        </div>
                    </div>
                    <label for="released_date">Release date:</label><br>
                    <input required class="my-3 w-full" type="date" name="released_date"
                        value="{{ $product->released_date }}"><br>
                    <div class="flex gap-2 mt-4">
                        <button class="btn flex-1 icon-only">UPDATE</button>
                        <a class="btn flex-1 icon-only negative" href="{{ route('products.index') }}">CANCEL</a>
                    </div>
                </div>
                <div class="col-span-6">
                    <label for="description">Description:</label><br>
                    <div class="my-3 w-full">
                        <textarea name="description" id="description" placeholder="Input description here..." rows="10">{{ $product->description }}</textarea><br>
                        <script>
                            tinymce.init({
                                selector: '#description',
                                onboarding: false,
                                plugins: 'image',
                                toolbar: 'undo redo | blocks | bold italic | alignleft aligncenter alignright | image',
                                images_upload_handler: (blobInfo, progress) => new Promise((resolve, reject) => {
                                    const xhr = new XMLHttpRequest();
                                    xhr.withCredentials = false;
                                    xhr.open('POST', '{{ route('products.upload_image') }}');
                                    xhr.setRequestHeader('X-CSRF-TOKEN', '{{ csrf_token() }}');

                                    xhr.upload.onprogress = (e) => {
                                        progress(e.loaded / e.total * 100);
                                    };

                                    xhr.onload = () => {
                                        if (xhr.status === 403) {
                                            reject({ message: 'HTTP Error: ' + xhr.status, remove: true });
                                            return;
                                        }
                                        if (xhr.status < 200 || xhr.status >= 300) {
                                            reject('HTTP Error: ' + xhr.status);
                                            return;
                                        }
                                        const json = JSON.parse(xhr.responseText);
                                        if (!json || typeof json.location != 'string') {
                                            reject('Invalid JSON: ' + xhr.responseText);
                                            return;
                                        }
                                        resolve(json.location);
                                    };

                                    xhr.onerror = () => {
                                        reject('Image upload failed due to a XHR Transport error. Code: ' + xhr.status);
                                    };

                                    const formData = new FormData();
                                    formData.append('file', blobInfo.blob(), blobInfo.filename());
                                    xhr.send(formData);
                                })
                            });
                        </script>
                    </div>
                    <div class="mt-4">
                        <label>Product Images:</label><br>
                        <input type="file" id="image_selector" class="my-3 w-full" multiple accept="image/*"
                            onchange="addImages(this)">
                        <input type="file" name="images[]" id="images_upload" class="hidden" multiple>
                        {{--
                        input đầu tiên sẽ được hiện để cho phép người dùng upload ảnh, sau khi upload sẽ chạy hàm addImages
                        hàm addImages sẽ cập nhật thẻ input thứ hai bị ẩn để đưa lên controller giải quyết và cập nhật preview
                        làm kiểu này để hỗ trợ upload từng cái một
                        --}}
                        <div class="flex flex-wrap gap-4 mt-2 mb-4" id="image_previews">
                            @foreach ($product->images as $image)
                                <div class="text-center relative inline-block"
                                    id="existing_image_container_{{ $image->id }}">
                                    <img src="{{ asset('storage/' . $image->path) }}"
                                        class="w-24 h-24 object-cover border-2 rounded {{ $product->thumbnail_path == $image->path ? 'border-blue-500' : 'border-gray-300' }}">
                                    <button type="button"
                                        class="absolute -top-2 -right-2 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center text-xs shadow hover:bg-red-600"
                                        onclick="removeExistingImage({{ $image->id }})">X</button>
                                    <br>
                                    <input type="radio" name="thumbnail_image" value="{{ $image->path }}"
                                        {{ $product->thumbnail_path == $image->path ? 'checked' : '' }}>
                                    <label class="text-sm">Thumbnail</label>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <script>
                        const dataTransfer = new DataTransfer();
                        // api kéo thả files, sử dụng để quản lý các ảnh được upload dễ dàng hơn
                        document.addEventListener('change', function(e) {
                            if (e.target.name === 'thumbnail_image') {
                                document.querySelectorAll('#image_previews img').forEach(img => {
                                    img.classList.remove('border-blue-500');
                                    img.classList.add('border-gray-300');
                                });
                                const img = e.target.closest('div').querySelector('img');
                                if (img) {
                                    img.classList.remove('border-gray-300');
                                    img.classList.add('border-blue-500');
                                }
                            }
                        });
                        // hàm thêm ảnh
                        function addImages(input) {
                            Array.from(input.files).forEach(file => {
                                dataTransfer.items.add(file);
                            });
                            // cập nhật input ẩn sẽ được sử dụng trong controller
                            document.getElementById('images_upload').files = dataTransfer.files;
                            input.value = ''; // reset lại input selector
                            // chạy hàm cập nhật preview
                            renderPreviews();
                        }
                        // hảm cập nhật preview
                        function renderPreviews() {
                            const previewContainer = document.getElementById('image_previews');
                            const files = document.getElementById('images_upload').files;
                            document.querySelectorAll('.new-image-preview').forEach(el => el.remove());

                            const checkedRadio = document.querySelector('input[name="thumbnail_image"]:checked');
                            let currentSelection = checkedRadio ? checkedRadio.value : '';

                            if (currentSelection.startsWith('new_')) {
                                let selectedIndex = parseInt(currentSelection.replace('new_', ''));
                                if (selectedIndex >= files.length) {
                                    currentSelection = '';
                                }
                            }
                            Array.from(files).forEach((file, index) => {
                                const radioValue = 'new_' +
                                index; // sử dụng để phân biệt giữa ảnh sẽ upload và ảnh đã upload trước đó, phục vụ cho hàm xóa ảnh
                                const isChecked = (currentSelection === radioValue);
                                const reader = new FileReader();
                                reader.onload = function(e) {
                                    const div = document.createElement('div');
                                    div.className = 'text-center relative inline-block new-image-preview';
                                    div.innerHTML = `
                                        <img src="${e.target.result}" class="w-24 h-24 object-cover border-2 rounded ${isChecked ? 'border-blue-500' : 'border-gray-300'}">
                                        <button type="button" class="absolute -top-2 -right-2 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center text-xs shadow hover:bg-red-600" onclick="removeImage(${index})">X</button>
                                        <br>
                                        <input type="radio" name="thumbnail_image" value="${radioValue}" ${isChecked ? 'checked' : ''}>
                                        <label class="text-sm">Thumbnail</label>
                                    `;
                                    previewContainer.appendChild(div);
                                }
                                reader.readAsDataURL(file);
                            });
                        }

                        function removeImage(index) {
                            const newDt = new DataTransfer();
                            Array.from(dataTransfer.files).forEach((file, i) => {
                                if (i !== index) newDt.items.add(file);
                            });

                            dataTransfer.items.clear();
                            Array.from(newDt.files).forEach(file => dataTransfer.items.add(file));
                            document.getElementById('images_upload').files = dataTransfer.files;
                            renderPreviews();
                        }

                        function removeExistingImage(id) {
                            document.getElementById('existing_image_container_' + id).style.display = 'none';
                            const input = document.createElement('input');
                            input.type = 'hidden';
                            input.name = 'deleted_images[]';
                            input.value = id;
                            document.querySelector('form').appendChild(input);
                        }
                    </script>
                </div>
            </div>
        </form>
    </div>
    {{-- <div class="main-container mt-3">

        <!-- Product variants and specs-->

    </div> --}}
@endsection
