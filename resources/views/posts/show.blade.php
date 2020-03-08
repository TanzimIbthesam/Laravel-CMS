@extends('layouts.app')
@section('content')

<h1>{{ $posts->title }}
{{-- @if ((new Carbon\Carbon())->diffInMinutes($posts->created_at) < 20) --}}
    {{-- <strong>New!</strong> --}}
    {{-- @component('component.badge', ['type' => 'primary'])
            Brand new Post!
        @endcomponent --}}
        @badge(['show'=>now()->diffInMinutes($posts->created_at) < 20,'type' => 'primary'])
        Brand new Post!
        @endbadge
{{-- @endif --}}
</h1>
<p>{{ $posts->content }}</p>
{{-- <p> {{ $posts->created_at->diffForHumans() }}</p> --}}
@update(['date'=>$posts->created_at,'name'=>$posts->user->name])

@endupdate
{{-- //Optional --}}
{{-- @update(['date'=>$posts->updated_at])
updated
@endupdate --}}
<p>Currently read by {{$counter}} people</p>
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


<p class="text-muted">
    {{-- added  {{$commentone->created_at->diffForHumans()}} --}}
    @update(['date'=>$commentone->created_at])
  added
@endupdate


@empty
<p class="text-warning">No Comments yet</p>
@endforelse
@endsection
