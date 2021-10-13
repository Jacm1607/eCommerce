<div x-data="{envio_type_step1 : @entangle('envio_type_step_1')}" class="container py-8 grid grid-cols-6 gap-6">
    @if (Cart::count())
        <div class="col-span-3">
            <div>
                <p class="mt-6 text-lg text-gray-700 font-semibold">Método de entrega*</p>
                <p class="text-sm">Habilitado según su ubicación escogida:</p>
                <x-jet-input-error for="method_delivery_id" />
                <div class="">
                    @foreach ($delivery_methods as $dm)
                        <div class="mt-2 bg-white shadow-lg rounded-lg">
                            <label class="rounded-lg px-6 py-4 flex items-center">
                                <input x-model="envio_type_step1" wire:model="method_delivery_id" wire:loading.attr="disabled" wire:target="method_delivery_id" type="radio" value="{{ $dm->id }}" class="text-gray-600">
                                <span class="ml-2 text-gray-700">{{ $dm->name }} <small class="text-gray-400"></small></span>
                                {{-- <span class="ml-auto">Bs. 15.00</span> --}}
                            </label>
                            <div class="px-6 pb-6 grid grid-cols-2 gap-6 hidden" :class="{ 'hidden': envio_type_step1 != {{ $dm->id }} }">
                                <div class="col-span-2">
                                    @switch($dm->id)
                                        @case(1)
                                            <x-jet-label value="Sucursal*" />
                                            <select wire:model="branch_office" class="form-control rounded-lg border-gray-300 w-full">
                                                <option value="" hidden selected>Seleccione una opción</option>
                                                <option value="Sucursal Cañoto">Sucursal Cañoto</option>
                                                <option value="Sucursal Ventura Mall">Sucursal Ventura Mall</option>
                                                <option value="Sucursal Mall Las Brisas">Sucursal Mall Las Brisas</option>
                                                <option value="Sucursal Mall Beauty Plaza">Sucursal Mall Beauty Plaza</option>
                                                <option value="Sucursal Mall Mega Center">Sucursal Mall Mega Center</option>
                                            </select>
                                            <x-jet-input-error for="branch_office" />
                                            @break
                                        @case(2)
                                            <div class="grid grid-cols-2 gap-4">
                                                <div class="col-span-1">
                                                    <x-jet-label value="Anillo*" />
                                                    <select wire:model="ring" class="form-control rounded-lg border-gray-300 w-full">
                                                        <option value="" hidden selected>Seleccione una opción</option>
                                                        <option value="1er a 4to anillo">1er a 4to anillo</option>
                                                        <option value="4to a 6to anillo">4to a 6to anillo</option>
                                                        <option value="6to a 9no anillo">6to a 9no anillo</option>
                                                    </select>
                                                    <x-jet-input-error for="ring"/>
                                                </div>
                                                <div class="col-span-1">
                                                    <x-jet-label value="Dirección*" />
                                                    <x-jet-input wire:model.defer="address" type="text" class="w-full" placeholder="Ej: Av. cañoto entre calle florida y junín." />
                                                    <x-jet-input-error for="address" />
                                                </div>
                                                <div class="col-span-1">
                                                    <x-jet-label value="Edificio / Apartamento" />
                                                    <x-jet-input wire:model.defer="edifice_departament" type="text" class="w-full" placeholder="" />
                                                </div>
                                                <div class="col-span-1">
                                                    <x-jet-label value="Zona*" />
                                                    <select wire:model="zone" class="form-control rounded-lg border-gray-300 w-full">
                                                        <option value="" hidden selected>Seleccione una opción</option>
                                                        <option value="Norte">Norte</option>
                                                        <option value="Sur">Sur</option>
                                                        <option value="Este">Este</option>
                                                        <option value="Oeste">Oeste</option>
                                                    </select>
                                                    <x-jet-input-error for="zone" />
                                                </div>
                                                <div class="col-span-2">
                                                    <x-jet-label value="Detalle de la dirección*" />
                                                    <textarea wire:model.defer="detail_address" class="w-full px-3 py-2 text-gray-700 border-gray-300 rounded-lg focus:outline-none" placeholder="Ej: Calle 15 de diciembre, Casa de 2 pisos, puerta de color café." rows="2"></textarea>
                                                    <x-jet-input-error for="detail_address" />
                                                </div>
                                                <div class="col-span-2">
                                                    <x-jet-label value="Nota" />
                                                    <textarea wire:model.defer="note" class="w-full px-3 py-2 text-gray-700 border-gray-300 rounded-lg focus:outline-none" rows="2"></textarea>
                                                </div>
                                            </div>
                                            @break
                                        @case(3)
                                            <x-jet-label value="Nombre de la Transportadora de preferencia (Pago en destino)*" />
                                            <x-jet-input type="text" wire:model.defer="terminal" class="w-full" placeholder="Ingrese el nombre de su transportadora de confianza" />
                                            <p class="text-sm text-red-500 font-semibold">Embarque en 2 a 3 días hábiles.</p>
                                            <x-jet-input-error for="terminal" />
                                    @endswitch
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="col-span-3">
            <p class="mt-6 text-lg text-gray-700 font-semibold">Método de pago*</p>
            <p class="text-sm">Disponible y habilitado:</p>
            <x-jet-input-error for="method_pay_id" />
            @if (count($pay_methods))
                @foreach ($pay_methods as $pm)
                    <div class="mt-2 bg-white shadow-lg rounded-lg">
                        <label class="rounded-lg px-6 py-4 flex items-center">
                            <input name="pay" wire:model="method_pay_id" type="radio" value="{{ $pm->id }}" class="text-gray-600">
                            <span class="ml-2 text-gray-700">{{ $pm->name }} <small class="text-gray-400"></small></span>
                            <span class="ml-auto"><i class="fas fa-visa"></i></span>
                        </label>
                    </div>
                @endforeach
                <div class="mt-4 flex justify-end">
                    <x-jet-button wire:click="registration">
                        Continuar al pago
                    </x-jet-button>
                </div>
            @else
                <div class="mt-2 bg-white shadow-lg rounded-lg p-6">
                    <div class="animate-pulse flex space-x-4">
                        <div class="rounded-full bg-gray-400 h-4 w-4"></div>
                        <div class="h-4 bg-gray-400 rounded w-3/4"></div>
                    </div>
                </div>
            @endif
        </div>
    @else
        <div class="col-span-6">
            <div class="bg-white shadow-lg rounded-lg p-4 flex flex-col items-center">
                <p class="text-lg font-semibold">Para continuar con la orden de compra, necesita haber creado una orden antes.</p>
                <p><a href="{{ url('/') }}" class="cursor-pointer bg-gray-800 text-white inline-block py-2 px-4 my-1 rounded-2xl">Ir al inicio</a></p>
            </div>
        </div>
    @endif
</div>
