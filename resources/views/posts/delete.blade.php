@auth
@if(!$post->trashed())
@can('delete',$post)
<form method="POST"   action="{{ route('posts.destroy', [
'post'=>$post->id])}}">

 @csrf
@method('DELETE')
<input type="submit" value="DELETE" class="btn btn-danger ">
</form>
<form method="POST"   action="">

 @csrf
@method('DELETE')
<input type="submit" value="DELETE PERMANENTLY" class="btn btn-danger ">
</form>

@endcan
@endauth
@endif

