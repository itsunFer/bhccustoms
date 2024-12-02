<x-gymLayout>
    <x-slot:title>
        Resultados {{$event->nombre_e}}
    </x-slot>
    <h1>Resultados {{$event->nombre_e}}</h1>
    @livewire('index-scores', ['event' => $event->id])
    <x/slot>
    @section('js')
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
        @if(session('score')=='agregada')
            <script>
                Swal.fire(
                    '¡Éxito!',
                    'Registro agregado.',
                    'success'
                )
            </script>
        @endif
        @if(session('score')=='editada')
            <script>
                Swal.fire(
                    '¡Éxito!',
                    'Registro editado.',
                    'info'
                )
            </script>
        @endif
        @if(session('score')=='eliminada')
            <script>
                Swal.fire(
                    '¡Éxito!',
                    'Registro eliminado.',
                    'error'
                )
            </script>
        @endif
    @endsection
</x-gymLayout>