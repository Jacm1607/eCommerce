<div class="flex-1 relative" x-data>
    <form action="{{ route('search') }}" autocomplete="off" method="get">
        <x-jet-input name="name" wire:model="search" type="text" class="w-full" placeholder="¿Estás buscando algún producto?" />
        <button class="absolute top-0 right-0 w-12 h-full bg-blue-900 opacity-90 flex items-center justify-center rounded-r-md">
            <i class="fas fa-search text-white text-2xl"></i>
            {{-- <x-search size="35" /> --}}
        </button>
    </form>

    <div class="absolute w-full mt-1 hidden z-50" :class="{'hidden': !$wire.open}" @click.away="$wire.open = false">
        <div class="bg-white rounded-lg shadow mt-1">
            <div class="px-4 py-3 space-y-1">
                @forelse ($products as $product)
                    <a href="{{ route('product.show', $product) }}" class="flex items-center hover:bg-gray-100">
                        @if(count($product->images) > 0)
                            <img class="h-16 w-12 object-cover object-center rounded-t-lg" src="{{ Storage::url($product->images->first()->url) }}" alt="">
                        @else
                            <img class="h-12 w-12 object-cover object-center" src="{{ asset('img/no_imagen.png') }}" alt="">
                        @endif
                        <div class="ml-4 text-gray-700">
                            <p class="text-xs font-bold">{{ $product->name }}</p>
                            <p><span class="font-semibold tracking-wide">Categoría:</span> {{ $product->subcategory->category->name }}</p>
                        </div>
                    </a>
                @empty
                    <p class="font-semibold leading-5">No hay producto con este nombre...</p>
                @endforelse
            </div>
        </div>
    </div>
</div>
