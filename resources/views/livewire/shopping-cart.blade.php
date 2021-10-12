<div class="container py-8">
    <section class="bg-white shadow-lg rounded-lg p-6 text-gray-700">
        <h1 class="text-lg font-semibold mb-6">Carrito de compras</h1>
        @if (Cart::count())
            <table class="table-auto w-full">
                <thead>
                    <tr>
                        <th></th>
                        <th>Precio</th>
                        <th>Cant</th>
                        <th colspan="2">Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach (Cart::content() as $item)
                        <tr>
                            <td>
                                <div class="flex">
                                    <img src="{{ $item->options->image }}" class="h-15 w-20 object-cover mr-4">
                                    <div class="">
                                        <p class="font-bold">{{ $item->name }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="text-center">
                                <span class="font-bold text-xs">Bs.</span> {{ number_format((float)$item->price, 2, '.', ' ') }}
                            </td>
                            <td>
                                @livewire('update-cart-item', ['rowId' => $item->rowId], key($item->rowId))
                            </td>
                            <td class="text-center">
                                <span class="font-bold text-xs">Bs.</span> {{ number_format((float)$item->price * $item->qty, 2, '.', ' ') }}
                            </td>
                            <td>
                                <a class="cursor-pointer hover:text-red-600" href="#" wire:click="delete('{{ $item->rowId }}')" wire:loading.class="text-red-600 opacity-25" wire:target="delete('{{ $item->rowId }}')"><i class="fas fa-trash"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <a href="#" wire:click="destroy" class="cursor-pointer inline-block px-2 py-1 mt-2 rounded-3xl">
                <i class="fas fa-trash"></i> Vaciar carrito de compra
            </a>

        @else
            <div class="flex flex-col items-center">
                <p>No hay productos agregados en tú carrito de compras</p>
                <p><a href="{{ url('/') }}" class="cursor-pointer bg-gray-800 text-white inline-block py-2 px-4 my-1 rounded-2xl">Ir al inicio</a></p>
            </div>
        @endif
    </section>
    @if (Cart::count())
        <div class="bg-white rounded-lg shadow-lg px-6 py-4 mt-4">
            <div class="flex justify-between">
                <div class="">
                    <p class="text-gray-700">
                        <span class="font-bold text-lg">Total: </span>
                        Bs. {{ Cart::subtotal() }}
                    </p>
                </div>
                <div class="">
                    <a href="#" class="inline-flex justify-center px-4 py-2 bg-lime-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-lime-600 active:bg-lime-500 focus:outline-none focus:border-lime-500 focus:ring focus:ring-lightBlue-300 disabled:opacity-25 transition">
                        Continuar
                    </a>
                </div>
            </div>
        </div>
    @else

    @endif
</div>
