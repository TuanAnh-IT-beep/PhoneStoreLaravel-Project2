<?php

use Livewire\Component;

new class extends Component {
    public $product;
    public $subproduct;
    public $allSpecs;

    public $price;
    public $stock;
    public $thumbnail_path;
    public $specs = [];

    public function mount($product, $subproduct, $allSpecs)
    {
        $this->product = $product;
        $this->subproduct = $subproduct;
        $this->allSpecs = $allSpecs;

        $this->price = old('price', $subproduct->price);
        $this->stock = old('stock', $subproduct->stock);

        if (old('thumbnail_path')) {
            $this->thumbnail_path = old('thumbnail_path');
        } elseif ($subproduct->thumbnail_path) {
            $this->thumbnail_path = $subproduct->thumbnail_path;
        } else {
            $this->thumbnail_path = $product->images->first()?->path ?? '';
        }

        $oldSpecs = old('specs', $subproduct->sub_specs->map(fn($s) => ['spec_id' => $s->spec_id, 'value' => $s->value])->toArray());
        $this->specs = $oldSpecs;
    }

    public function addSpec()
    {
        $this->specs[] = ['spec_id' => '', 'value' => ''];
    }

    public function removeSpec($index)
    {
        unset($this->specs[$index]);
        $this->specs = array_values($this->specs);
    }

    public function getSelectedSpecIdsProperty()
    {
        return collect($this->specs)->pluck('spec_id')->filter()->toArray();
    }
};
?>

<div>
    <form method="post" action="{{ route('subproducts.update', [$product, $subproduct]) }}">
        @csrf
        @method('PUT')
        <div class="main-container">
            <input type="hidden" name="product_id" value="{{ $product->id }}">
            <div class="grid grid-cols-10 gap-4">
                <div class="col-span-4">
                    <div class="flex gap-5">
                        <div class="w-full">
                            <label for="price">Price:</label><br>
                            <input required class="my-3 w-full" type="number" name="price"
                                placeholder="Input price here..." wire:model="price"><br>
                        </div>
                        <div class="w-full">
                            <label for="stock">Stock:</label><br>
                            <input required class="my-3 w-full" type="number" name="stock"
                                placeholder="Input stock here..." wire:model="stock"><br>
                        </div>
                    </div>
                </div>
                <div class="col-span-6">
                    <label>Thumbnail:</label><br>
                    <div class="flex flex-wrap gap-4 mt-3 mb-4">
                        @foreach ($product->images as $image)
                            <div class="text-center relative inline-block">
                                <img src="{{ asset('storage/' . $image->path) }}"
                                    class="w-24 h-24 object-cover border-2 rounded {{ $thumbnail_path == $image->path ? 'border-blue-500' : 'border-gray-300' }}">
                                <br>
                                <input type="radio" name="thumbnail_path" value="{{ $image->path }}"
                                    wire:model.live="thumbnail_path">
                                <label class="text-sm">Thumbnail</label>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="main-container mt-3">
            <div class="w-full mb-4 flex items-center justify-between">
                <h1>Specs</h1>
                <button type="button" class="btn" wire:click="addSpec"><i class="fa-solid fa-plus"></i>ADD NEW ITEM</button>
            </div>
            <div class="grid grid-cols-2 gap-4">
                @foreach ($specs as $index => $sub_spec)
                    <div class="col-span-1 flex gap-2 mb-2 items-center">
                        <select name="specs[{{ $index }}][spec_id]" wire:model.live="specs.{{ $index }}.spec_id" class="w-full" required>
                            <option value="" disabled>Select a Spec</option>
                            @foreach ($allSpecs as $spec)
                                <option value="{{ $spec->id }}"
                                    {{ in_array($spec->id, $this->selectedSpecIds) && $specs[$index]['spec_id'] != $spec->id ? 'disabled' : '' }}>
                                    {{ $spec->name }}
                                </option>
                            @endforeach
                        </select>
                        <input type="text" name="specs[{{ $index }}][value]" class="w-full" placeholder="Value"
                            wire:model="specs.{{ $index }}.value" required>
                        <button type="button" class="btn delete icon-only"
                            wire:click="removeSpec({{ $index }})"><i
                                class="fa-solid fa-trash"></i></button>
                    </div>
                @endforeach
            </div>
            <div class="flex gap-2 mt-4">
                <div class="flex gap-2">
                    <button class="btn flex-1 icon-only">UPDATE</button>
                    <a class="btn flex-1 icon-only negative" href="{{ route('subproducts.index', $product) }}">CANCEL</a>
                </div>
            </div>
        </div>
    </form>
</div>
