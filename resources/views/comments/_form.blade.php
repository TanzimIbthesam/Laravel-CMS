<div class="mb-2 mt-2">
@auth

<form method="POST" action="#">
    @csrf

    <div class="form-group">

       <textarea class="form-control" type="text" name="content">

       </textarea>
        </div>


    <button type="submit" class="btn btn-primary btn-block">Add comment</button>
</form>
@else
<a href="{{route('login')}}">SignIn</a> to post comments
@endauth
</div>


