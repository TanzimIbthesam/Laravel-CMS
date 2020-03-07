@can('delete',$post)
@if($post->trashed())
<form class="fm-inline d-none" method="POST"action="{{ route('posts.destroy', ['post' => $post->id]) }}">
                @csrf
                @method('DELETE')


                <input class="btn btn-danger" type="submit" value="Delete!" />
            </form>

            @endcan
            @endif
