<x-gymLayout>
    <x-slot:title>
        Ver: {{ $forum->title }}
    </x-slot>

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <br>
                    <h1> &nbsp;&nbsp;{{ $forum->title }}</h1> 
                    <ul>
                        @foreach ($forum->tags as $tag)
                            <span class="badge bg-primary">{{ $tag->tag_name }}</span>
                        @endforeach
                    </ul>
                    <div class="card-body">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <th>{{ $forum->author->name }} {{ $forum->created_at }}</th>
                                    @if ($forum->image)
                                    <td><img src="{{Storage::url($forum->image)}}" class="img-fluid" alt="forum Image" style="min-width: 150px; max-width: 400px"> </td>
                                    @endif
                                </tr>
                            </tbody>
                        </table>
                        <p style="text-align: justify;">{!! $forum->content !!}</p>
                    </div>
                </div>
            </div>
        </div>
        @if(Auth::user()->is_admin == true)
            <div class="card">
                <br>
                
                <div class="card-body">
                        <form action="{{route('forum.destroy', $forum)}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <div class='text-center'>
                                <a href="{{route('forum.edit', $forum)}}"><button type="button" class="btn btn-primary">Editar</button></a>
                                <button type="submit" class="btn btn-danger">Eliminar</button>
                            </div>
                        </form>
                </div>
              
            </div>
            @endif
        </div>
    </div>
    <h2>Comentarios</h2>
    <livewire:comment-section :postType="'forum'" :postId="$forum->id" />
    @section('js')
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
        @if(session('forum')== 'editada')
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