<x-app-layout>
    <div class="container py-8">
        @foreach ($categories as $category)
            <section class="mb-6">
                <div class="flex items-center justify-between mb-2">
                    <h1 class="text-lg uppercase font-semibold text-gray-700">
                        {{ $category->name }}
                    </h1>
                    <a href="{{ route('categories.show', $category) }}" class="flex items-center text-xs bg-teal-500 opacity-60 hover:opacity-95 py-0.5 px-1.5 rounded-lg text-white ml-2 font-semibold">Ver más &nbsp;<i class="fas fa-chevron-right"></i></a>
                </div>
                @livewire('category-products', ['category' => $category])
            </section>
        @endforeach
    </div>
    @push('js')
        <script>
            Livewire.on('glider', function(id){
                new Glider(document.querySelector('.glider-'+id), {
                    slidesToScroll: 1,
                    slidesToShow: 1,
                    draggable: true,
                    dots: '.glider-'+id+'~ .dots',
                    arrows: {
                        prev: '.glider-'+id+'~ .glider-prev',
                        next: '.glider-'+id+'~ .glider-next'
                    },
                    responsive: [
                        {
                            breakpoint: 640,
                            settings: {
                                slidesToScroll: 2.5,
                                slidesToShow: 2,
                            }
                        },
                        {
                            breakpoint: 768,
                            settings: {
                                slidesToScroll: 3.5,
                                slidesToShow: 3,
                            }
                        },
                        {
                            breakpoint: 1024,
                            settings: {
                                slidesToScroll: 4.5,
                                slidesToShow: 4,
                            }
                        },
                        {
                            breakpoint: 1280,
                            settings: {
                                slidesToScroll: 5.5,
                                slidesToShow: 5,
                            }
                        }
                    ]
                });
            })
        </script>
    @endpush
</x-app-layout>
