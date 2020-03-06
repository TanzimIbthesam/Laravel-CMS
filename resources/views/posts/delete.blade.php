@can('delete',$post)

<form class="fm-inline" method="POST"action="{{ route('posts.destroy', ['post' => $post->id]) }}">
                @csrf
                @method('DELETE')


                <input class="btn btn-danger" type="submit" value="Delete!" />
            </form>
            @endcan
