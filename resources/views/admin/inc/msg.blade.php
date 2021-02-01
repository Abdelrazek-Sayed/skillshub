@if (session('msg'))
   <div class="alert alert-success">

       <p>{{ session('msg') }}</p>

   </div>

@endif


@if (session('msg-del'))
<div class="alert alert-danger">

    <p>{{ session('msg-del') }}</p>

</div>

@endif


