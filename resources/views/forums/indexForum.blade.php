<x-gymLayout>
    <x-slot:title>
        Foros
    </x-slot>
    <h1>Foros</h1>

    <livewire:forums-index/>
    
    <x/slot>

    @section('js')
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
        @if(session('forum') == 'agregado')
            <script>
                Swal.fire(
                    '¡Éxito!',
                    'Registro agregado.',
                    'success'
                )
            </script>
        @endif
        @if(session('forum')== 'eliminado')
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