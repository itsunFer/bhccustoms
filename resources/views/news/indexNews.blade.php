<x-gymLayout>
    <x-slot:title>
        Noticias
    </x-slot>
    <h1>Noticias</h1>

    <livewire:news-index/>
    
    <x/slot>

    @section('js')
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
        @if(session('news')== 'agregada')
            <script>
                Swal.fire(
                    '¡Éxito!',
                    'Registro agregado.',
                    'success'
                )
            </script>
        @endif
        @if(session('news')== 'eliminada')
            <script>
                Swal.fire(
                    '¡Éxito!',
                    'Registro elimnado.',
                    'error'
                )
            </script>
        @endif
    @endsection
</x-gymLayout>