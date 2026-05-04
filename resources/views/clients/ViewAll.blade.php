@extends('clients.layouts.master')
@section('main-content')

    <body class="bg-[#48a892] p-2 md:p-8 font-sans">
        <div class="max-w-6xl mx-4 space-y-10">
            <div>
                <h1 class="text-3xl font-bold mb-6 text-white"><a href="/all">All Products</a></h1>
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 items-stretch">
                    @isset($product_byID)
                        @foreach ($product_byID->subproducts as $sub)
                            <div class="w-full min-h-[350px] rounded-xl p-4 flex flex-col shadow-sm"
                                style="background-color: #fafafadc">

                                <img class="rounded-xl w-full h-48 object-cover flex-shrink-0"
                                    src="{{ asset('storage/' . $sub->thumbnail_path) }}" alt="{{ $sub->product->name }}">

                                <div class="pt-4 flex-grow">
                                    <h2 style="color:black" class="text-lg font-semibold leading-tight">
                                        {{ $sub->name }}
                                    </h2>
                                    <p style="color:gray;font-size:0.900rem">{{ $sub->product->category->name }}</p>
                                    <p class="text-gray-600 mt-2 font-medium">
                                        {{ number_format($sub->price, 0) }}
                                    </p>
                                </div>

                                <div class="mt-auto pt-4">
                                    <a href="/{{$sub->product->id}}/{{ $sub->id }}/details">
                                        <button
                                            class="w-full bg-black text-white text-[10px] font-bold px-4 py-2 rounded-md uppercase tracking-wider hover:bg-gray-800 transition-colors">
                                            SHOP NOW
                                        </button>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    @endisset
                    @isset($products)
                        @foreach($products as $pro)
                            @foreach ($pro->subproducts as $sub)
                                <div class="w-full min-h-[350px] rounded-xl p-4 flex flex-col shadow-sm"
                                    style="background-color: #fafafadc">

                                    <img class="rounded-xl w-full h-48 object-cover flex-shrink-0"
                                        src="{{ asset('storage/' . $sub->thumbnail_path) }}" alt="{{ $sub->product->name }}">

                                    <div class="pt-4 flex-grow">
                                        <h2 style="color:black" class="text-lg font-semibold leading-tight">
                                            {{ $sub->name }}
                                        </h2>
                                        <p style="color:gray;font-size:0.900rem">{{ $sub->product->category->name }}</p>
                                        <p class="text-gray-600 mt-2 font-medium">
                                            {{ number_format($sub->price, 0) }}
                                        </p>
                                    </div>

                                    <div class="mt-auto pt-4">
                                        <a href="/{{$sub->product->id}}/{{ $sub->id }}/details">
                                            <button
                                                class="w-full bg-black text-white text-[10px] font-bold px-4 py-2 rounded-md uppercase tracking-wider hover:bg-gray-800 transition-colors">
                                                SHOP NOW
                                            </button>
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        @endforeach
                    @endisset
                    @isset($subproducts)
                        @foreach ($subproducts as $subproduct)
                            <div class="w-full min-h-[350px] rounded-xl p-4 flex flex-col shadow-sm"
                                style="background-color: #fafafadc">

                                <img class="rounded-xl w-full h-48 object-cover flex-shrink-0"
                                    src="{{ asset('storage/' . $subproduct->thumbnail_path) }}"
                                    alt="{{ $subproduct->product->name }}">

                                <div class="pt-4 flex-grow">
                                    <h2 style="color:black" class="text-lg font-semibold leading-tight">
                                        {{ $subproduct->name }}
                                    </h2>
                                    <p style="color:gray;font-size:0.900rem">{{ $subproduct->product->category->name }}</p>
                                    <p class="text-gray-600 mt-2 font-medium">
                                        {{ number_format($subproduct->price, 0) }}
                                    </p>
                                </div>

                                <div class="mt-auto pt-4">
                                    <a href="/{{$subproduct->product->id}}/{{ $subproduct->id }}/details">
                                        <button
                                            class="w-full bg-black text-white text-[10px] font-bold px-4 py-2 rounded-md uppercase tracking-wider hover:bg-gray-800 transition-colors">
                                            SHOP NOW
                                        </button>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    @endisset
                </div>
            </div>
        </div>
    </body>
@endsection