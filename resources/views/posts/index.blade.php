@extends('layouts.app')

@section('content')
@forelse($posts as $post)
<h1>{{ $loop->index+1 }}.<a class="text-white" href="{{ route('posts.show', ['post' => $post->id]) }}" target="_blank">{{ $post->title }}</a></h1>
@if($post->comment_count)
<p>{{ $post->comment_count }} comments</p>
@else
<p>No comments yet!</p>
@endif
<p>{{ $post->content }}</p>
<a href="{{ route('posts.edit', [
    'post'=>$post->id])}}">Edit</a>
    {{-- <form action="{{ route('posts.destroy', [
    'post'=>$post->id])}}">

     @csrf
    @method('DELETE')
    <input type="submit" value="DELETE">




    </form> --}}
     @include('posts.delete')
@empty
 <p>No Blog Post Yet</p>
@endforelse
@endsection
