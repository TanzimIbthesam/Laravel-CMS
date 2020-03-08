@if(!$post->trashed())
@can('delete',$post)
<form method="POST"   action="{{ route('posts.destroy', [
'post'=>$post->id])}}">

 @csrf
@method('DELETE')
<input type="submit" value="DELETE" class="btn btn-danger ">




</form>
@endcan
@endif

