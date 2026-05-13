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
        if (isset($this->id)) {
            return [
                'subproducts' => Subproduct::where('name', 'like', '%' . $this->search . '%')
                    ->where('product_id', $this->id)
                    ->get(),
            ];
        }if(isset($this->cateid)){
            return [
                'subproducts' => Subproduct::where('name', 'like', '%' . $this->search . '%')
                    ->whereHas('product', function ($query) {
                        $query->where('category_id', $this->cateid);
                    })
                    ->get(),
            ];
        }
        return [
            'subproducts' => Subproduct::where('name', 'like', '%' . $this->search . '%')->get(),
        ];
    }
};
?>
<div>
<div class="mb-4">
    <input type="text" wire:model.live="search" placeholder="Search products..."
        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
</div>
<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 items-stretch">
    @isset($subproducts)
        @foreach ($subproducts as $subproduct)
            <div class="w-full min-h-[350px] rounded-xl p-4 flex flex-col shadow-sm" style="background-color: #fafafadc">

                <img class="rounded-xl w-full h-48 object-cover flex-shrink-0"
                    src="{{ asset('storage/' . $subproduct->thumbnail_path) }}" alt="{{ $subproduct->product->name }}">

                <div class="pt-4 flex-grow">
                    <h2 style="color:black" class="text-lg font-semibold leading-tight">
                        {{ $subproduct->name }}
                    </h2>
                    <p style="color:gray;font-size:0.900rem">{{ $subproduct->product->category->name }}</p>
                    <p class="text-3xl font-extrabold text-red-600 mt-2">
                        {{ number_format($subproduct->price, 0, ',', '.') }}đ
                    </p>
                </div>

                <div class="mt-auto pt-4">
                    <a href="/{{ $subproduct->product->id }}/{{ $subproduct->id }}/details">
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
