@include('admins.layouts.head')
@include('clients.layouts.header')
<div id="default-carousel" class="relative w-250" style="margin-left: 22%;margin-bottom: 25px;" data-carousel="slide">
    <div class="relative h-56 overflow-hidden rounded-base md:h-96" style="border-radius:30px;">
        <div class=" hidden duration-700 ease-in-out" style="border-radius:30px;" data-carousel-item>
            <img src="https://img.freepik.com/free-psd/smartphone-camera-control-social-media-banner-design-template_47987-25416.jpg?semt=ais_hybrid&w=740&q=80"
                class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2"
                style="border-radius:30px;" alt="...">
        </div>
        <div class=" hidden duration-700 ease-in-out" style="border-radius:30px;" data-carousel-item>
            <img src="https://scontent.fhan18-1.fna.fbcdn.net/v/t39.30808-6/674781288_1078863334494652_81833877916710996_n.jpg?_nc_cat=108&ccb=1-7&_nc_sid=2a1932&_nc_ohc=f3V-jRNXwYMQ7kNvwFIDNgM&_nc_oc=AdpUtWgMNjXk3Q7rkS-QqPyc8THlsm5DTq9ZvlXuprx4H0rmt9pHQNQhAo9l0tmrL80&_nc_zt=23&_nc_ht=scontent.fhan18-1.fna&_nc_gid=__KbTrFmKtEo15QVqOhbHA&_nc_ss=7b289&oh=00_Af7sc1330JOQST6iqT8Ii3V796ZVC035U9cdPBmei6I39Q&oe=69FF5687"
                class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2"
                style="border-radius:30px;" alt="...">
        </div>
    </div>
    <div class="absolute z-30 flex -translate-x-1/2 bottom-5 left-1/2 space-x-3 rtl:space-x-reverse">
        <button type="button" class="w-3 h-3 rounded-base" aria-current="true" aria-label="Slide 1"
            data-carousel-slide-to="0"></button>
        <button type="button" class="w-3 h-3 rounded-base" aria-current="false" aria-label="Slide 2"
            data-carousel-slide-to="1"></button>
    </div>
    <button type="button"
        class="absolute top-0 start-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none "
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
<div class="flex flex-col min-h-screen">
    <div class="container mx-auto flex flex-1" style="gap: 20px">
        <div class="main-content flex-1 p-6">

            <body class="bg-[#48a892] p-4 md:p-8 font-sans">
                <div class="max-w-6xl mx-auto space-y-10">
                    <!-- Carousel Section -->
                    <!-- 2. Product by category -->
                    <div class="bg-[#b4f4d4] rounded-[2.5rem] p-8 shadow-lg">
                        <div class="flex justify-between items-center mb-6">
                            <h2 class="text-2xl font-black uppercase tracking-tight">FEATURED</h2>
                            <a href="{{ route('all') }}" class="text-xs font-bold text-gray-600 underline">View All
                                »</a>
                        </div>

                        <!-- Top Grid (Banner & Categories) -->
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
                            <!-- Promo Banner -->
                            @foreach ($products->where('featured', 1) as $pro)
                                <div
                                    class="md:col-span-1 bg-gradient-to-r from-gray-200 to-blue-200 rounded-2xl p-6 flex relative overflow-hidden h-40 items-center">

                                    <div>
                                        <h3 class="text-lg font-bold leading-tight">{{ $pro->name }}</h3>
                                        <a href="{{ route('viewbyid', $pro->id) }}">
                                            <button
                                                class="mt-4 bg-black text-white text-[10px] px-4 py-2 rounded-md">SHOP
                                                NOW</button></a>
                                    </div>
                                    <img style="margin-left: 60px;" src="{{ asset('storage/' . $pro->thumbnail_path) }}"
                                        alt="{{ $pro->name }}"
                                        class=" relative z-10 w-30 h-30 object-cover rounded-md mt-2">
                                    <div
                                        class="absolute right-0 bottom-0 w-1/2 h-full bg-blue-300 opacity-50 skew-x-12">
                                    </div>

                                </div>
                            @endforeach
                            <div class="md:col-span-2 grid grid-cols-3 gap-3">
                                @foreach ($categories->where('featured', 1) as $cate)
                                    <a href="{{ route('viewbycategory', $cate->id) }}">
                                        <div class="bg-white p-3 rounded-xl flex items-center gap-3 shadow-sm">
                                            <div class="w-10 h-10 bg-gray-100 rounded">
                                                <img src="{{ asset('storage/' . $cate->icon) }}"
                                                    alt="{{ $cate->name }}"
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

                        <!-- Product Slider Container -->
                        <div class="relative bg-white rounded-3xl p-6 shadow-inner">
                            <div class="flex justify-between items-center mb-4">
                                <h3 class="text-2xl font-black uppercase tracking-tight">NEWEST</h3>
                            </div>
                            <div class="flex overflow-x-auto gap-4 py-2">
                                @foreach ($products->where('featured', 1) as $pro)
                                    @if ($subproducts->where('product_id', $pro->id)->first())
                                        <a
                                            href="{{ route('detail', [$pro->id, $subproducts->where('product_id', $pro->id)->first()->id]) }}">
                                            <div class="min-w-[150px] bg-gray-100 rounded-xl p-4 flex-shrink-0">
                                                <img src="{{ asset('storage/' . $pro->thumbnail_path) }}"
                                                    alt="{{ $pro->name }}"
                                                    class="w-full h-24 object-cover rounded-md mb-2">
                                                <h4 style="color:black" class="text-sm font-bold">{{ $pro->name }}
                                                </h4>
                                                <p class="text-3xl font-extrabold text-red-600" mt-1">
                                                    {{ number_format($subproducts->where('product_id', $pro->id)->first()->price, 0, ',', '.') }}đ
                                                </p>
                                            </div>
                                        </a>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
            </body>
        </div>
    </div>
</div>
@include('clients.layouts.footer')
