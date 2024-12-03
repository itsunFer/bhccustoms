<x-gymLayout>
    <x-slot:title>
      Ver: {{$gimnasta->nombre_g}} {{$gimnasta->gametag}}
    </x-slot>
    <h1>{{$gimnasta->nombre_g}} {{$gimnasta->gametag}}</h1>
    <div class='row'>
        <div class="col-lg-4 col-md-6">
            <div class="card">
                <div class="card-body">
                <h5 class="card-title">Details</h5>
                <!-- Default Table -->
                <table class="table">
                    <tbody>
                    <tr>
                        <th scope="row">Name</th>
                        <td>{{$gimnasta->nombre_g}}</td>
                    </tr>
                    <tr>
                        <th scope="row">Gametag</th>
                        <td>{{$gimnasta->gametag}}</td>
                    </tr>
                    </tbody>
                </table>
                <!-- End Default Table Example -->
                </div>
            </div>
        </div>
        <div class="col-lg-8 col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Information</h5>
                    <p>{{$gimnasta->nombre_g}} {{$gimnasta->gametag}}.
                    </p>
                    @if(Auth::user()->is_admin == true)
                        <form action="{{route('gimnasta.destroy', $gimnasta)}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <div class='text-center'>
                                <a href="{{route('gimnasta.edit', $gimnasta)}}"><button type="button" class="btn btn-primary">Edit</button></a>
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </div>
                        </form>
                    @endif
                </div>
    </div>
    @section('js')
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
        @if(session('gimnasta')== 'editada')
            <script>
                Swal.fire(
                    '¡Éxito!',
                    'Registro modificado.',
                    'info'
                )
            </script>
        @endif
    @endsection
</x-gymLayout>