
<div class="form-group">
<label for="">Title</label><br>
<input type="text" name="title" class="form-control" value="{{ old('title',$post->title ?? null) }}"><br>    
</div>
<div class="form-group">
<label for="">Content</label><br>
<input class="form-control" type="text" name="content" value="{{ old('content',$post->content ?? null) }}"><br>
</div>





@if($errors->any()) 
<div>
    <ul>
        
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        
    </ul>
</div>
@endif
