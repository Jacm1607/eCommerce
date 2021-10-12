@props(['product'])

<li>
    <a href="{{ route('product.show', $product) }}">
        <div class="relative max-w-sm min-w-[340px] bg-white shadow-md rounded-3xl p-2 cursor-pointer">
            <div class="overflow-x-hidden rounded-2xl relative">
                @if(count($product->images) > 0)
                    <img class="h-40 rounded-2xl w-full object-cover" src="{{ Storage::url($product->images->first()->url) }}">
                @else
                    <img class="h-40 rounded-2xl w-full object-cover" src="{{ asset('img/no_imagen.png') }}">
                @endif
                @if ($product->offer_price > 0 && !is_null($product->offer_price))
                    <p class="absolute right-2 top-2 bg-red-500 text-xs text-white font-semibold rounded-full p-1 group">
                        -{{ round(100-($product->offer_price/$product->price)*100) }}%
                    </p>
                @endif
            </div>
            <div class="mt-4 pl-2 mb-2 flex justify-between ">
                <div>
                    <p class="text-xs font-semibold text-gray-900 mb-2 leading-4">
                        {{ Str::limit($product->name, 25, '...') }}</p>
                    <p class="text-sm font-bold text-cyan-800 mt-0">Bs.
                        @if ($product->offer_price > 0 && !is_null($product->offer_price))
                            {{ number_format((float) $product->offer_price, 2, '.', '') }}
                        @else
                            {{ number_format((float) $product->price, 2, '.', '') }}
                        @endif
                    </p>
                </div>
                <div class="flex flex-col-reverse mb-1 mr-4 group cursor-pointer opacity-20">
                    <lottie-player src="https://assets3.lottiefiles.com/packages/lf20_pr1edcoq.json"
                        background="transparent" speed="1" style="width: 50px; height: 50px;" loop
                        autoplay></lottie-player>

                </div>
            </div>
        </div>
    </a>
</li>
