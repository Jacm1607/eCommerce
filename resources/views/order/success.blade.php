<x-app-layout>
    <div class="container py-8">
        <div class="bg-white shadow-lg rounded-lg px-6 py-4">
            <div class="flex items-center">
                <div class="p-4 m-2 rounded-full bg-lime-500 text-white">
                    <i class="fas fa-check text-6xl"></i>
                </div>
                <div class="p-3">
                    <p class="text-2xl">Pago completado correctamente</p>
                    <p>En estos momentos se iniciará la gestión de tu compra, nos comunicaremos contigo dentro de las primeras 24hrs. hábiles. También puedes enviarnos un whatsapp al <a class="text-lime-600 font-bold" target="_blank" href="https://wa.link/eekfh9">(+591) 650-69-921</a>. Gracias por comprar en <b>Hauscenter eCommerce.</b></p>
                    <p class="text-right"><x-success-button href="{{ route('order.index') }}">Ver mi pedido</x-success-button></p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
