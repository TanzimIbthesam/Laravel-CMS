@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-4">
            <img src=""style="width:128px;
            height:128px;" class="img-thumbnail avatar" />
            Hello
        </div>
        <div class="col-8">
            <h3>{{ $user->name }}</h3>
        </div>
    </div>
@endsection
