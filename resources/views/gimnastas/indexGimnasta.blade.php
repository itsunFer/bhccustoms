<x-gymLayout>
    <x-slot:title>
        Players
    </x-slot>
    <h1>Players</h1>
    
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