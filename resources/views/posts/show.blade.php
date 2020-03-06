@extends('layouts.app')
@section('content')

<h1>{{ $posts->title }}</h1>
<p>{{ $posts->content }}</p>
<p> {{ $posts->created_at->diffForHumans() }}</p>
{{-- Conditional rendering --}}


{{-- @if ($posts->id === 1)
    Post one!
@elseif ($posts->id == 2)
    Post two!
@else
    Something else
@endif --}}
@if ((new Carbon\Carbon())->diffInMinutes($posts->created_at) < 5)
    <strong>New!</strong>
@endif
<h4>Comments</h4>
@forelse ($posts->comment as $commentone)
<p>{{$commentone->content}}</p>
    <p>added- {{ \Carbon\Carbon::now()->diffForHumans() }}</p>


{{-- <p class="text-muted">
    added  {{$commentone->created_at->diffForHumans()}}
</p> --}}

@empty
<p class="text-warning">No Comments yet</p>
@endforelse
@endsection
