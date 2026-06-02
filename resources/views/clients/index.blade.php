@extends('clients.layouts.master')
@section('title', 'Home')
@section('main-content')
    <div id="default-carousel" class="relative w-full max-w-300 mx-auto mb-8 shadow-lg rounded-[2.5rem]" data-carousel="slide">
        <div class="relative overflow-hidden rounded-[2.5rem] aspect-video md:aspect-3/1">
            <div class="hidden duration-700 ease-in-out" data-carousel-item>
                <img src="https://mediamart.vn/images/uploads/2024/751b193a-a2ac-434e-8090-2a05c878fd4a.png"
                    class="absolute block w-full object-cover -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2"
                    alt="Slide 1">
            </div>
            <div class="hidden duration-700 ease-in-out" data-carousel-item>
                <img src="https://www.hlb.com.my/content/dam/hlb/my/images/Promotions/2024/cc-hlb-samsung-galaxy-z-pre-sale/cc-samsung-promo-banner.jpg"
                    class="absolute block w-full object-cover -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2"
                    alt="Slide 2">
            </div>
        </div>
        <div class="absolute z-30 flex -translate-x-1/2 bottom-5 left-1/2 space-x-3 rtl:space-x-reverse">
            <button type="button" class="w-3 h-3 rounded-full" aria-current="true" aria-label="Slide 1"
                data-carousel-slide-to="0"></button>
            <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 2"
                data-carousel-slide-to="1"></button>
        </div>
        <button type="button"
            class="absolute top-0 start-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none"
            data-carousel-prev>
            <span
                class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none"
                style="background-color:#F20553">
                <svg class="w-5 h-5 text-white rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m15 19-7-7 7-7" />
                </svg>
                <span class="sr-only">Previous</span>
            </span>
        </button>
        <button type="button"
            class="absolute top-0 end-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none"
            data-carousel-next>
            <span
                class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none"
                style="background-color:#F20553">
                <svg class="w-5 h-5 text-white rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m9 5 7 7-7 7" />
                </svg>
                <span class="sr-only">Next</span>
            </span>
        </button>
    </div>
    <div class="bg-[#b4f4d4] rounded-[2.5rem] p-8 shadow-lg">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-black">Featured</h2>
            <a href="{{ route('all') }}" class="text-xs font-bold text-gray-600 underline">View All »</a>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
            @foreach ($products->where('featured', 1) as $pro)
                <div
                    class="md:col-span-1 bg-linear-to-r from-gray-200 to-blue-200 rounded-2xl p-6 flex relative overflow-hidden h-40 items-center">
                    <div>
                        <h3 class="text-lg font-bold leading-tight">{{ $pro->name }}</h3>
                        <a href="{{ route('viewbyid', $pro->id) }}">
                            <button class="mt-4 bg-black text-white text-[10px] px-4 py-2 rounded-md">SHOP
                                NOW</button></a>
                    </div>
                    <img style="margin-left: 60px;" src="{{ asset('storage/' . $pro->thumbnail_path) }}"
                        alt="{{ $pro->name }}" class=" relative z-10 w-30 h-30 object-cover rounded-md mt-2">
                    <div class="absolute right-0 bottom-0 w-1/2 h-full bg-blue-300 opacity-50 skew-x-12">
                    </div>
                </div>
            @endforeach
            <div class="md:col-span-2 grid grid-cols-3 gap-3">
                @foreach ($categories->where('featured', 1) as $cate)
                    <a href="{{ route('viewbycategory', $cate->id) }}">
                        <div class="bg-white p-3 rounded-xl flex items-center gap-3 shadow-sm">
                            <div class="w-10 h-10 bg-gray-100 rounded">
                                <img src="{{ asset('storage/' . $cate->icon) }}" alt="{{ $cate->name }}"
                                    class="w-full h-full object-cover rounded">
                            </div>
                            <div>
                                <p class="text-xs font-bold">{{ $cate->name }}</p>
                                <p class="text-[10px] text-gray-400">{{ $cate->products->count() }}
                                    items</p>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>

        <div class="bg-white rounded-3xl p-6 shadow-inner">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-2xl font-black uppercase tracking-tight">NEWEST</h3>
            </div>
            <div class="flex overflow-x-auto gap-4 items-stretch pb-4">
                @foreach ($products->where('featured', 1)->take(10) as $pro)
                    @if ($pro->subproducts->first())
                        <a href="{{ route('detail', [$pro->id, $subproducts->where('product_id', $pro->id)->first()->id]) }}"
                            class="min-w-[200px] w-[200px] shrink-0 min-h-[280px] rounded-xl p-3 flex flex-col shadow-sm"
                            style="background-color: #fafafadc">

                            <img class="rounded-xl w-full h-40 object-cover shrink-0"
                                src="{{ asset('storage/' . $pro->thumbnail_path) }}" alt="{{ $pro->name }}">
                            <div class="pt-3 flex-grow">
                                <h2 style="color:black" class="text-sm font-semibold leading-tight">
                                    {{ $pro->name }}
                                </h2>
                                <p style="color:gray;font-size:0.75rem">{{ $pro->category->name }}</p>
                                <p class="text-lg font-extrabold text-red-600 mt-1">
                                    {{ number_format($pro->subproducts->first()->price, 0, ',', '.') }}đ
                                </p>
                            </div>
                            <div class="mt-auto pt-3">
                                <button
                                    class="w-full bg-black text-white text-[10px] font-bold px-3 py-2 rounded-md uppercase tracking-wider hover:bg-gray-800 transition-colors">
                                    SHOP NOW
                                </button>
                            </div>
                        </a>
                    @endif
                @endforeach
            </div>
        </div>
        @foreach($categories as $category)
            @if($category->products->count() > 0)
                <div class="bg-white rounded-3xl p-6 shadow-inner mt-8">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-2xl font-black tracking-tight">{{ $category->name }}</h3>
                        <a href="{{ route('viewbycategory', $category->id) }}" class="text-xs font-bold text-gray-600 underline">View All »</a>
                    </div>
                    <div class="flex overflow-x-auto gap-4 items-stretch pb-4">
                        @foreach ($category->products->take(10) as $pro)
                            @if ($pro->subproducts->first())
                                <a href="{{ route('detail', [$pro->id, $pro->subproducts->first()->id]) }}"
                                    class="min-w-[200px] w-[200px] shrink-0 min-h-[280px] rounded-xl p-3 flex flex-col shadow-sm"
                                    style="background-color: #fafafadc">

                                    <img class="rounded-xl w-full h-40 object-cover shrink-0"
                                        src="{{ asset('storage/' . $pro->thumbnail_path) }}" alt="{{ $pro->name }}">
                                    <div class="pt-3 flex-grow">
                                        <h2 style="color:black" class="text-sm font-semibold leading-tight">
                                            {{ $pro->name }}
                                        </h2>
                                        <p style="color:gray;font-size:0.75rem">{{ $pro->category->name }}</p>
                                        <p class="text-lg font-extrabold text-red-600 mt-1">
                                            {{ number_format($pro->subproducts->first()->price, 0, ',', '.') }}đ
                                        </p>
                                    </div>
                                    <div class="mt-auto pt-3">
                                        <button
                                            class="w-full bg-black text-white text-[10px] font-bold px-3 py-2 rounded-md uppercase tracking-wider hover:bg-gray-800 transition-colors">
                                            SHOP NOW
                                        </button>
                                    </div>
                                </a>
                            @endif
                        @endforeach
                    </div>
                </div>
            @endif
        @endforeach
    </div>
@endsection
