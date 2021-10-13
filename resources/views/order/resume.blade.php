<x-app-layout>
    <div class="container py-8">
        <div class="bg-white rounded-lg shadow-lg px-6 py-4 mb-3">
            <p class="text-gray-700 uppercase"><span class="font-semibold">Número de orden:</span> {{ $order->id }}</p>
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
                            <td class="text-center"> Bs. {{ $item->price }}</td>
                            <td class="text-center">{{ $item->qty }}</td>
                            <td class="text-center">Bs. {{ $item->qty * $item->price }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @if ($order->pay_method_id == 1)
            <div class="bg-white rounded-lg shadow-lg px-6 py-4 mb-3 grid grid-cols-2">
                <div class="md:col-span-1 col-span-2 flex items-center">
                    <img src="{{ asset('img/pay.png') }}" class="h-14">
                </div>
                <div class="md:col-span-1 col-span-2">
                    <div class="text-gray-700">
                        <p class="text-sm font-semibold text-right">Subtotal: Bs. {{ $order->total - $order->shipping_cost }}</p>
                        <p class="text-sm font-semibold text-right">Envío: Bs. {{ $order->shipping_cost }}</p>
                        <p class="text-lg font-semibold uppercase text-right">Total: Bs. {{ $order->total }}</p>

                        <form target="shopping_hauscenter" id="shopping_hausc" name="f_shopping_hauscenter" autocomplete="off" action="https://www.livees.net/Checkout/api4" method="post" class="flex justify-end">
                            <input type="hidden" name="_" id="_" value="{{ env('LIVEES_CHECKOUT_TOKEN') }}" required readonly>
                            <input type="hidden" name="__" id="__" value="{{ env('LIVEES_CHECKOUT_KEY') }}" required readonly>
                            <input type="hidden" name="postURL" id="postURL" value="{{ route('order.success') }}" required  readonly>
                            <input type="hidden" name="amt2" value="{{ $order->total }}" required readonly>
                            <input type="hidden" name="currency" value="BOB" required readonly>
                            <input type="hidden" name="invno" value="{{ $order->id }}" required readonly>
                            <input type="hidden" name="name" value="{{ $order->name }}" required readonly>
                            <input type="hidden" name="lastname" value="{{ $order->lastname }}" required readonly>
                            <input type="hidden" name="email" value="{{ $order->email }}" required readonly>
                            <input type="hidden" name="pais" value="BO" required readonly>
                            <input type="hidden" name="estado_lbl" value="{{ $order->departament->name }}" required readonly>
                            <input type="hidden" name="phone" value="{{ $order->cellphone }}" required readonly>
                            <x-jet-button onclick="pre_pay()" class="mt-2">
                                Proceder al pago
                            </x-jet-button>
                            <script>
                                let pre_pay = () => {
                                    let loading = document.getElementById('loading-pay')
                                    let card = document.getElementById('card-pay')
                                    let form = document.getElementById('shopping-hauscenter')
                                    loading.classList.add('hidden')
                                    card.classList.add('h-screen')
                                    form.style.display= 'inline'
                                }
                            </script>
                        </form>
                    </div>
                </div>
            </div>
            <div id="card-pay" class="bg-white rounded-lg shadow-lg px-6 py-4 w-full mx-auto">
                <div id="loading-pay" class="animate-pulse space-y-2">
                    <div class="h-6 bg-gray-400 rounded w-2/12"></div>
                    <div class="h-5 bg-gray-400 rounded w-2/6"></div>
                    <div class="flex space-x-5">
                        <div class="h-16 bg-gray-400 rounded w-2/12"></div>
                        <div class="h-16 bg-gray-400 rounded w-2/12"></div>
                        <div class="h-16 bg-gray-400 rounded w-2/12"></div>
                    </div>
                </div>
                <iframe id="shopping-hauscenter" name="shopping_hauscenter" scrolling="yes" style="width:100%; height: 100%;border:none;display: none"></iframe>
            </div>
        @else
            <div class="bg-white rounded-lg shadow-lg px-6 py-4 mb-3">
                <div class="text-gray-700">
                    <p class="text-sm font-semibold text-right">Subtotal: Bs. {{ $order->total - $order->shipping_cost }}</p>
                    <p class="text-sm font-semibold text-right">Envío: Bs. {{ $order->shipping_cost }}</p>
                    <p class="text-lg font-semibold uppercase text-right">Total: Bs. {{ $order->total }}</p>
                    <p class="text-right">
                        <a href="{{ route('order.success') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition">
                            Completar compra
                        </a>
                    </p>
                </div>
            </div>
        @endif
    </div>
</x-app-layout>
