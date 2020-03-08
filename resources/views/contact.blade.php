@extends('layouts.app')
@section('content')
<h1>Hi hello</h1>
@can('home.secret')
<p>No details yet</p>
<a href="{{route('secret')}}" target="_blank">Sepcial Contact Details</a>
@endcan
@endsection





