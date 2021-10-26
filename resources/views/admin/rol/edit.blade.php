<x-admin-layout>
    <div class="grid col-span-1">
        <div class="col-span-1">
            <div class="p-6 m-6 bg-white shadow-lg rounded-lg">
                <p class="text-2xl mb-3">Rol: <span class="uppercase">{{ $rol->name }}</span></p>
                <form action="{{ route('admin.roles.update', $rol) }}" method="post">
                    @method('PUT')
                    @csrf
                    <div class="grid grid-cols-12 gap-4 mb-5">
                        <div class="col-span-12">
                            <x-jet-label>Nombre</x-jet-label>
                            <x-jet-input :value="$rol->name" name="name" type="text" class="w-full md:w-4/12 mt-1" />
                            <x-jet-input-error for="name" />
                        </div>
                        <div class="col-span-12">
                            <x-jet-label>
                                Privilegios
                            </x-jet-label>
                            <div class="grid grid-cols-4">
                                @foreach ($privileges as $privilege)
                                <x-jet-label>
                                    <input type="checkbox" name="privileges[]" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" @if($rol->permissions->contains($privilege)) checked @endif value="{{$privilege->id}}">
                                    {{$privilege->name}}
                                </x-jet-label>
                                @endforeach
                            </div>
                            <x-jet-input-error for="createForm.privileges" />
                        </div>
                    </div>
                    <div class="flex justify-end">
                        <button class="ml-auto p-2 rounded-lg bg-gray-800 text-white uppercase text-xs tracking-widest" type="submit">Actualizar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-admin-layout>
