<x-app-layout>
    <div class="container py-8">
        <figure class="mb-4">
            <img class="w-full h-80 object-cover object-center" src="{{ Storage::url($subcategory->image) }}" alt="">
        </figure>
        @livewire('subcategory-filter', ['subcategory' => $subcategory])
    </div>
</x-app-layout>
