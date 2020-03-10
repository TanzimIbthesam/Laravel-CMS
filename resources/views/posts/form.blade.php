
<div class="form-group">
<label for="">Title</label><br>


<input type="text" name="title" class="form-control" value="{{ old('title',$post->title ?? null) }}"><br>
@if($errors->any())
<div>
    <ul>

            @foreach($errors->all() as $error)
           <div class="alert alert-danger">
               {{$error}}
           </div>
            @endforeach

    </ul>
</div>
@endif
{{-- @errors @enderrors --}}
</div>
{{-- @errors @enderrors --}}
<div class="form-group">
<label for="">Content</label><br>
<input class="form-control" type="text" name="content" value="{{ old('content',$post->content ?? null) }}"><br>

</div>







