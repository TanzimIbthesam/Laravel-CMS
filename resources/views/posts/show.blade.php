@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-md-8">
        @if($posts->image)
        {{-- <div style="background-image: url('{{ Storage::url($posts->image->thumbnail)}}'); min-height: 500px; color: white; text-align:center; background-attachment:fixed;background-repeat:no-repeat;background-position:cover" > --}}
            <img src="{{Storage::url($posts->image->thumbnail)}}" class="img-responsive" alt="">
          <h1>{{$posts->title}}</h1>
          <p>{{$posts->content}}</p>

        @else
        <h1>{{ $posts->title }}<h1>
            <p class="para">{{$posts->content}}</p>

            {{-- <h1 style="padding-top: 100px; text-shadow: 1px 2px #000"> --}}
        @endif




        {{-- <img src="{{Storage::url($posts->image->thumbnail)}}" class="img-responsive" alt=""> --}}
{{-- <h1>{{ $posts->title }} --}}
{{-- @if ((new Carbon\Carbon())->diffInMinutes($posts->created_at) < 20) --}}
    {{-- <strong>New!</strong> --}}
    {{-- @component('component.badge', ['type' => 'primary'])
            Brand new Post!
        @endcomponent

        @badge(['show'=>now()->diffInMinutes($posts->created_at) < 20,'type' => 'primary'])
        Brand new Post!
        @endbadge
{{-- @endif --}}


{{--
<p>{{ $posts->content }}</p> --}}
 {{-- <img src="{{ asset('storage/' . $posts->image->thumbnail) }}" alt="" class="img-thumbnail"> --}}
{{-- <img src="http://localhost/storage/app/thumbnails/{{}}" alt="" class="img-responsive"> --}}





   @update(['date'=>$posts->created_at,'name'=>$posts->user->name])
   <span> Added</span>

@endupdate
@tags(['tags'=>$posts->tags])
@endtags
{{-- //Optional --}}
{{-- @update(['date'=>$posts->updated_at])
updated
@endupdate --}}
<p class="para">Currently read by {{$counter}} people</p>
{{-- Conditional rendering --}}


{{-- @if ($posts->id === 1)
    Post one!
@elseif ($posts->id == 2)
    Post two!
@else
    Something else
@endif --}}

<h4>Comments</h4>

@forelse ($posts->comment as $commentone)

<p>{{$commentone->content}}</p>

    {{-- <p>added- {{ \Carbon\Carbon::now()->diffForHumans() }}</p> --}}
    {{-- <p>added- {{ \Carbon\Carbon::now()->diffForHumans() }}</p> --}}



    {{-- added  {{$commentone->created_at->diffForHumans()}} --}}
 @update(['date'=>$commentone->created_at,'name'=>$commentone->user->name])
 <span>Added</span>

    @endupdate


@empty
<p class="text-warning">No Comments yet</p>
@endforelse
@include('comments._form')
</div>
<div class="col-md-4">
@include('posts._activity');
</div>
</div>
@endsection
