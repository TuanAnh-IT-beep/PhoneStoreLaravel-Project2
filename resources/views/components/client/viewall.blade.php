<?php

use Livewire\Component;
use Livewire\Attributes\Url;
use App\Models\Subproduct;
use App\Models\Product;
use App\Models\Category;
use App\Models\Manufacturer;
use App\Models\Spec;

new class extends Component {
    #[Url]
    public string $search = '';
    public $id = null;
    public $cateid = null;

    #[Url]
    public array $selectedCategories = [];
    #[Url]
    public array $selectedManufacturers = [];
    #[Url]
    public array $selectedSpecs = [];

    public function mount($id, $cateid)
    {
        $this->id = $id;
        $this->cateid = $cateid;
        if ($cateid && !in_array($cateid, $this->selectedCategories)) {
            $this->selectedCategories[] = $cateid;
        }
    }
    public function with(): array
    {
        $query = Subproduct::query();

        if (isset($this->id)) {
            $query->whereHas('product', function ($q) {
                $q->where('id', $this->id);
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

        if (!empty($this->selectedCategories)) {
            $query->whereHas('product', function ($q) {
                $q->whereIn('category_id', $this->selectedCategories);
            });
        }

        if (!empty($this->selectedManufacturers)) {
            $query->whereHas('product', function ($q) {
                $q->whereIn('manufacturer_id', $this->selectedManufacturers);
            });
        }

        if (!empty($this->selectedSpecs)) {
            foreach ($this->selectedSpecs as $specId => $values) {
                if (is_array($values)) {
                    $values = array_filter($values);
                    if (!empty($values)) {
                        $query->whereHas('sub_specs', function ($q) use ($specId, $values) {
                            $q->where('spec_id', $specId)->whereIn('value', $values);
                        });
                    }
                }
            }
        }

        $specs = Spec::with('sub_specs')->get()->map(function($spec) {
            $spec->unique_values = $spec->sub_specs->pluck('value')->unique()->filter()->sort();
            return $spec;
        });

        return [
            'subproducts' => $query->get(),
            'products' => Product::all(),
            'categories' => Category::withCount('products')->get(),
            'manufacturers' => Manufacturer::withCount('products')->get(),
            'specs' => $specs,
        ];
    }
};
?>
<div class="w-full px-4 py-8"> <!-- Removed max-w-6xl to allow more room -->
    <div class="main-content flex flex-col md:flex-row gap-6">
        <div class="w-full md:w-64 shrink-0 bg-white p-6 rounded-2xl shadow-sm h-fit sticky top-4 self-start">
            <div class="flex justify-between items-center mb-4 pb-2 border-b">
                <h2 class="text-xl font-bold text-gray-800">Filters</h2>
                <button wire:click="$set('selectedCategories', []); $set('selectedManufacturers', []); $set('selectedSpecs', []);" class="text-xs btn red">Clear All</button>
            </div>
            <div>
                <h5 class="font-bold mb-3 text-black">Category</h3>
                <div class="space-y-2">
                    @foreach($categories as $category)
                    <label class="flex items-center gap-3 cursor-pointer group">
                        <input type="checkbox" wire:model.live="selectedCategories" value="{{ $category->id }}" class="w-4 h-4 rounded border-gray-300 text-black focus:ring-black transition-colors">
                        <span class="text-sm text-gray-600 group-hover:text-black">{{ $category->name }} <span class="text-gray-400 text-xs">({{ $category->products_count }})</span></span>
                    </label>
                    @endforeach
                </div>
            </div>
            <div class="mt-6">
                <h5 class="font-bold mb-3 text-black">Manufacturer</h3>
                <div class="space-y-2">
                    @foreach($manufacturers as $manufacturer)
                    <label class="flex items-center gap-3 cursor-pointer group">
                        <input type="checkbox" wire:model.live="selectedManufacturers" value="{{ $manufacturer->id }}" class="w-4 h-4 rounded border-gray-300 text-black focus:ring-black transition-colors">
                        <span class="text-sm text-gray-600 group-hover:text-black">{{ $manufacturer->name }} <span class="text-gray-400 text-xs">({{ $manufacturer->products_count }})</span></span>
                    </label>
                    @endforeach
                </div>
            </div>
            @foreach($specs as $spec)
                @if($spec->unique_values->count() > 0)
                <div class="mt-6">
                    <h5 class="font-bold mb-3 text-black">{{ $spec->name }}</h3>
                    <div class="space-y-2 max-h-48 overflow-y-auto pr-2">
                        @foreach($spec->unique_values as $val)
                        <label class="flex items-center gap-3 cursor-pointer group">
                            <input type="checkbox" wire:model.live="selectedSpecs.{{ $spec->id }}" value="{{ $val }}" class="w-4 h-4 rounded border-gray-300 text-black focus:ring-black transition-colors">
                            <span class="text-sm text-gray-600 group-hover:text-black">{{ $val }} {{ $spec->suffix }}</span>
                        </label>
                        @endforeach
                    </div>
                </div>
                @endif
            @endforeach
        </div>
        <div class="grow">
            <h1 class="text-3xl font-bold mb-3 text-gray-800">Products</h1>
            <div>
                <div class="mb-4">
                    <input type="text" wire:model.live="search" placeholder="Search products..."
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div class="grid grid-cols-4 gap-6 items-stretch">
                    @isset($subproducts)
                        @foreach ($subproducts as $subproduct)
                            <a href="{{ route('detail', [$subproduct->product->id, $subproduct->id]) }}"
                                class="w-full min-h-[350px] rounded-xl p-4 flex flex-col shadow-sm"
                                style="background-color: #fafafadc">

                                <img class="rounded-xl w-full h-64 object-contain shrink-0"
                                    src="{{ asset('storage/' . $subproduct->thumbnail_path) }}"
                                    alt="{{ $subproduct->product->name }}">

                                <div class="pt-4 grow">
                                    <h2 style="color:black" class="text-lg font-semibold leading-tight">
                                        {{ $subproduct->name() }}
                                    </h2>
                                    <p style="color:gray;font-size:0.900rem">{{ $subproduct->product->category->name }}</p>
                                    <p class="text-3xl font-extrabold text-red-600 mt-2">
                                        {{ number_format($subproduct->price, 0, ',', '.') }}đ
                                    </p>
                                </div>

                                <div class="mt-auto pt-4">
                                    <button
                                        class="w-full bg-black text-white text-[10px] font-bold px-4 py-2 rounded-md uppercase tracking-wider hover:bg-gray-800 transition-colors">
                                        SHOP NOW
                                    </button>
                                </div>
                            </a>
                        @endforeach
                    @endisset
                </div>
            </div>
        </div>
    </div>
</div>
