<x-app-layout>
    <div class="container py-8">
        <div class="bg-white shadow-lg rounded-lg px-6 py-4 mb-3">
            <p class="text-2xl font-semibold">Pedidos</p>
        </div>
        <div class="bg-white shadow-lg rounded-lg px-6 py-4">
            <table class="table-auto w-full">
                <thead>
                    <tr>
                        <th>Cod. Orden</th>
                        <th>Fecha</th>
                        <th>Estado</th>
                        <th>Opción</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $item)
                        <tr>
                            <td class="text-center">{{ $item->id }}</td>
                            <td class="text-center">{{ $item->created_at }}</td>
                            <td class="text-center">
                                @switch($item->status)
                                    @case(1)
                                        <div class="text-yellow-500 flex justify-center items-center">
                                            <span class="material-icons-outlined">watch_later</span> <span class="ml-1 text-xs uppercase font-extrabold">Pendiente</span>
                                        </div>
                                        @break
                                    @case(2)
                                        <div class="text-purple-600 flex justify-center items-center">
                                            <span class="material-icons-outlined">inventory_2</span> <span class="ml-1 text-xs uppercase font-extrabold">Orden recibida</span>
                                        </div>
                                        @break
                                    @case(3)
                                        <div class="text-cyan-800 flex justify-center items-center">
                                            <span class="material-icons-outlined">local_shipping</span> <span class="ml-1 text-xs uppercase font-extrabold">Enviado</span>
                                        </div>
                                        @break
                                    @case(4)
                                        <div class="text-green-600 flex justify-center items-center">
                                            <span class="material-icons-outlined">done</span> <span class="ml-1 text-xs uppercase font-extrabold">Entregado</span>
                                        </div>
                                        @break
                                    @case(0)
                                        <div class="text-red-600 flex justify-center items-center">
                                            <span class="material-icons-outlined">error</span> <span class="ml-1 text-xs uppercase font-extrabold">Anulado</span>
                                        </div>
                                        @break
                                @endswitch
                            </td>
                            <td class="text-center flex justify-center">
                                <div class="my-2">
                                    <a href="{{ route('order.show', $item) }}" class="inline-flex items-center p-0.5 bg-cyan-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-cyan-700 active:bg-cyan-900 focus:outline-none focus:border-cyan-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition">
                                        <span class="material-icons-outlined">
                                            preview
                                        </span>
                                    </a>
                                    <a href="{{ route('order.pdf', $item) }}" class="inline-flex items-center p-0.5 bg-red-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 active:bg-red-900 focus:outline-none focus:border-red-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition">
                                        <span class="material-icons-outlined">
                                            picture_as_pdf
                                        </span>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="mt-3">
                {{ $orders->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
