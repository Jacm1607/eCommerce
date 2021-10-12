<div>
    <div class="bg-white rounded-lg shadow-lg">
        <div class="px-6 py-2 flex justify-between items-center mb-6">
            <h1 class="font-semibold uppercase text-gray-800">{{ $category->name }}</h1>
            <div class="bg-gray-200 text-sm text-gray-500 leading-none border-2 border-gray-200 rounded-full inline-flex">
                <button  wire:click="$set('view','grid')" class="inline-flex items-center transition-colors duration-300 ease-in rounded-l-full px-4 py-2 {{ $view == 'grid' ? 'bg-teal-500 text-white rounded-md opacity-70' : 'text-gray-500' }}" id="grid">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="fill-current w-4 h-4 mr-2"><rect x="3" y="3" width="7" height="7"></rect><rect x="14" y="3" width="7" height="7"></rect><rect x="14" y="14" width="7" height="7"></rect><rect x="3" y="14" width="7" height="7"></rect></svg>
                  <span>Grid</span>
                </button>
                <button wire:click="$set('view','list')" class="inline-flex items-center transition-colors duration-300 ease-in rounded-r-full px-4 py-2 {{ $view == 'list' ? 'bg-teal-500 text-white rounded-md opacity-70' : 'text-gray-500' }}" id="list">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="fill-current w-4 h-4 mr-2"><line x1="8" y1="6" x2="21" y2="6"></line><line x1="8" y1="12" x2="21" y2="12"></line><line x1="8" y1="18" x2="21" y2="18"></line><line x1="3" y1="6" x2="3.01" y2="6"></line><line x1="3" y1="12" x2="3.01" y2="12"></line><line x1="3" y1="18" x2="3.01" y2="18"></line></svg>
                  <span>List</span>
                </button>
              </div>
        </div>
    </div>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-6">
        <aside>
            <div class="bg-white rounded-lg shadow-lg p-3 mb-3">
                <h2 class="font-semibold text-center mb-2">Subcategorias</h2>
                <ul class="divide-y divide-gray-200">
                    @foreach ($category->subcategories as $subcategory)
                        @if ($subcategory->subcategory_status == 1)
                            <li class="py-2 text-sm">
                                <a wire:click="$set('subcategoria', '{{ $subcategory->name }}')" class="cursor-pointer capitalize text-xs {{ $subcategoria == $subcategory->name ? 'text-white bg-teal-600 rounded-md px-2' : '' }}">{{ $subcategory->name }}</a>
                                {{-- <a wire:click="$emit('loadBrands', '{{ $category }}')" class="cursor-pointer capitalize text-xs {{ $subcategoria == $subcategory->name ? 'text-white bg-teal-600 rounded-md px-2' : '' }}">{{ $subcategory->name }}</a> --}}
                            </li>
                        @endif
                    @endforeach
                </ul>
            </div>
            {{-- @if (count($brands) > 0)
                <div class="bg-white rounded-lg shadow-lg p-3 mb-3">
                    <h2 class="font-semibold text-center mb-2">Marcas</h2>
                    <ul class="divide-y divide-gray-200">
                        @foreach ($category->brands as $brand)
                            <li class="py-2 text-sm">
                                <a wire:click="$set('marca', '{{ $brand->name }}')"
                                    class="cursor-pointer capitalize {{ $marca == $brand->name ? 'text-white bg-red-600 rounded-md px-1' : '' }}">{{ $brand->name }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif --}}
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
