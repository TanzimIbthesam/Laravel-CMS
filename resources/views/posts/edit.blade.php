@extends('layouts.app')
@section('content')
{{-- <form method="POST" action="{{ route('posts.update',[$post=>id]) }}"> --}}
    <form method="POST"
          action="{{ route('posts.update', ['post' => $post->id]) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    @include('posts.form')
{{-- <input type="text" name="title" value="{{ old('title',$post->title) }}"><br>
<input type="text" name="content" value="{{ old('content',$post->content) }}"><br>
@if($errors->any())
<div>
    <ul>

            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach

    </ul>
</div>
@endif --}}
<button type="submit">Update</button>
</form>
@endsection

