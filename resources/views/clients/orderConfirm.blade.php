@extends('clients.layouts.master')
@section('main-content')
    <div class="w-full">
        <div class="grid grid-cols-12 gap-10">
            <div class="col-span-12 col-span-6">
                <h1 class="text-3xl font-bold mb-6 text-gray-800">Order Confirmation</h1>
                <div class="bg-white p-6 rounded-xl shadow-sm">
                    <form action="{{ route('order.confirm') }}" method="POST">
                        @csrf
                        @method('POST')
                        <input type="hidden" name="placer" value="{{ auth()->guard('client')->id() }}">
                    <label for="receiver" class="block text-sm font-medium text-gray-700 mb-1">Receiver Name</label>
                    <input type="text" name="receiver" class="w-50 border border-gray-300 rounded-md p-3 mb-4">
                    <label for="address" class="block text-sm font-medium text-gray-700 mb-1">Delivery Address</label>
                    <input type="text" name="address" class="w-50 border border-gray-300 rounded-md p-3 mb-4">
                    <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Phone Number</label>
                    <input type="text" name="phone" class="w-50 border border-gray-300 rounded-md p-3 mb-4">
                    <input type="hidden" name="total_price" value="{{ $totalPrice }}">
                    <input type="hidden" name="status" value="0">
                    <label for="payment" class="block text-sm font-medium text-gray-700 mb-1">Payment Method</label>
                    <select name="payment" id="payment" class="w-30 border border-gray-300 rounded-md p-3 mb-4">
                        @foreach ($payment as $pay)
                            <option value="{{ $pay->id }}" selected >{{ $pay->name }}</option>
                        @endforeach
                    </select>
                    <label for="Note" class="block text-sm font-medium text-gray-700 mb-1">Additional Notes</label>
                    <input type="text" name="Note" class="w-50 border border-gray-300 rounded-md p-3 mb-4" style="height: 150px;width: 400px;   ">
                    <div>
                        <button type="submit"
                            class="bg-red-300 text-gray-700 px-4 py-2 rounded-md mr-2 hover:bg-gray-400 transition-colors" style="width: 250px;">
                                Place Order
                        </button>
                    </form>
                    </div>
                </div>
            </div>
            <div class="col-span-12 col-span-6" style="margin-top:40px">
                <div class=" bg-white p-6 rounded-xl shadow-sm" style="margin-top:20px;">
                    <!-- Order summary details here -->
                    @foreach ($cart as $id => $item)
                        <!-- Card Container: relative để làm gốc cho icon X tuyệt đối -->
                        <div class="w-120 p-6 relative flex items-center gap-6"
                            style="background-color: #fafafadc; border-radius: 12px;border: 1px solid #e5e7eb;margin-left:100px">
                            <!-- 2. Hình ảnh sản phẩm (Ví dụ) -->
                            <div class="w-12 h-12 flex-shrink-0">
                                <img src="{{ asset('storage/' . $item['thumbnail_path']) }}" alt="Product"
                                    class="w-full h-full object-cover rounded-lg">
                            </div>

                            <!-- 3. Nội dung: Tên, Giá, Số lượng -->
                            <div class="flex-grow flex flex-col md:flex-row md:items-center justify-between gap-4">

                                <!-- Tên sản phẩm -->
                                <div class="flex-grow">
                                    <h3 style="font-size:15px" class="font-bold text-gray-800 leading-tight">
                                        {{ $item['name'] }}</h3>
                                </div>
                                <div class="text-left md:text-right min-w-[120px]">
                                    <p name="stock" style="font-size:15px" class="text-gray-400">Quantity:
                                        {{ $item['stock'] }}</p>
                                </div>
                                <!-- Giá tiền -->
                                <div class="text-left md:text-right min-w-[120px]">
                                    <p style="font-size:15px" class="text-gray-400">
                                        {{ number_format($item['price'] * $item['stock'], 0, ',', '.') }}đ</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <div>
                        <button class="bg-green-600 text-white px-4 py-2 rounded-md hover:bg-green-700 transition-colors"
                            style="margin-top: 10px;margin-left:100px"><a href="{{ route('cart') }}">Edit Order</a></button>
                    </div>
                    <div style="margin-top: 10px;margin-left:100px">
                        <p class=" font-bold text-gray-500" style="font-size:15px">Shipping Fee: 40.000đ</p>
                        <p class=" font-bold text-gray-800" style="font-size:15px">Products Price :
                            {{ number_format($item['price'] * $item['stock'], 0, ',', '.') }}đ
                        </p>
                        <p class=" font-bold text-gray-800" style="font-size:15px">Total:
                            {{ number_format($totalPrice, 0, ',', '.') }}đ
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
