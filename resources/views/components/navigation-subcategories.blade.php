@props(['category'])

<div class="grid grid-cols-4 p-4">
    <div class="">
        <p class="font-bold text-sm uppercase tracking-widest text-center text-lightBlue-700 mb-2">Subcategorias</p>
        <ul>
            @foreach ($category->subcategories as $subcategory)
                @if ($subcategory->subcategory_status == 1)
                    <li class="border-b-2 border-gray-200">
                        <a href="{{ route('subcategories.show', $subcategory) }}" class="text-gray-600 font-semibold text-xs uppercase tracking-widest inline-block py-1 px-4 hover:text-lightBlue-800 leading-4 pt-1.5">{{ $subcategory->name }}</a>
                    </li>
                @endif
            @endforeach
        </ul>
    </div>
    <div class="col-span-3 p-3">
        {{-- <img class="h-64 w-full object-cover object-center" src="{{ Storage::url($category->image) }}" alt=""> --}}
    </div>
</div>
