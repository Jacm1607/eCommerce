<div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-12">


<div class="bg-white shadow-lg rounded-lg px-12 py-8 mb-3 flex justify-between items-center">
    @if ($order->status > 0)
        <div class="flex justify-center items-center flex-col">
            <div class="{{ ($order->status>=1 && $order->status!=5) ? 'bg-lime-500':'bg-gray-400' }} rounded-full h-12 w-12 flex items-center justify-center">
                <i class="fas fa-check text-white"></i>
            </div>
            <div class="">
                <span class="font-semibold text-xs uppercase tracking-widest text-gray-600">Pendiente</span>
            </div>
        </div>

        <div class="{{ ($order->status>=1 && $order->status!=5) ? 'bg-lime-500':'bg-gray-400' }} h-1 flex flex-1 mx-2"></div>

        <div class="flex justify-center items-center flex-col">
            <div class="{{ ($order->status>=2 && $order->status!=5) ? 'bg-lime-500':'bg-gray-400' }} rounded-full h-12 w-12 flex items-center justify-center">
                <i class="fas fa-check text-white"></i>
            </div>
            <div class="">
                <span class="font-semibold text-xs uppercase tracking-widest text-gray-600">Orden recibida</span>
            </div>
        </div>

        <div class="{{ ($order->status>=3 && $order->status!=5) ? 'bg-lime-500':'bg-gray-400' }} h-1 flex flex-1 mx-2"></div>

        <div class="flex justify-center items-center flex-col">
            <div class="{{ ($order->status>=3 && $order->status!=5) ? 'bg-lime-500':'bg-gray-400' }} rounded-full h-12 w-12 flex items-center justify-center">
                <i class="fas fa-truck text-white"></i>
            </div>
            <div class="">
                <span class="font-semibold text-xs uppercase tracking-widest text-gray-600">Producto enviado</span>
            </div>
        </div>

        <div class="{{ ($order->status>=4 && $order->status!=5) ? 'bg-lime-500':'bg-gray-400' }} h-1 flex flex-1 mx-2"></div>

        <div class="flex justify-center items-center flex-col">
            <div class="{{ ($order->status>=4 && $order->status!=5) ? 'bg-lime-500':'bg-gray-400' }} rounded-full h-12 w-12 flex items-center justify-center">
                <i class="fas fa-check text-white"></i>
            </div>
            <div class="">
                <span class="font-semibold text-xs uppercase tracking-widest text-gray-600">Entregado</span>
            </div>
        </div>
    @else
        <div class="flex bg-red-300 w-full mb-4">
            <div class="w-16 bg-red-500">
                <div class="p-4">
                    <svg class="h-8 w-8 text-white fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M437.019 74.981C388.667 26.629 324.38 0 256 0S123.333 26.63 74.981 74.981 0 187.62 0 256s26.629 132.667 74.981 181.019C123.332 485.371 187.62 512 256 512s132.667-26.629 181.019-74.981C485.371 388.667 512 324.38 512 256s-26.629-132.668-74.981-181.019zM256 470.636C137.65 470.636 41.364 374.35 41.364 256S137.65 41.364 256 41.364 470.636 137.65 470.636 256 374.35 470.636 256 470.636z" fill="#FFF"/><path d="M341.22 170.781c-8.077-8.077-21.172-8.077-29.249 0L170.78 311.971c-8.077 8.077-8.077 21.172 0 29.249 4.038 4.039 9.332 6.058 14.625 6.058s10.587-2.019 14.625-6.058l141.19-141.191c8.076-8.076 8.076-21.171 0-29.248z" fill="#FFF"/><path d="M341.22 311.971l-141.191-141.19c-8.076-8.077-21.172-8.077-29.248 0-8.077 8.076-8.077 21.171 0 29.248l141.19 141.191a20.616 20.616 0 0 0 14.625 6.058 20.618 20.618 0 0 0 14.625-6.058c8.075-8.077 8.075-21.172-.001-29.249z" fill="#FFF"/></svg>
                </div>
            </div>
            <div class="w-auto text-gray-800 opacity-75 items-center p-4">
                <span class="text-lg font-bold pb-4">
                    Orden Anulada.
                </span>
                <p class="leading-tight">
                    Esta orden se encuentra anulada si desea habilitar contactese con su administrador.
                </p>
            </div>
        </div>
    @endif
