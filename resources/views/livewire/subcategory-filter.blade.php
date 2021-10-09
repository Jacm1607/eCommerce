<div>
    <div class="bg-white rounded-lg shadow-lg">
        <div class="px-6 py-2 flex justify-between items-center mb-6">
            <h1 class="font-semibold uppercase text-gray-800">{{ $subcategory->name }}</h1>
            <div class="grid grid-cols-2 border border-gray-200 divide-x divide-gray-200 rounded-md">
                <i class="fas fa-border-all p-3 cursor-pointer font-light {{ $view == 'grid' ? 'bg-teal-500 text-white rounded-md opacity-70' : 'text-gray-500' }}"
                    wire:click="$set('view','grid')"></i>
                <i class="fas fa-th-list p-3  cursor-pointer {{ $view == 'list' ? 'bg-teal-500 text-white rounded-md opacity-70' : 'text-gray-500' }}"
                    wire:click="$set('view','list')"></i>
            </div>
        </div>
    </div>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-6">
        <aside>
            <div class="bg-white rounded-lg shadow-lg p-3 mb-3">
                <ul class="divide-y divide-gray-200">
                    <li class="py-2 text-xs">
                        <a wire:click="$set('orderBy', 'ASC')" class="cursor-pointer capitalize {{ $orderBy == "ASC" ? 'text-white bg-cyan-700 rounded-md px-1.5 py-0.5' : ''}}">Ordenar de A-Z</a>
                    </li>
                    <li class="py-2 text-xs">
                        <a wire:click="$set('orderBy', 'DESC')" class="cursor-pointer capitalize {{ $orderBy == "DESC" ? 'text-white bg-cyan-700 rounded-md px-1.5 py-0.5' : ''}}">Ordenar de Z-A</a>
                    </li>
                </ul>
            </div>
            <x-jet-button wire:click="clear_filter">
                Eliminar filtros
            </x-jet-button>
        </aside>
        <div class="md:col-span-2 lg:col-span-4">
            @if ($view == 'grid')
                <ul class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-4 gap-4">
                    @forelse ($products as $product)
                        <x-product-card :product="$product"/>
                    @empty
                        No se ha encontrado productos
                    @endforelse
                </ul>
            @else
                <ul>
                    @forelse ($products as $product)
                        <x-product-list :product="$product"/>
                    @empty
                        No se ha encontrado productos
                    @endforelse
                </ul>
            @endif
            <div class="mt-4">
                {{ $products->links() }}
            </div>
        </div>
    </div>
</div>
