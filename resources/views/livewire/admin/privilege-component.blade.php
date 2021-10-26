<div class="container py-12">
    <x-jet-form-section submit="save" class="mb-6">
        <x-slot name="title">Crear nuevo privilegio</x-slot>
        <x-slot name="description">Complete la información necesaria para poder crear un nuevo privilegio</x-slot>
        <x-slot name="form">
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label>Nombre</x-jet-label>
                <x-jet-input wire:model="createForm.name" type="text" class="w-full mt-1" />
                <x-jet-input-error for="createForm.name" />
            </div>
        </x-slot>
        <x-slot name="actions">
            <x-jet-action-message class="mr-3" on="saved">Privilegio creado</x-jet-action-message>
            <x-jet-button>Agregar</x-jet-button>
        </x-slot>
    </x-jet-form-section>
    <x-jet-action-section>
        <x-slot name="title">Lista de privilegios</x-slot>
        <x-slot name="description">Aquí encontrará todas los privilegios agregados</x-slot>
        <x-slot name="content">
            <table class="text-gray-600">
                <thead class="border-b border-gray-300">
                    <tr class="text-left">
                        <th class="py-2 w-full">Nombre</th>
                        <th class="py-2">Acción</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-300">
                    @forelse ($privileges as $privilege)
                        <tr>
                            <td class="py-2">
                                <a class="uppercase">
                                    {{ $privilege->name }}
                                </a>
                            </td>
                            <td class="py-2">
                                <div class="flex divide-x divide-gray-300 font-semibold">
                                    <a class="pr-2 hover:text-blue-600 cursor-pointer"
                                        wire:click="edit('{{ $privilege->id }}')">Editar</a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td align="center" colspan="2"><span class="font-semibold">Sin privilegios</span></td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </x-slot>
    </x-jet-action-section>
    <x-jet-dialog-modal wire:model="editForm.open">
        <x-slot name="title">Editar privilegio</x-slot>
        <x-slot name="content">
            <div class="space-y-3">
                <div>
                    <x-jet-label>Nombre</x-jet-label>
                    <x-jet-input wire:model="editForm.name" type="text" class="w-full mt-1" />
                    <x-jet-input-error for="editForm.name" />
                </div>
            </div>
        </x-slot>
        <x-slot name="footer">
            <x-jet-danger-button wire:click="update" wire:loading.attr="disabled" wire:target="update">
                Actualizar
            </x-jet-danger-button>
        </x-slot>
    </x-jet-dialog-modal>
</div>