</div>
@if ($order->status > 0)
    <div class="bg-white rounded-lg shadow-lg px-6 py-4 mb-6">
        <p class="text-gray-700 uppercase"><span class="font-semibold">Número de orden:</span>
            Orden-{{ $order->id }}</p>

        <form wire:submit.prevent="update">
            <div class="flex space-x-3 mt-2">
                <x-jet-label>
                    <input wire:model="status" type="radio" name="status" value="2" class="mr-2">
                    RECIBIDO
                </x-jet-label>

                <x-jet-label>
                    <input wire:model="status" type="radio" name="status" value="3" class="mr-2">
                    ENVIADO
                </x-jet-label>

                <x-jet-label>
                    <input wire:model="status" type="radio" name="status" value="4" class="mr-2">
                    ENTREGADO
                </x-jet-label>

                <x-jet-label>
                    <input wire:model="status" type="radio" name="status" value="0" class="mr-2">
                    ANULADO
                </x-jet-label>
            </div>

            <div class="flex mt-2">
                <x-jet-button class="ml-auto">
                    Actualizar
                </x-jet-button>
            </div>
        </form>
    </div>
@endif

    <div class="bg-white rounded-lg shadow-lg p-6 mb-6">
        <div class="grid grid-cols-2 gap-6 text-gray-700">
            <div>
                <p class="text-lg font-semibold uppercase">Información de Envío</p>
                <p class="font-extrabold text-xs uppercase tracking-widest">Método de envío: <span class="font-semibold">{{ $order->delivery_method->name}}</span></p>
                <p class="font-extrabold text-xs uppercase tracking-widest"> <span class="font-semibold">{{ $order->address }}</span></p>
                <p class="mt-3 font-extrabold text-xs uppercase tracking-widest">Método de pago: <span class="font-semibold">{{ $order->pay_method->name }}</span></p>
            </div>

            <div>
                <p class="text-lg font-semibold uppercase">Datos de contacto</p>
                <p class="font-extrabold text-xs uppercase tracking-widest">Nombre(s) completo: <span class="font-semibold">{{ $order->name }} {{ $order->lastname }}</span></p>
                <p class="font-extrabold text-xs uppercase tracking-widest">CI: <span class="font-semibold">{{ $order->ci }}</span></p>
                <p class="font-extrabold text-xs uppercase tracking-widest">Celular: <span class="font-semibold">{{ $order->cellphone }}</span></p>
                <p class="font-extrabold text-xs uppercase tracking-widest">Razón Social: <span class="font-semibold">{{ $order->razon_social }}</span></p>
                <p class="font-extrabold text-xs uppercase tracking-widest">NIT: <span class="font-semibold">{{ $order->nit }}</span></p>
        </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow-lg p-6 text-gray-700 mb-6">
        <p class="text-xl font-semibold mb-4">Resumen</p>

        <table class="table-auto w-full">
            <thead>
                <tr>
                    <th></th>
                    <th>Precio</th>
                    <th>Cant</th>
                    <th>Total</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-gray-200">
                @foreach ($items as $item)
                    <tr>
                        <td>
                            <div class="flex">
                                <img class="h-15 w-20 object-cover mr-4" src="{{ $item->options->image }}"
                                    alt="">
                            </div>
                        </td>

                        <td class="text-center">
                            Bs. {{ number_format((float)$item->price, 2, '.', ' ') }}
                        </td>

                        <td class="text-center">
                            {{ $item->qty }}
                        </td>

                        <td class="text-center">
                            Bs. {{ number_format((float)$item->price * $item->qty, 2, '.', ' ') }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
