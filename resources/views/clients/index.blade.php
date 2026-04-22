
@extends('clients.layouts.master')
@section('main-content')
<body class="bg-[#48a892] p-4 md:p-8 font-sans">
    <div class="max-w-6xl mx-auto space-y-10">
        <!-- Carousel Section -->
        <div id="carouselExampleIndicators" class="carousel slide rounded-[2.5rem] overflow-hidden shadow-lg" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="https://via.placeholder.com/1200x400?text=Promotion+1" class="d-block w-full" alt="Promotion 1">
                </div>
                <div class="carousel-item">
                    <img src="https://via.placeholder.com/1200x400?text=Promotion+2" class="d-block w-full" alt="Promotion 2">
                </div>
                <div class="carousel-item">
                    <img src="https://via.placeholder.com/1200x400?text=Promotion+3" class="d-block w-full" alt="Promotion 3">
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>      

        <!-- 2. Top Smartphones & Tablets Section -->
        <div class="bg-[#b4f4d4] rounded-[2.5rem] p-8 shadow-lg">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-black italic uppercase tracking-tight">Top Smartphones & Tablets</h2>
                <a href="#" class="text-xs font-bold text-gray-600 underline">View All »</a>
            </div>

            <!-- Top Grid (Banner & Categories) -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
                <!-- Promo Banner -->
                <div class="md:col-span-1 bg-gradient-to-r from-gray-200 to-blue-200 rounded-2xl p-6 flex relative overflow-hidden h-40 items-center">
                    <div>
                        <h3 class="text-lg font-bold leading-tight">REDMI NOTE<br>12 PRO+ 5G</h3>
                        <button class="mt-4 bg-black text-white text-[10px] px-4 py-2 rounded-md">SHOP NOW</button>
                    </div>
                    <div class="absolute right-0 bottom-0 w-1/2 h-full bg-blue-300 opacity-50 skew-x-12"></div>
                </div>

                <!-- Category Icons Grid -->
                <div class="md:col-span-2 grid grid-cols-3 gap-3">
                    <div class="bg-white p-3 rounded-xl flex items-center gap-3 shadow-sm">
                        <div class="w-10 h-10 bg-gray-100 rounded"></div>
                        <div><p class="text-xs font-bold">iPhone</p><p class="text-[10px] text-gray-400">74 items</p></div>
                    </div>
                    <div class="bg-white p-3 rounded-xl flex items-center gap-3 shadow-sm">
                        <div class="w-10 h-10 bg-gray-100 rounded"></div>
                        <div><p class="text-xs font-bold">Android</p><p class="text-[10px] text-gray-400">35 items</p></div>
                    </div>
                    <div class="bg-white p-3 rounded-xl flex items-center gap-3 shadow-sm">
                        <div class="w-10 h-10 bg-gray-100 rounded"></div>
                        <div><p class="text-xs font-bold">5G Support</p><p class="text-[10px] text-gray-400">12 items</p></div>
                    </div>
                    <!-- Row 2 -->
                    <div class="bg-white p-3 rounded-xl flex items-center gap-3 shadow-sm">
                        <div class="w-10 h-10 bg-gray-100 rounded"></div>
                        <div><p class="text-xs font-bold">Gaming</p><p class="text-[10px] text-gray-400">3 items</p></div>
                    </div>
                    <div class="bg-white p-3 rounded-xl flex items-center gap-3 shadow-sm">
                        <div class="w-10 h-10 bg-gray-100 rounded"></div>
                        <div><p class="text-xs font-bold">Xiaomi</p><p class="text-[10px] text-gray-400">52 items</p></div>
                    </div>
                    <div class="bg-white p-3 rounded-xl flex items-center gap-3 shadow-sm">
                        <div class="w-10 h-10 bg-gray-100 rounded"></div>
                        <div><p class="text-xs font-bold">Accessories</p><p class="text-[10px] text-gray-400">23 items</p></div>
                    </div>
                </div>
            </div>

            <!-- Product Slider Container -->
            <div class="relative bg-white rounded-3xl p-6 shadow-inner">
                <div class="grid grid-cols-2 md:grid-cols-5 gap-6">
                    <!-- Product Item 1 -->
                    <div class="text-center relative">
                        <span class="absolute top-0 left-0 bg-green-500 text-white text-[8px] px-2 py-1 rounded font-bold">SAVE $100.00</span>
                        <div class="w-full h-32 bg-gray-100 rounded-lg mb-3"></div>
                        <h4 class="text-[10px] font-bold line-clamp-2">SROK Smart Phone 128GB, Oled Retina</h4>
                        <p class="text-red-600 font-bold text-sm">$579.00 <span class="text-gray-400 line-through text-[8px] font-normal">$659.00</span></p>
                        <div class="mt-2 flex justify-center gap-1">
                            <span class="bg-green-100 text-green-700 text-[8px] px-1 rounded">FREE SHIPPING</span>
                        </div>
                    </div>
                    <!-- Product Item 2 (Tablet) -->
                    <div class="text-center relative">
                        <span class="absolute top-0 left-0 bg-black text-white text-[8px] px-2 py-1 rounded font-bold uppercase">New</span>
                        <div class="w-full h-32 bg-gray-100 rounded-lg mb-3"></div>
                        <h4 class="text-[10px] font-bold line-clamp-2">ePad Pro Tablet 2023 LTE + WIFI</h4>
                        <p class="text-zinc-800 font-bold text-sm">$979.00 - $1,259.00</p>
                        <p class="text-[8px] text-green-600 mt-1 italic">✔ In stock</p>
                    </div>
                    <!-- Thêm các sản phẩm khác tương tự... -->
                </div>
                <!-- Navigation -->
                <button class="absolute -left-4 top-1/2 -translate-y-1/2 bg-pink-600 p-2 rounded-full text-white shadow-lg">❮</button>
                <button class="absolute -right-4 top-1/2 -translate-y-1/2 bg-pink-600 p-2 rounded-full text-white shadow-lg">❯</button>
            </div>
        </div>

        <!-- 3. Recently Viewed Section -->
        <div class="bg-[#b4f4d4] rounded-[2.5rem] p-8 shadow-lg">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-black italic uppercase tracking-tight">Your Recently Viewed</h2>
                <a href="#" class="text-xs font-bold text-gray-600 underline">View All »</a>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <!-- Item -->
                <div class="bg-white p-4 rounded-2xl flex items-center gap-4 shadow-sm relative">
                    <span class="absolute top-2 left-2 bg-black text-white text-[7px] px-1 rounded">NEW</span>
                    <div class="w-16 h-16 bg-gray-200 rounded"></div>
                    <div>
                        <h4 class="text-[10px] font-bold">Xionia Band 9 Sport Water Resistance Watch</h4>
                        <p class="text-sm font-bold mt-1">$579.00</p>
                    </div>
                </div>
                <div class="bg-white p-4 rounded-2xl flex items-center gap-4 shadow-sm">
                    <div class="w-16 h-16 bg-gray-200 rounded"></div>
                    <div>
                        <h4 class="text-[10px] font-bold">ePad Pro Tablet 2023 12.9 inch, 512GB</h4>
                        <p class="text-sm font-bold mt-1">$979.00 - $1,259.00</p>
                    </div>
                </div>
                <div class="bg-white p-4 rounded-2xl flex items-center gap-4 shadow-sm relative">
                    <span class="absolute top-2 left-2 bg-green-500 text-white text-[7px] px-1 rounded">SAVE</span>
                    <div class="w-16 h-16 bg-gray-200 rounded"></div>
                    <div>
                        <h4 class="text-[10px] font-bold">SROK Smart Phone 128GB, Oled Retina</h4>
                        <p class="text-red-600 font-bold mt-1 text-sm">$579.00 <span class="text-gray-400 line-through text-[8px] font-normal">$779.00</span></p>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

