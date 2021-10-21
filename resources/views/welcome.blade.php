@section('css')
    {{-- Glider --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/glider-js/1.7.7/glider.min.css" integrity="sha512-YM6sLXVMZqkCspZoZeIPGXrhD9wxlxEF7MzniuvegURqrTGV2xTfqq1v9FJnczH+5OGFl5V78RgHZGaK34ylVg==" crossorigin="anonymous" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@3.1.6/dist/css/splide.min.css">
@endsection
@section('script')
    {{-- Glider --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/glider-js/1.7.7/glider.min.js" integrity="sha512-tHimK/KZS+o34ZpPNOvb/bTHZb6ocWFXCtdGqAlWYUcz+BGHbNbHMKvEHUyFxgJhQcEO87yg5YqaJvyQgAEEtA==" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@3.1.6/dist/js/splide.min.js"></script>
@endsection
<x-app-layout>
    <div class="container">
        <div class="splide" data-splide='{"type":"loop","autoplay": true}'>
            <div class="splide__track">
                  <ul class="splide__list">
                      @for ($i = 0; $i < 2; $i++)
                      <li class="splide__slide"><img class="object-cover object-center rounded-lg" src="https://picsum.photos/1280/420"></li>
                      @endfor
                  </ul>
            </div>
        </div>
        <div class="grid grid-cols-2 mx-4 mt-4 gap-4">
            <div class="col-span-1">
                <a href="#">
                    <div class="bg-white shadow-lg rounded-lg p-4">
                        <lottie-player src="{{asset('img/data.json')}}"  background="transparent"  speed="1" loop autoplay></lottie-player>
                    </div>
                </a>
            </div>
            <div class="col-span-1">
                <a href="#">
                    <div class="bg-red-500 shadow-lg rounded-lg p-4">
                        {{-- <img class="h-32 object-center object-contain" src="{{ asset('img/credito.gif') }}"> --}}
                        bonatti
                    </div>
                </a>
            </div>
        </div>
    </div>
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
        <script>
            new Splide( '.splide' ).mount();
          </script>
    @endpush
</x-app-layout>
