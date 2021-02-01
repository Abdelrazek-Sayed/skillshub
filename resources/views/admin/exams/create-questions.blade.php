@extends('admin/layout')


@section('title')
    Add-Exam/Questions
@endsection

@section('content')
    
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) --> 
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">New Exam step-2</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('dashboard')}}">{{__('web.home')}}</a></li>
              <li class="breadcrumb-item"><a href="{{url('dashboard/exams')}}">{{__('web.exams')}}</a></li>
              <li class="breadcrumb-item active">Starter Page</li>
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
            <form method="POST" action="{{url("dashboard/exams/store-questions/$exam_id")}}">
              @csrf
      
      <div class="card-body">
      <div class="row">
      <div class="col-12">
          
@for($i=1;$i<=$questions_no;$i++)
          
    <h5>Question {{$i}}</h5>
      <div class="row">
              <div class="col-6">
                <div class="form-group">
                  <label>Title</label>
                  <input type="text" class="form-control" name="titles[]">
                </div>
              </div>

              <div class="col-6">
                <div class="form-group">
                  <label>Right Ans</label>
                  <input type="number" class="form-control" name="right_anss[]">
                </div>
              </div>

              <div class="col-6">
                <div class="form-group">
                  <label>Option_1</label>
                  <input type="number" class="form-control" name="option_1s[]">
                </div>
              </div>

              <div class="col-6">
                <div class="form-group">
                  <label>Option_2</label>
                  <input type="number" class="form-control" name="option_2s[]">
                </div>
              </div>

              <div class="col-6">
                <div class="form-group">
                  <label>Option_3</label>
                  <input type="number" class="form-control" name="option_3s[]">
                </div>
              </div>

              <div class="col-6">
                <div class="form-group">
                  <label>Option_4</label>
                  <input type="number" class="form-control" name="option_4s[]">
                </div>
              </div>

            </div>
             <hr>  
@endfor
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


      
              
       
      
                 
      
          
          
          
          
          
          