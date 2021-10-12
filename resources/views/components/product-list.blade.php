@props(['product'])

<li>
    <a href="{{ route('product.show', $product) }}">
        <div class="w-full mx-auto z-10">
            <div class="flex flex-col">
                <div class="bg-white border border-white shadow-lg  rounded-3xl p-4 m-4">
                    <div class="flex-none sm:flex">
                        <div class=" relative h-32 w-32 sm:mb-0 mb-3">
                            @if(count($product->images) > 0)
                                <img src="{{ Storage::url($product->images->first()->url) }}" class="w-32 h-32 object-cover rounded-2xl">
                            @else
                                <img src="{{ asset('img/no_imagen.png') }}" class="w-32 h-32 object-cover rounded-2xl">
                            @endif
                        </div>
                        <div class="flex-auto sm:ml-5 justify-evenly">
                            <div class="flex items-center justify-between sm:mt-2">
                                <div class="flex items-center">
                                    <div class="flex flex-col">
                                        <div class="w-full flex-none text-base text-gray-800 font-bold leading-none">
                                            {{ $product->name }}
                                            @if ($product->offer_price > 0 && !is_null($product->offer_price))
                                                <span class="text-white text-xs font-bold bg-red-500 py-0.5 px-1.5 rounded-xl">-{{ round(100-($product->offer_price/$product->price)*100) }}%</span>
                                            @endif
                                        </div>
                                        <div class="flex-auto text-gray-500 my-1">
                                            <span class="mr-3 text-xs text-white uppercase tracking-widest bg-teal-500 px-1.5 py-0.5 rounded-md">
                                                {{ $product->brand->name }}
                                            </span>
                                            @if ($product->offer_price > 0 && !is_null($product->offer_price))
                                                <span class="mr-3 text-xs line-through">Bs.
                                                    {{ number_format((float) $product->price, 2, '.', ' ') }}
                                                </span>
                                                <span class="mr-3 text-sm font-bold text-blueGray-900">Bs.
                                                    {{ number_format((float) $product->offer_price, 2, '.', ' ') }}
                                                </span>
                                            @else
                                                <span class="mr-3 text-sm">Bs.
                                                    {{ number_format((float) $product->price, 2, '.', ' ') }}
                                                </span>
                                            @endif

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
    </a>
</li>
