
@if($errors->any())
<div>
    <ul>

            @foreach($errors->all() as $error)
           <div class="alert alert-danger" style="margin-left:-40px">
               {{$error}}
           </div>
            @endforeach

    </ul>
</div>
@endif
