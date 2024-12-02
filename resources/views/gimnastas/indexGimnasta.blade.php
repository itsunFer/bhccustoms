<x-gymLayout>
    <x-slot:title>
        Gimnastas
    </x-slot>
    <h1>Gimnastas</h1>
    
    @livewire('index-gimnasta')

    <x/slot>

    @section('js')
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
        @if(session('gimnasta')== 'agregada')
            <script>
                Swal.fire(
                    '¡Éxito!',
                    'Registro agregado.',
                    'success'
                )
            </script>
        @endif
        @if(session('gimnasta')== 'eliminada')
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