@extends('clients.layouts.master')

@section('main-content')
<div class="w-full px-4 py-8"> <!-- Removed max-w-6xl to allow more room -->
    <div class="flex flex-col md:flex-row gap-6">
        
        <!-- Left Side: Filter (Fixed Width) -->
        <div class="w-full md:w-64 flex-shrink-0"> 
            <div class="bg-white p-6 rounded-xl shadow-sm min-h-[100px]">
                <h1 class="text-2xl font-bold mb-4">Filter</h1>
                <!-- Filter content here -->
            </div>
        </div>

        <!-- Right Side: Products (Takes remaining space) -->
        <div class="flex-grow"> 
            <h1 class="text-3xl font-bold mb-6 text-gray-800">All Products</h1>
            @livewire("client.viewall",[
                'cateid'=>$cateid??null,
                'id'=>$id??null
            ])
        </div>

    </div>
</div>
@endsection