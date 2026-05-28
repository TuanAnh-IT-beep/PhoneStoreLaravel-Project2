@extends('clients.layouts.master')
@section('main-content')
    <div class="mx-auto p-4 md:p-8 bg-white font-sans text-gray-900" style="border-radius:30px;">
        <div class="grid grid-cols-12 gap-12">
            <div class="col-span-6">
                <div class="sticky top-4">
                    <div
                        class="relative rounded-3xl overflow-hidden bg-gray-100 aspect-square flex items-center justify-center border">
                        <img src="{{ asset('storage/' . $subproduct->thumbnail_path) }}" alt="{{ $subproduct->name }}"
                            class="w-full h-full object-cover">
                    </div>
                </div>
            </div>

            <div class="col-span-6 space-y-6">
                <div>
                    <h1 class="text-3xl font-bold">{{ $subproduct->name }}</h1>
                    <div class="text-sm text-gray-500 mt-2">Mã SP: #{{ $subproduct->id }}</div>
                </div>

                <div class="bg-red-50 rounded-2xl p-6 border border-red-100">
                    <span class="text-3xl font-extrabold text-red-600">
                        {{ number_format($subproduct->price, 0, ',', '.') }}đ
                    </span>
                </div>

                <div>
                    <label class="font-bold text-lg block mb-3 inter">Phiên bản</label>
                    <div class="grid grid-cols-2 gap-3">
                        @foreach ($subproducts as $subs)
                            <a href="/{{ $subs->product->id }}/{{ $subs->id }}/details"
                                class="flex items-center gap-4 p-3 border rounded-xl hover:border-red-500 transition-all {{ $subs->id == $subproduct->id ? 'border-red-500 bg-red-50' : 'bg-white' }}">
                                <div class="w-16 h-16 shrink-0">
                                    <img src="{{ asset('storage/' . $subs->thumbnail_path) }}"
                                        class="w-full h-full object-cover rounded-lg border">
                                </div>
                                <div class="flex-1">
                                    <div class="font-bold text-gray-800">{{ $subs->name }}</div>
                                    <div class="text-red-600 font-semibold">{{ number_format($subs->price, 0, ',', '.') }}đ
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>

                <button class="w-full bg-red-600 text-white py-4 rounded-2xl font-bold text-lg hover:bg-red-700 transition">
                    <a href="{{ route('add', $subproduct->id) }}" class="block text-center" style="color: white;">
                        THÊM VÀO GIỎ HÀNG
                    </a>
                </button>
                <div>
                    <h3 class="text-2xl font-bold mb-3 inter">Thông số kỹ thuật</h3>
                    <div class="border border-gray-200 rounded-2xl overflow-hidden">
                        <table class="w-full text-sm">
                            <tbody>
                                @foreach ($subproduct->sub_specs as $spec)
                                    <tr class="border-b last:border-none">
                                        <td class="p-4 font-semibold bg-gray-50 text-gray-600 w-1/3">
                                            {{ $spec->spec?->name ?? 'N/A' }}
                                        </td>
                                        <td class="p-4 text-gray-900">
                                            {{ $spec->value }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="my-3 border-t border-gray-100"></div>
        <div>
            <h1 class="text-2xl font-bold mb-6 inter">Mô tả sản phẩm</h3>
                <div class="prose max-w-none text-gray-700">
                    <!-- Nội dung mô tả từ database -->
                    {!! $subproduct->product->description ?? 'Đang cập nhật nội dung mô tả...' !!}
                </div>
        </div>
    </div>
@endsection
