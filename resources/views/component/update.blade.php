{{-- <p>
    Added-{{$post->created_at->diffforHumans() }}
    by {{$post->user->name}}
 </p> --}}
{{-- <p>
    {{$slot ?? 'Added'}}{{$date->diffforHumans()}}
    @if(isset($name))
    by {{$name}}
    @endif

 </p> --}}
 <p class="text-muted">
    {{ empty(trim($slot)) ? 'Added ' : $slot }} {{ $date->diffForHumans() }}
    @if(isset($name))
        by {{ $name }}
    @endif
</p>
