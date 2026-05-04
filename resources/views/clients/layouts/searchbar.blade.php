<div id="search-bar" class="relative w-full" style="max-width: 600px;margin-left:50">
    <form role="search">
        <div class="relative" style="width:700px;>
            <!-- Input -->
            <input wire:model.live.debounce.300ms="search" type="text"
                class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-full focus:outline-none focus:ring-2 focus:ring-red-500"
                autocomplete="off">

            <!-- Magnifying Glass Icon -->
            <div class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </div>
        </div>
    </form>
    <div class="absolute z-50 w-full mt-2 bg-white rounded-xl shadow-2xl border border-gray-100 overflow-hidden" style="width:700px">
        <a href="#"
            class="flex items-center gap-3 px-4 py-3 hover:bg-gray-50 transition border-b border-gray-50 last:border-0">

            <!-- Product Thumbnail -->
            <img src="" alt="" class="w-12 h-12 object-cover rounded-lg bg-gray-100">

            <div class="flex flex-col">
                <span class="text-sm font-semibold text-gray-800"></span>
                <span class="text-xs text-red-600 font-bold"></span>
            </div>
        </a>
    </div>
</div>
