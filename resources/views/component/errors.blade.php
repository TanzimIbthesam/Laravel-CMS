@if($errors->any())
<div>
    <ul>

            @foreach($errors->all() as $error)
           <div class="alert alert-danger">
               {{$error}}
           </div>
            @endforeach

    </ul>
</div>
@endif
