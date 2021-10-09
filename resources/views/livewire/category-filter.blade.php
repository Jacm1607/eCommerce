<div>
    <div class="bg-white rounded-lg shadow-lg">
        <div class="px-6 py-2 flex justify-between items-center mb-6">
            <h1 class="font-semibold uppercase text-gray-800">{{ $category->name }}</h1>
            <div class="grid grid-cols-2 border border-gray-200 divide-x divide-gray-200 rounded-md">
                <i class="fas fa-border-all p-3 cursor-pointer font-light {{ $view == 'grid' ? 'bg-teal-500 text-white rounded-md opacity-70' : 'text-gray-500' }}"
                    wire:click="$set('view','grid')"></i>
                <i class="fas fa-th-list p-3  cursor-pointer {{ $view == 'list' ? 'bg-teal-500 text-white rounded-md opacity-70' : 'text-gray-500' }}"
                    wire:click="$set('view','list')"></i>
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
                        <li>
                            <div
                                class="relative max-w-sm min-w-[340px] bg-white shadow-md rounded-3xl p-2 cursor-pointer">
                                <div class="overflow-x-hidden rounded-2xl relative">
                                    <img class="h-40 rounded-2xl w-full object-cover"
                                        src="https://pixahive.com/wp-content/uploads/2020/10/Gym-shoes-153180-pixahive.jpg">
                                    <p
                                        class="absolute right-2 top-2 bg-red-500 text-xs text-white font-semibold rounded-full p-1 group">
                                        -20 %
                                        {{-- <svg xmlns="http://www.w3.org/2000/svg"
                                            class="h-6 w-6 group-hover:opacity-50 opacity-70" fill="none"
                                            viewBox="0 0 24 24" stroke="black">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                        </svg> --}}
                                    </p>
                                </div>
                                <div class="mt-4 pl-2 mb-2 flex justify-between ">
                                    <div>
                                        <p class="text-xs font-semibold text-gray-900 mb-2 leading-4">
                                            {{ Str::limit($product->name, 25, '...') }}</p>
                                        <p class="text-sm font-bold text-cyan-800 mt-0">Bs.
                                            {{ number_format((float) $product->price, 2, '.', '') }}</p>
                                    </div>
                                    <div class="flex flex-col-reverse mb-1 mr-4 group cursor-pointer opacity-20">
                                        <lottie-player src="https://assets3.lottiefiles.com/packages/lf20_pr1edcoq.json"
                                            background="transparent" speed="1" style="width: 50px; height: 50px;" loop
                                            autoplay></lottie-player>

                                    </div>
                                </div>
                            </div>
                        </li>
                    @empty
                        No se ha encontrado productos
                    @endforelse
                </ul>
            @else
                <ul>
                    @forelse ($products as $product)
                        {{-- <x-product-list :product="$product"/> --}}
                        <li>
                            <div class="w-full mx-auto z-10">
                                <div class="flex flex-col">
                                    <div class="bg-white border border-white shadow-lg  rounded-3xl p-4 m-4">
                                        <div class="flex-none sm:flex">
                                            <div class=" relative h-32 w-32   sm:mb-0 mb-3">
                                                <img src="https://mediaserver.goepson.com/ImConvServlet/imconv/e7af2459bfc25d1ea99d8618abfd2aa09552495a/1200Wx1200H?use=banner&assetDescr=L1110_690x460_3" class=" w-32 h-32 object-cover rounded-2xl">
                                            </div>
                                            <div class="flex-auto sm:ml-5 justify-evenly">
                                                <div class="flex items-center justify-between sm:mt-2">
                                                    <div class="flex items-center">
                                                        <div class="flex flex-col">
                                                            <div class="w-full flex-none text-base text-gray-800 font-bold leading-none">{{ $product->name }}</div>
                                                            <div class="flex-auto text-gray-500 my-1">
                                                                <span class="mr-3 text-xs text-white uppercase tracking-widest bg-teal-500 px-1.5 py-0.5 rounded-md">
                                                                    {{ $product->brand->name }}
                                                                </span>
                                                                <span class="mr-3 text-sm">Bs.
                                                                    {{ number_format((float) $product->price, 2, '.', '') }}
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="flex flex-row items-center">
                                                    <div class="flex">
                                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                            fill="currentColor" class="h-5 w-5 text-yellow-500">
                                                            <path
                                                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                                            </path>
                                                        </svg>
                                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                            fill="currentColor" class="h-5 w-5 text-yellow-500">
                                                            <path
                                                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                                            </path>
                                                        </svg><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                            fill="currentColor" class="h-5 w-5 text-yellow-500">
                                                            <path
                                                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                                            </path>
                                                        </svg><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                            fill="currentColor" class="h-5 w-5 text-yellow-500">
                                                            <path
                                                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                                            </path>
                                                        </svg>
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                            viewBox="0 0 24 24" stroke="currentColor"
                                                            class="h-5 w-5 text-yellow-500">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z">
                                                            </path>
                                                        </svg>
                                                    </div>
                                                </div>
                                                <div class="flex pt-2 text-lg text-gray-500">
                                                    <div class="flex-1 inline-flex items-center">
                                                        <p class=""><i class=" fab fa-cc-visa"></i> <i class="fab fa-cc-mastercard"></i> <i class="fas fa-qrcode"></i></p>
                                                    </div>
                                                    <lottie-player src="https://assets3.lottiefiles.com/packages/lf20_pr1edcoq.json" background="transparent" speed="1" style="width: 50px; height: 50px; opacity: 0.2" loop autoplay></lottie-player>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
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
