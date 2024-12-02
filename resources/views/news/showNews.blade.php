<x-gymLayout>
    <x-slot:title>
        Ver: {{ $news->title }}
    </x-slot>

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <br>
                    <h1> &nbsp;&nbsp;{{ $news->title }}</h1> 
                    <div class="card-body">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <th>{{ $news->author->name }} {{ $news->created_at }}</th>
                                    @if ($news->image)
                                    <td><img src="{{Storage::url($news->image)}}" class="img-fluid" alt="News Image" style="min-width: 150px; max-width: 400px"> </td>
                                    @endif
                                </tr>
                            </tbody>
                        </table>
                        <p style="text-align: justify;">{!! $news->content !!}</p>
                    </div>
                </div>
            </div>
        </div>
        @if(Auth::user()->is_admin == true)
            <div class="card">
                <br>
                
                <div class="card-body">
                        <form action="{{route('news.destroy', $news)}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <div class='text-center'>
                                <a href="{{route('news.edit', $news)}}"><button type="button" class="btn btn-primary">Editar</button></a>
                                <button type="submit" class="btn btn-danger">Eliminar</button>
                            </div>
                        </form>
                </div>
              
            </div>
            @endif
        </div>
    </div>
    <h2>Comentarios</h2>
    <livewire:comment-section :postType="'news'" :postId="$news->id" />
    @section('js')
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
        @if(session('news')== 'editada')
            <script>
                Swal.fire(
                    '¡Éxito!',
                    'Registro modificado.',
                    'info'
                )
            </script>
        @endif
        <script>
            Livewire.on('commentAdded', function(commentId) {
                var commentElement = document.getElementById('comment-' + commentId);
                if (commentElement) {
                    commentElement.scrollIntoView({ behavior: 'smooth' });
                }
            });
        </script>
        <script>
            Livewire.on('commentDeleted', commentId => {
                let deletedComment = document.getElementById('comment-' + commentId );
                if (deletedComment) {
                    deletedComment.remove();
                }
            });
        </script>
    @endsection
</x-gymLayout>