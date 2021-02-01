@extends('admin/layout')


@section('title')
    Edit-Question
@endsection

@section('content')
    
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) --> 
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">{{$exam->name()}}</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('dashboard')}}">{{__('web.home')}}</a></li>
              <li class="breadcrumb-item"><a href="{{url('dashboard/exams')}}">{{__('web.exams')}}</a></li>
              <li class="breadcrumb-item active">Edit question</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          

          <div class="col-12 pb-3">
            
            @include('admin.inc.errors')
            <!-- form start -->
    <form method="POST" action="{{url("dashboard/exams/update-question/$exam->id/$ques->id")}}">
              @csrf
      
      <div class="card-body">
      <div class="row">
      <div class="col-12">
          
{{-- @for($i=1;$i<=$questions_no;$i++) --}}
          
    <h5>Question {{$ques->id}}</h5>
      <div class="row">
              <div class="col-6">
                <div class="form-group">
                  <label>Title</label>
                  <input type="text" class="form-control" name="title" value="{{ $ques->title }}">
                </div>
              </div>

              <div class="col-6">
                <div class="form-group">
                  <label>Right Ans</label>
                  <input type="number" class="form-control" name="right_ans" value="{{ $ques->right_ans }}">
                </div>
              </div>

              <div class="col-6">
                <div class="form-group">
                  <label>Option_1</label>
                  <input type="number" class="form-control" name="option_1" value="{{ $ques->option_1 }}">
                </div>
              </div>

              <div class="col-6">
                <div class="form-group">
                  <label>Option_2</label>
                  <input type="number" class="form-control" name="option_2" value="{{ $ques->option_2 }}">
                </div>
              </div>

              <div class="col-6">
                <div class="form-group">
                  <label>Option_3</label>
                  <input type="number" class="form-control" name="option_3" value="{{ $ques->option_3 }}">
                </div>
              </div>

              <div class="col-6">
                <div class="form-group">
                  <label>Option_4</label>
                  <input type="number" class="form-control" name="option_4" value="{{ $ques->option_4 }}">
                </div>
              </div>

            </div>
             <hr>  
{{-- @endfor --}}
<div class="card-footer">
  <button type="submit" class="btn btn-success">Submit</button>
  {{-- <a href="{{url()->previous()}}" class="btn btn-primary">Back</a> --}}
</div>
</div>
</div>
</div>

  </form>

</div>

<!-- /.card -->
</div>
<!-- /.row -->
</div><!-- /.container-fluid -->
</div>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->

@endsection

      
              
       
      
                 
      
          
          
          
          
          
          