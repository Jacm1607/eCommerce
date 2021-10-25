<x-app-layout>
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="bg-white rounded-lg shadow-lg px-6 py-4 mb-3 grid grid-cols-2">
            <div class="md:col-span-1 col-span-2 flex items-center">
                <p class="ml-2 text-2xl">Orden de compra #{{ $order->id }}</p>
            </div>
            <div class="md:col-span-1 col-span-2">
                <div class="text-gray-700">
                    <p class="text-lg font-semibold uppercase text-right">Hauscenter</p>
                    <p class="text-sm font-semibold text-right">eCommerce</p>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-2 gap-3">
        <div class="md:col-span-1 col-span-2">
                <div class="bg-white text-gray-600 rounded-lg shadow-lg px-6 py-4 mb-3">
                    <span class="font-bold text-xs uppercase tracking-widest text-gray-800">Datos del cliente</span>
                    <hr class="mt-1 mb-3">
                    <p class="font-extrabold text-xs uppercase tracking-widest">Nombre(s) completo: <span class="font-semibold">{{ $order->name }} {{ $order->lastname }}</span></p>
                    <p class="font-extrabold text-xs uppercase tracking-widest">CI: <span class="font-semibold">{{ $order->ci }}</span></p>
                    <p class="font-extrabold text-xs uppercase tracking-widest">Celular: <span class="font-semibold">{{ $order->cellphone }}</span></p>
                    <p class="font-extrabold text-xs uppercase tracking-widest">Razón Social: <span class="font-semibold">{{ $order->razon_social }}</span></p>
                    <p class="font-extrabold text-xs uppercase tracking-widest">NIT: <span class="font-semibold">{{ $order->nit }}</span></p>
                </div>
            </div>
            <div class="md:col-span-1 col-span-2">
                <div class="bg-white text-gray-600 rounded-lg shadow-lg px-6 py-4 mb-3">
                    <span class="font-bold text-xs uppercase tracking-widest text-gray-800">Datos de envio</span>
                    <hr class="mt-1 mb-3">
                    <p class="font-extrabold text-xs uppercase tracking-widest">Método de envío: <span class="font-semibold">{{ $order->delivery_method->name}}</span></p>
                    <p class="font-extrabold text-xs uppercase tracking-widest"> <span class="font-semibold">{{ $order->address }}</span></p>
                    <p class="mt-3 font-extrabold text-xs uppercase tracking-widest">Método de pago: <span class="font-semibold">{{ $order->pay_method->name }}</span></p>
                </div>
            </div>
        </div>

        <div class="bg-white shadow-lg rounded-lg px-12 py-8 mb-3 flex justify-between items-center">
            <div class="flex justify-center items-center flex-col">
                <div class="{{ ($order->status>=1 && $order->status!=0) ? 'bg-lime-500':'bg-gray-400' }} rounded-full h-12 w-12 flex items-center justify-center">
                    <span class="material-icons-outlined text-white">watch_later</span>
                </div>
                <div class="">
                    <span class="font-semibold text-xs uppercase tracking-widest text-gray-600">Pendiente</span>
                </div>
            </div>

            <div class="{{ ($order->status>=1 && $order->status!=0) ? 'bg-lime-500':'bg-gray-400' }} h-1 flex flex-1 mx-2"></div>

            <div class="flex justify-center items-center flex-col">
                <div class="{{ ($order->status>=2 && $order->status!=0) ? 'bg-lime-500':'bg-gray-400' }} rounded-full h-12 w-12 flex items-center justify-center">
                    <span class="material-icons-outlined text-white">inventory_2</span>
                </div>
                <div class="">
                    <span class="font-semibold text-xs uppercase tracking-widest text-gray-600">Orden recibida</span>
                </div>
            </div>

            <div class="{{ ($order->status>=3 && $order->status!=0) ? 'bg-lime-500':'bg-gray-400' }} h-1 flex flex-1 mx-2"></div>

            <div class="flex justify-center items-center flex-col">
                <div class="{{ ($order->status>=3 && $order->status!=0) ? 'bg-lime-500':'bg-gray-400' }} rounded-full h-12 w-12 flex items-center justify-center">
                    <span class="material-icons-outlined text-white">local_shipping</span>
                </div>
                <div class="">
                    <span class="font-semibold text-xs uppercase tracking-widest text-gray-600">Producto enviado</span>
                </div>
            </div>

            <div class="{{ ($order->status>=4 && $order->status!=0) ? 'bg-lime-500':'bg-gray-400' }} h-1 flex flex-1 mx-2"></div>

            <div class="flex justify-center items-center flex-col">
                <div class="{{ ($order->status>=4 && $order->status!=0) ? 'bg-lime-500':'bg-gray-400' }} rounded-full h-12 w-12 flex items-center justify-center">
                    <span class="material-icons-outlined text-white">done</span>
                </div>
                <div class="">
                    <span class="font-semibold text-xs uppercase tracking-widest text-gray-600">Entregado</span>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-lg px-6 py-4 mb-3">
            <p class="text-lg font-semibold mb-4">Resumen</p>

            <table class="table-auto w-full">
                <thead>
                    <tr>
                        <th></th>
                        <th>Precio</th>
                        <th>Cantidad</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach ($items as $item)
                        <tr>
                            <td>
                                <div class="flex">
                                    <img src="{{ $item->options->image }}" class="h-15 w-20 object-cover mr-4">
                                    <article>
                                        <h1 class="font-bold">{{ $item->name }}</h1>
                                    </article>
                                </div>
                            </td>
                            <td class="text-center"> Bs. {{ number_format((float)$item->price, 2, '.', ' ') }}</td>
                            <td class="text-center">{{ $item->qty }}</td>
                            <td class="text-center">Bs. {{ number_format((float)$item->qty * $item->price, 2, '.', ' ') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="bg-white rounded-lg shadow-lg px-6 py-4 mb-3 grid grid-cols-2">
            <div class="md:col-span-1 col-span-2 flex items-center">
                {!! QrCode::size(60)->generate($order->id) !!}
            </div>
            <div class="md:col-span-1 col-span-2">
                <div class="text-gray-700">
                    <p class="text-sm font-semibold text-right">Subtotal: Bs. {{ number_format((float)$order->total - $order->shipping_cost, 2, '.', ' ') }}</p>
                    <p class="text-sm font-semibold text-right">Envío: Bs. {{ number_format((float)$order->shipping_cost, 2, '.', ' ') }}</p>
                    <p class="text-lg font-semibold text-right">TOTAL: Bs. {{ number_format((float)$order->total, 2, '.', ' ') }}</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
