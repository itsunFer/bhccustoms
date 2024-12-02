<x-gymLayout>
    <x-slot:title>
        Galeria {{$gimnasta->nombre_g}} {{$gimnasta->apellido_g}}
    </x-slot>
    <h1>{{$gimnasta->nombre_g}} {{$gimnasta->apellido_g}}</h1>

    {{--<section id="galeria" class="container">
        <div class="row">
            @foreach ($pics as $pic)
                <div class="col-lg-4 col-md-6 cold-sm-12 bor">
                    <img src="{{Storage::url($pic->hash)}}" class="img-fluid">  
                </div>
            @endforeach
        </div>
    </section>--}}

    <div class="carousel text-center">
        @foreach ($pics as $pic)
            <img src="{{Storage::url($pic->hash)}}">  
        @endforeach
    </div>
    <x/slot>
    @section('js')
    <script>
        // Código JavaScript para el carrusel
        const images = document.querySelectorAll('.carousel img');
        let currentIndex = 0;

        function showImage(index) {
            images.forEach((img, i) => {
                if (i === index) {
                    img.style.opacity = '1';
                } else {
                    img.style.opacity = '0';
                }
            });
        }

        function nextImage() {
            currentIndex = (currentIndex + 1) % images.length;
            showImage(currentIndex);
        }

        function prevImage() {
            currentIndex = (currentIndex - 1 + images.length) % images.length;
            showImage(currentIndex);
        }

        showImage(currentIndex);

        // Configura la navegación
        setInterval(nextImage, 3000); // Cambiar automáticamente cada 3 segundos
    </script>
    @endsection
</x-gymLayout>