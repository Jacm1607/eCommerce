<div>
    <x-jet-dropdown width="96">
        <x-slot name="trigger">
            <span class="relative inline-block cursor-pointer">
                {{-- <x-cart size="30"/> --}}
                <i class="fas fa-shopping-cart text-2xl text-blueGray-700 opacity-40"></i>
                @if (Cart::count())
                    <span class="absolute top-0 right-0 inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-red-100 transform translate-x-1/2 -translate-y-1/2 bg-red-600 rounded-full">{{ Cart::count() }}</span>
                @else
                    <span class="absolute top-0 right-0 inline-block w-2 h-2 transform translate-x-1/2 -translate-y-1/2 bg-red-600 rounded-full"></span>
                @endif
              </span>
        </x-slot>
        <x-slot name="content">
            <ul>
                @forelse (Cart::content() as $item)
                    <li class="flex p-2 border-b border-gray-200">
                        <img class="h-15 w-20 object-center object-cover mr-4" src="{{ $item->options->image }}">
                        <article class="flex-1">
                            <h1 class="font-bold text-xs">{{ Str::limit($item->name, 40, '...') }}</h1>
                            <p>Cantidad: {{ $item->qty }}</p>
                            <p>Bs. {{ $item->price }}</p>
                        </article>
                    </li>
                @empty
                    <li class="py-6 px-4">
                        <p class="text-center text-gray-700">No tiene agregado ningun producto en el carrito</p>
                    </li>
                @endforelse
            </ul>
                @if (Cart::count())
                    <div class="py-2 px-3">
                        <p><span class="font-semibold mt-2">Total:</span> Bs. {{ Cart::subtotal() }}</p>
                        <a href="#" class="inline-flex justify-center px-4 py-2 bg-lime-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-lime-600 active:bg-lime-500 focus:outline-none focus:border-lime-500 focus:ring focus:ring-lightBlue-300 disabled:opacity-25 transition">
                            Ir al carrito
                        </a>

                    </div>
                @endif
        </x-slot>
    </x-jet-dropdown>
</div>
