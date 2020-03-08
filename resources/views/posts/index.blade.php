@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-8">



@forelse($posts as $post)
@if($post->trashed())
<del>
@endif
<h1>{{ $loop->index+1 }}.<a class="{{$post->trashed() ? 'text-danger':''}}" href="{{ route('posts.show', ['post' => $post->id]) }}" target="_blank">{{ $post->title }}</a></h1>


@update(['date'=>$post->created_at,'name'=>$post->user->name])

@endupdate

@if($post->comment_count)
<p>{{ $post->comment_count }} comments</p>
@else
<p>No comments yet!</p>
@endif
@can('update',$post)
<p>{{ $post->content }}</p>
</del>
@if(!$post->trashed())
<a class="d-none" href="{{ route('posts.edit', [
    'post'=>$post->id])}}">Edit</a>

    @endcan
    {{-- @cannot('delete',$post)
    <p class="text-warning">You cannot delete this post</p>

    @endcannot --}}
    @endif

     @include('posts.delete')
@empty
 <p>No Blog Post Yet</p>
@endforelse
</div>
<div class="col-md-4">
    <div class="container">
        <div class="row">
            @card(['title' => 'Most Commented'])
            @slot('subtitle')
                What people are currently talking about
            @endslot
            @slot('items')
                @foreach ($most_commented as $post)
                    <li class="list-group-item">
                        <a href="{{ route('posts.show', ['post' => $post->id]) }}">
                            {{ $post->title }}
                        </a>
                    </li>
                @endforeach
            @endslot
        @endcard
{{-- <div class="card" style="width:100%">

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
</div> --}}


</div>
<div class="row mt-4">
    @card
    @slot('title')
    Most Active writers
     @endslot

        @slot('subtitle')
            Writers with most posts written
            @endslot

        @slot('items', collect($mostActive)->pluck('name'))

    @endcard
</div>









<div class="row mt-4">
    @card
    @slot('title')
    Most Active Last Month
     @endslot

        @slot('subtitle')
        Users with most post written in last month
            @endslot

        @slot('items', collect($mostActiveLastMonth)->pluck('name'))

    @endcard
    {{-- <div class="card" style="width:100%">

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
    </div> --}}

    </div>
</div>
</div>
</div>
</div>
@endsection
