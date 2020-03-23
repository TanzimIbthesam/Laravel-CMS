
<div class="form-group">
<label for="">Title</label><br>


<input type="text" name="title" class="form-control" value="{{ old('title',$post->title ?? null) }}"><br>

{{-- @errors @enderrors --}}
</div>
{{-- @errors @enderrors --}}
<div class="form-group">
<label for="">Content</label><br>
<input class="form-control" type="text" name="content" value="{{ old('content',$post->content ?? null) }}"><br>

</div>
<div class="form-group">
<label for="">Thumbnail</label><br>
<input type="file" name="thumbnail" class="form-control-file">

</div>
@errors @enderrors







