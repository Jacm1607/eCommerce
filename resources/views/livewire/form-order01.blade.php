<div class="container py-8 grid grid-cols-5 gap-6">
    @if (Cart::count())
        <div class="col-span-3">
            <p class="mt-6 text-lg text-gray-700 font-semibold">Datos de Cliente:</p>
            <div class="bg-white shadow-lg rounded-lg p-6">
                <div class="grid grid-cols-3 gap-3">
                    <div class="col-span-1">
                        <div>
                            <x-jet-label value="Nombre(s)*" />
                            <x-jet-input type="text" wire:model.defer="name" placeholder="Ingrese nombres" class="w-full"/>
                            <x-jet-input-error for="name" />
                        </div>
                    </div>
                    <div class="col-span-1">
                        <div>
                            <x-jet-label value="Apellidos*" />
                            <x-jet-input type="text" wire:model.defer="lastname" placeholder="Ingrese apellidos" class="w-full"/>
                            <x-jet-input-error for="lastname" />
                        </div>
                    </div>
                    <div class="col-span-1">
                        <div>
                            <x-jet-label value="CI*" />
                            <x-jet-input type="number" wire:model.defer="ci" min="1" placeholder="Ingrese cédula identidad" class="w-full"/>
                            <x-jet-input-error for="ci" />
                        </div>
                    </div>
                    <div class="col-span-2">
                        <div>
                            <x-jet-label value="Correo*" />
                            <x-jet-input type="text" wire:model.defer="email" placeholder="Ingrese email" class="w-full" />
                            <x-jet-input-error for="email" />
                        </div>
                    </div>
                    <div class="col-span-1">
                        <div>
                            <x-jet-label value="Celular de contacto*" />
                            <x-jet-input type="number" wire:model.defer="cellphone" placeholder="Ingrese celular" class="w-full"/>
                            <x-jet-input-error for="cellphone" />
                        </div>
                    </div>
                    <div class="col-span-1">
                        <div>
                            <x-jet-label value="Departamento*" />
                            <select wire:model="departament_id" class="form-control w-full rounded-md">
                                <option value="" hidden selected>Seleccione una opción</option>
                                @foreach ($departaments as $departament)
                                    <option value="{{ $departament->id }}">{{ $departament->name }}</option>
                                @endforeach
                            </select>
                            <x-jet-input-error for="departament_id" />
                        </div>
                    </div>
                    <div class="col-span-1">
                        <div>
                            <x-jet-label value="Provicia*" />
                            <select wire:model="province_id" wire:loading.attr="disabled" wire:target="departament_id" class="form-control w-full rounded-md">
                                <option value="" hidden selected>Seleccione una opción</option>
                                @foreach ($provinces as $province)
                                    <option value="{{ $province->id }}">{{ $province->name }}</option>
                                @endforeach
                            </select>
                            <x-jet-input-error for="province_id" />
                        </div>
                    </div>
                    <div class="col-span-1">
                        <div>
                            <x-jet-label value="Municipio*" />
                            <select wire:model="municipality_id" wire:loading.attr="disabled" wire:target="province_id"
                            {{-- wire:change="ShowMethodDelivery($event.target.value)"  --}}
                            class="form-control w-full rounded-md">
                                <option value="" hidden selected>Seleccione una opción</option>
                                @foreach ($municipalities as $municipality)
                                    <option value="{{ $municipality->id }}">{{ $municipality->name }}</option>
                                @endforeach
                            </select>
                            <x-jet-input-error for="municipality_id" />
                        </div>
                    </div>
                </div>
            </div>

            <p class="mt-6 text-lg text-gray-700 font-semibold">Datos de Facturación:</p>
            <div class="bg-white shadow-lg rounded-lg p-6">
                <div class="grid grid-cols-2 gap-3">
                    <div class="col-span-1">
                        <x-jet-label value="Razón social" />
                        <x-jet-input type="text" wire:model.defer="razon_social" placeholder="Ingrese Razón social" class="w-full"/>
                    </div>
                    <div class="col-span-1">
                        <x-jet-label value="NIT" />
                        <x-jet-input type="text" wire:model.defer="nit" placeholder="Ingrese NIT" class="w-full"/>
                    </div>
                </div>
            </div>

            <div>
                <x-jet-button wire:click="create_order" class="mt-4 mb-6">Continuar con la compra</x-jet-button>
                <hr>
                <p class="mt-2 text-sm text-gray-500">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Impedit delectus tenetur dolor nam itaque non a culpa iste modi eos cum, eaque asperiores ipsam hic debitis reprehenderit sequi esse optio. <a href="#" class="font-semibold text-lightBlue-700">Politicas y privacidad</a></p>
            </div>
        </div>
        <div class="col-span-2">
            <p class="mt-6 text-lg text-gray-700 font-semibold">Carrito:</p>
            <div class="bg-white rounded-lg shadow-lg">
                <ul>
                    @forelse (Cart::content() as $item)
                        <li class="flex p-2 border-b border-gray-200">
                            <img class="h-15 w-20 object-center object-cover mr-4" src="{{ $item->options->image }}">
                            <article class="flex-1">
                                <h1 class="font-bold">{{ $item->name }}</h1>
                                <p>Cantidad: {{ $item->qty }}</p>
                                <p>Bs. {{ $item->price }}</p>
                            </article>
                        </li>
                    @empty
                        <li class="py-6 px-4">
                            <p class="text-center text-gray-700">No tiene agregado ningun producto en el carrito</p>
                        </li>
                    @endforelse
                </ul>
                <div class="text-gray-600 px-6 py-4">
                    <p class="flex justify-between">
                        Subtotal
                        <span>Bs. {{ Cart::subtotal() }}</span>
                    </p>
                    <p class="flex justify-between">
                        Envío
                        <span>Gratis</span>
                    </p>
                </div>
                <hr class="mt-1 mb-2">
                <div class="text-gray-600 px-6 py-4">
                    <p class="flex justify-between">
                        Total
                        <span>Bs. {{ Cart::subtotal() }}</span>
                    </p>
                </div>
            </div>
        </div>
    @else
        <div class="col-span-5">
            <div class="bg-white shadow-lg rounded-lg p-4 flex flex-col items-center">
                <p class="text-lg font-semibold">Para crear una orden de compra, necesita tener productos agregados al carrito de compras.</p>
                <p><a href="{{ url('/') }}" class="cursor-pointer bg-gray-800 text-white inline-block py-2 px-4 my-1 rounded-2xl">Ir al inicio</a></p>
            </div>
        </div>
    @endif
</div>
