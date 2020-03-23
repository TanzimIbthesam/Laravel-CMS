<div class="mb-2 mt-2 ">
@auth

{{-- <form method="POST" action="{{route('posts.comments.store',['posts'=>$postss->id])}}"> --}}

        <form method="POST" action="{{ route('posts.comments.store', ['post' => $posts->id]) }}">
    @csrf

    <div class="form-group">

       {{-- <textarea class="form-control" type="text" name="content">

       </textarea> --}}
       <textarea name="content" id=""  rows="10" cols="80">

       </textarea>
       @errors
       @enderrors
        </div>


    <button type="submit" class="btn btn-primary btn-block">Add comment</button>
</form>

@else
<a href="{{route('login')}}">SignIn</a> to post comments
@endauth
</div>


