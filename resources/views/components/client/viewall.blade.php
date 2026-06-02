<?php

use Livewire\Component;
use App\Models\Subproduct;

new class extends Component {
    public string $search = '';
    public $id = null;
    public $cateid = null;
    public function mount($id, $cateid)
    {
        $this->id = $id;
        $this->cateid = $cateid;
    }
    public function with(): array
    {
        $query = Subproduct::query();

        if (isset($this->id)) {
            $query->whereHas('product', function ($q) {
                $q->where('id', $this->id);
            });
        } elseif (isset($this->cateid)) {
            $query->whereHas('product', function ($q) {
                $q->where('category_id', $this->cateid);
            });
        }
        if (!empty($this->search)) {
            $query->where(function ($mainQuery) {
                $mainQuery
                    ->whereHas('product', function ($q) {
                        $q->where('name', 'like', '%' . $this->search . '%');
                    })
                    ->orWhereHas('sub_specs', function ($q) {
                        $q->where('value', 'like', '%' . $this->search . '%');
                    })
                    ->orWhere('price', 'like', '%' . $this->search . '%');
            });
        }

        return [
            'subproducts' => $query->get(),
            'products'=> \App\Models\Product::all(),
        ];
    }
};
?>
<div class="w-full px-4 py-8"> <!-- Removed max-w-6xl to allow more room -->
    <div class="flex flex-col md:flex-row gap-6">

        <!-- Left Side: Filter (Fixed Width) -->
        <div class="w-full md:w-64 shrink-0">
            <div class="bg-white p-6 rounded-xl shadow-sm min-h-[100px]">
                <h1 class="text-2xl font-bold mb-4">Filter</h1>
                <select>
                    @foreach ( $products as $pro)
                    <option value="{{ $pro->id }}">{{$pro->name}}</option>
                     @endforeach
                </select>
            </div>
        </div>
        <div class="grow">
            <h1 class="text-3xl font-bold mb-6 text-gray-800">All Products</h1>
            <div>
                <div class="mb-4">
                    <input type="text" wire:model.live="search" placeholder="Search products..."
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <a href="{{ route('all') }}" class="text-xs font-bold text-gray-600 underline">View All
                    »</a>
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-6 items-stretch">
                    @isset($subproducts)
                        @foreach ($subproducts as $subproduct)
                            <div class="w-full min-h-[350px] rounded-xl p-4 flex flex-col shadow-sm"
                                style="background-color: #fafafadc">

                                <img class="rounded-xl w-full h-64 object-cover shrink-0"
                                    src="{{ asset('storage/' . $subproduct->thumbnail_path) }}"
                                    alt="{{ $subproduct->product->name }}">

                                <div class="pt-4 flex-grow">
                                    <h2 style="color:black" class="text-lg font-semibold leading-tight">
                                        {{ $subproduct->product->name }}
                                        {{ $subproduct->sub_specs->where('spec_id', 1)->first()?->value }}
                                        {{ $subproduct->sub_specs->where('spec_id', 12)->first()?->value }}
                                    </h2>
                                    <p style="color:gray;font-size:0.900rem">{{ $subproduct->product->category->name }}</p>
                                    <p class="text-3xl font-extrabold text-red-600 mt-2">
                                        {{ number_format($subproduct->price, 0, ',', '.') }}đ
                                    </p>
                                </div>

                                <div class="mt-auto pt-4">
                                    <a href="{{ route('detail', [$subproduct->product->id, $subproduct->id]) }}">
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
    </div>
</div>
