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
                                        <div class="text-yellow-500 flex justify-center">
                                            <i class="fas fa-clock"></i> <span class="ml-1 text-xs uppercase font-extrabold">Pendiente</span>
                                        </div>
                                        @break
                                    @case(2)
                                        <div class="text-green-600 flex justify-center">
                                            <i class="fas fa-check"></i> <span class="ml-1 text-xs uppercase font-extrabold">Orden recibida</span>
                                        </div>
                                        @break
                                    @case(3)
                                        <div class="text-lightBlue-800 flex justify-center">
                                            <i class="fas fa-truck"></i> <span class="ml-1 text-xs uppercase font-extrabold">Enviado</span>
                                        </div>
                                        @break
                                    @case(4)
                                        <div class="text-lime-600 flex justify-center">
                                            <i class="fas fa-check-circle"></i></i> <span class="ml-1 text-xs uppercase font-extrabold">Entregado</span>
                                        </div>
                                        @break
                                    @case(5)
                                        <div class="text-red-600 flex justify-center">
                                            <i class="fas fa-times-circle"></i></i> <span class="ml-1 text-xs uppercase font-extrabold">Anulado</span>
                                        </div>
                                        @break
                                @endswitch
                            </td>
                            <td class="text-center flex justify-center">
                                <div class="my-2">
                                    <a href="{{ route('order.show', $item) }}" class="inline-flex items-center px-4 py-2 bg-lightBlue-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-lightBlue-700 active:bg-lightBlue-900 focus:outline-none focus:border-lightBlue-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition"><i class="fa fa-search"></i></a>
                                    <a href="{{ route('order.pdf', $item) }}" class="inline-flex items-center px-4 py-2 bg-red-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 active:bg-red-900 focus:outline-none focus:border-red-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition"><i class="fas fa-file-pdf"></i></a>
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
