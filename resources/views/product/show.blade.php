@section('css')
    {{-- FlexSlider --}}
    <link rel="stylesheet" href="{{ asset('vendor/FlexSlider/flexslider.css') }}">
@endsection
@section('script')
    {{-- JQuery --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    {{-- FlexSlider --}}
    <script src="{{ asset('vendor/FlexSlider/jquery.flexslider-min.js') }}"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection
<x-app-layout>
    <div class="container py-8"  x-data="modal()" :class="{'overflow-y-hidden': open}">
        {{-- MODAL --}}
        <div>
            <div
              class="fixed inset-0 w-full px-8 h-full z-50 bg-black bg-opacity-50 duration-300 overflow-y-auto hidden"
              :class="{'block':open, 'hidden':!open}"
              x-transition:enter="transition duration-300"
              x-transition:enter-start="opacity-0"
              x-transition:enter-end="opacity-100"
              x-transition:leave="transition duration-300"
              x-transition:leave-start="opacity-100"
              x-transition:leave-end="opacity-0"
            >
              <div class="relative w-full mt-10 mb-24 opacity-100">
                <div
                  class="relative bg-white shadow-lg rounded-lg text-gray-900 z-20"
                  @click.away="close()"
                  x-show="open"
                  x-transition:enter="transition transform duration-300"
                  x-transition:enter-start="scale-0"
                  x-transition:enter-end="scale-100"
                  x-transition:leave="transition transform duration-300"
                  x-transition:leave-start="scale-100"
                  x-transition:leave-end="scale-0"
                >
                  <header class="flex flex-col justify-center items-center p-3 text-blue-600">
                    <h2 class="font-semibold text-2xl">Descripción</h2>
                  </header>
                  <main class="p-3 text-center">
                    <p>{!! $product->description !!}</p>
                  </main>
                  <footer class="flex justify-center bg-transparent">
                    <button
                      class="bg-blue-600 font-semibold text-white py-3 w-full rounded-b-md hover:bg-blue-700 focus:outline-none focus:ring shadow-lg hover:shadow-none transition-all duration-300"
                      @click="close()"
                    >
                      Cerrar
                    </button>
                  </footer>
                </div>
              </div>
            </div>
        </div>
        {{-- FIN MODAL --}}
        <div class="grid grid-cols-2 gap-6">
            <div class="md:col-span-1 col-span-2">
                <!-- Place somewhere in the <body> of your page -->
                <div class="flexslider">
                    <ul class="slides">
                        @if(count($product->images) > 0)
                            @foreach ($product->images as $image)
                                <li data-thumb="{{ Storage::url($image->url) }}">
                                    <img src="{{ Storage::url($image->url) }}" />
                                </li>
                            @endforeach
                        @else
                            <img class="h-48 w-full object-cover object-center" src="{{ asset('img/no_imagen.png') }}" alt="">
                        @endif
                    </ul>
                </div>
            </div>
            <div class="md:col-span-1 col-span-2">
                <h1 class="text-lg font-bold text-gray-800">
                    {{ $product->name }}
                    @if ($product->offer_price > 0 && !is_null($product->offer_price))
                        <span class="text-white text-xs font-bold bg-red-500 py-0.5 px-1.5 rounded-xl">-{{ round(100-($product->offer_price/$product->price)*100) }}%</span>
                    @endif
                </h1>
                <div class="flex">
                    <p class="font-semibold">Marca: <span class="capitalize">{{ $product->brand->name }}</span></p>
                </div>
                @if ($product->offer_price > 0 && !is_null($product->offer_price))
                    <p class="my-4"><span class="bg-white px-2.5 py-1.5 rounded-lg shadow-sm line-through text-xs font-semibold text-gray-500 ">Bs. {{ number_format((float)$product->price, 2, '.', ' ') }}</span> <span class="bg-teal-500 text-sm text-white px-2.5 py-1.5 rounded-xl shadow-sm font-bold">Bs. {{ number_format((float)$product->offer_price, 2, '.', ' ') }}</span></p>
                @else
                    <p class="text-2xl font-semibold text-gray-800 my-4">Bs. {{ number_format((float)$product->price, 2, '.', ' ') }}</p>
                @endif
                <div class="bg-lime-500 rounded-lg shadow mb-6">
                    <div class="p-4 flex items-center">
                        <span class="flex items-center justify-center w-10 h-10 rounded-full bg-white"><i class="fas fa-truck text-lime-500"></i></span>
                        <div class="ml-4">
                            <p class="text-white">Disponible envío para toda Bolivia</p>
                            <p class="text-white text-xs uppercase tracking-widest">Recibe este producto a partir del {{ Date::now()->addDay(3)->locale('es')->format('l j F') }}</p>
                        </div>
                    </div>
                </div>
                @if ($product->status === '1')
                    @livewire('add-cart-item', ['product' => $product])
                @else
                    <div class="flex bg-red-100 rounded-lg p-4 mb-4 text-sm text-red-700" role="alert">
                        <svg class="w-5 h-5 inline mr-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
                        <div>
                            <span class="font-bold">Producto no disponible.</span> Este producto no se encuentra disponible por el momento. Puedes intentar solicitarlo haciendo <a href="#" class="font-bold">Click aquí</a>
                        </div>
                    </div>
                @endif
                <hr class="my-3">
                @if (!is_null($product->description))
                    <p>{!! Str::limit($product->description, 700, '<button @click="show()">... <span class="text-lime-500 uppercase text-xs tracking-widest font-bold">Ver mas</span></button>') !!}</p>
                @else
                    <p>Sin descripción por el momento.</p>
                    <svg xmlns="http://www.w3.org/2000/svg"
                                                class="h-6 w-6 group-hover:opacity-50 opacity-70" fill="none"
                                                viewBox="0 0 24 24" stroke="black">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                    d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                            </svg>
                @endif
            </div>
        </div>
    </div>
    @push('js')
        <script>
            // Can also be used with $(document).ready()
            $(window).ready(function() {
                $('.flexslider').flexslider({
                    animation: "slide",
                    controlNav: "thumbnails"
                });
                window.addEventListener('item-add', () => {
                    Swal.fire({
                        // title: '',
                        text: "Producto añadido correctamente al carrito.",
                        icon: 'success',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#34495E',
                        confirmButtonText: 'Ir al carrito',
                        cancelButtonText: 'Continuar comprando'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = ("{{ route('shopping-cart') }}")
                        }
                    })
                })
            });
            function modal() {
                return {
                    open:false,
                    show() {
                        if (this.open) {
                            this.open = false
                            document.getElementsByTagName('html')[0].style.overflow = 'auto'
                        } else {
                            this.open = true;
                            document.getElementsByTagName('html')[0].style.overflow = 'hidden'
                        }
                    },
                    close() {
                        this.open = false
                        document.getElementsByTagName('html')[0].style.overflow = 'auto'
                    }
                }
            }
        </script>
    @endpush
</x-app-layout>
