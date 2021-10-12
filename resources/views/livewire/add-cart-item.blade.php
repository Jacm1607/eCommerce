<div class="grid grid-cols-2">
    <div class="col-span-1">
        <select name="" id="" wire:model.defer="qty">
            @for ($i = 1; $i < 5; $i++)
                <option value="{{ $i }}">{{ $i }}</option>
            @endfor
        </select>
    </div>
    <div class="col-span-1">
        <button wire:click="addItem" wire:loading.attr="disabled" wire:target="addItem" class="bg-teal-500 uppercase text-xs tracking-widest text-white rounded-full w-full py-1.5">
            Añadir al carrito <i class="fas fa-cart-plus"></i>
        </button>
    </div>
</div>
