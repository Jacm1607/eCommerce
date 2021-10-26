<div>
    <x-jet-form-section submit="save" class="mb-6">
        <x-slot name="title">
            Crear nuevo rol
        </x-slot>
        <x-slot name="description">
            Complete la información necesaria para poder crear un nuevo rol
        </x-slot>
        <x-slot name="form">
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label>Nombre</x-jet-label>
                <x-jet-input wire:model="createForm.name" type="text" class="w-full mt-1" />
                <x-jet-input-error for="createForm.name" />
            </div>
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label>Privilegios</x-jet-label>
                <div class="grid grid-cols-3">
                    @foreach ($privileges as $privilege)
                        <x-jet-label>
                            <x-jet-checkbox
                                wire:model.defer="createForm.privileges"
                                name="privileges[]"
                                value="{{$privilege->id}}" />
                            {{$privilege->name}}
                        </x-jet-label>
                    @endforeach
                </div>
                <x-jet-input-error for="createForm.privileges" />
            </div>
        </x-slot>
        <x-slot name="actions">
            <x-jet-action-message class="mr-3" on="saved">Nuevo rol creado</x-jet-action-message>
            <x-jet-button>Agregar</x-jet-button>
        </x-slot>
    </x-jet-form-section>
    <x-jet-action-section>
        <x-slot name="title">Lista de roles</x-slot>
        <x-slot name="description">Aquí encontrará todas los roles agregados</x-slot>
        <x-slot name="content">
            <table class="text-gray-600">
                <thead class="border-b border-gray-300">
                    <tr class="text-left">
                        <th class="py-2 w-full">Nombre</th>
                        <th class="py-2">Acción</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-300">
                    @foreach ($roles as $rol)
                        <tr>
                            <td class="py-2">
                                <a class="uppercase hover:text-blue-600">
                                    {{$rol->name}}
                                </a>
                            </td>
                            <td class="py-2">
                                <div class="flex divide-x divide-gray-300 font-semibold">
                                    <a href="{{ route('admin.roles.edit', $rol) }}" class="pr-2 hover:text-blue-600 cursor-pointer">Editar</a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </x-slot>
    </x-jet-action-section>
</div>
