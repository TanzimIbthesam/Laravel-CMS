@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-8">



@forelse($posts as $post)



@if($post->trashed())
<del>
@endif
<h1>{{ $loop->index+1 }}.<a class="{{$post->trashed() ? 'text-danger':''}}" href="{{ route('posts.show', ['post' => $post->id]) }}" target="_blank">{{ $post->title }}</a></h1>
<a href="https://en.wikipedia.org/">Hello</a>

@update(['date'=>$post->created_at,'name'=>$post->user->name,'userId'=>$post->user->id])

@endupdate
@tags(['tags'=>$post->tags])

@endtags

@if($post->comment_count)
<p>{{ $post->comment_count }} comments</p>
@else
<p>No comments yet!</p>
@endif
@auth
@can('update',$post)
<p>{{ $post->content }}</p>
</del>
{{-- //Code for explanation --}}
 {{-- @if($post->trashed())
<a class="d-none" href="{{ route('posts.edit', [
    'post'=>$post->id])}}">Edit</a>
@else
<a class="d-block" href="{{ route('posts.edit', [
    'post'=>$post->id])}}">Edit</a>
    @endcan
    @endif
    @endauth --}}

    {{-- @cannot('delete',$post)
    <p class="text-warning">You cannot delete this post</p>

    @endcannot --}}
    {{-- @endif --}}
{{-- //Refactored code --}}
 @if(!$post->trashed())
<a class="" href="{{ route('posts.edit', [
    'post'=>$post->id])}}">Edit</a>

    @endcan
    @endif
    @endauth


     @include('posts.delete')
@empty
 <p>No Blog Post Yet</p>
@endforelse
</div>
<div class="col-md-4">
@include('posts._activity');
</div>
</div>
</div>
@endsection
