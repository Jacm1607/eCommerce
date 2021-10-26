<x-admin-layout>
    <div class="grid col-span-1">
        <div class="col-span-1">
            <div class="p-6 m-6 bg-white shadow-lg rounded-lg">
                <p class="text-2xl mb-3">Usuario: <span class="uppercase">{{ $user->name }}</span></p>
                <form action="{{ route('admin.users.update', $user) }}" method="post">
                    @method('PUT')
                    @csrf
                    <div class="grid grid-cols-12 gap-4 mb-5">
                        <div class="col-span-12">
                            <x-jet-label>Nombre</x-jet-label>
                            <x-jet-input :value="$user->name" name="name" type="text" class="w-full md:w-4/12 mt-1" />
                            <x-jet-input-error for="name" />
                        </div>
                        <div class="col-span-12">
                            <x-jet-label>
                                Roles
                            </x-jet-label>
                            <div class="grid grid-cols-4">
                                @foreach ($roles as $role)
                                <x-jet-label>
                                    <input type="checkbox" name="roles[]" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" @if($user->roles->contains($role)) checked @endif value="{{$role->id}}">
                                    {{$role->name}}
                                </x-jet-label>
                                @endforeach
                            </div>
                            <x-jet-input-error for="createForm.roles" />
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
