@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-8">



@forelse($posts as $post)
@if($post->trashed())
<del>
@endif
<h1>{{ $loop->index+1 }}.<a class="{{$post->trashed() ? 'text-danger':''}}" href="{{ route('posts.show', ['post' => $post->id]) }}" target="_blank">{{ $post->title }}</a></h1>
</del>
<p>
   Added     {{$post->created_at->diffforHumans() }}
   by {{$post->user->name}}
</p>
@if($post->comment_count)
<p>{{ $post->comment_count }} comments</p>
@else
<p>No comments yet!</p>
@endif
@can('update',$post)
<p>{{ $post->content }}</p>
@if(!$post->trashed())
<a href="{{ route('posts.edit', [
    'post'=>$post->id])}}">Edit</a>
@endif
    @endcan
    {{-- @cannot('delete',$post)
    <p class="text-warning">You cannot delete this post</p>

    @endcannot --}}
   {{-- @if(!$post->trashed())
    @can('delete',$post)
    <form method="POST"   action="{{ route('posts.destroy', [
    'post'=>$post->id])}}">

     @csrf
    @method('DELETE')
    <input type="submit" value="DELETE" class="btn btn-warning ">




    </form>
    @endcan --}}
{{-- @endif --}}

     @include('posts.delete')
@empty
 <p>No Blog Post Yet</p>
@endforelse
</div>
<div class="col-md-4">
    <div class="container">
        <div class="row">
<div class="card" style="width:100%">

    <div class="card-body">
        <h5 class="card-title text-dark">Most Commented</h5>
     <h6 class="text-dark card-subtitle mb-2">What people are currently talking about</h6>

    <ul class="list-group list-group-flush">

        @foreach($most_commented as $post){
            <li class="list-group-item">
            <a  href="{{route('posts.show',['post'=>$post->id])}}" target='_blank'>{{$post->title}}</a>
                </li>
        }
       @endforeach
    </ul>
</div>
</div>

</div>
<div class="row mt-4">
    <div class="card" style="width:100%">

        <div class="card-body ">
            <h5 class="card-title text-dark">Most Active Users with most posts</h5>
         <h6 class="text-dark card-subtitle mb-2">What people are currently talking about</h6>

        <ul class="list-group list-group-flush">

            @foreach($mostActive as $user){
                <li class="list-group-item text-dark">
                  {{$user->name}}
                    </li>
            }
           @endforeach
        </ul>
    </div>
    </div>

    </div>
<div class="row mt-4">
    <div class="card" style="width:100%">

        <div class="card-body ">
            <h5 class="card-title text-dark">Most Active Last Month</h5>
         <h6 class="text-dark card-subtitle mb-2">Users with most post written in last month</h6>

        <ul class="list-group list-group-flush">

            @foreach($mostActiveLastMonth as $user){
                <li class="list-group-item text-dark">
                  {{$user->name}}
                    </li>
            }
           @endforeach
        </ul>
    </div>
    </div>

    </div>
</div>
</div>
</div>
</div>
@endsection
