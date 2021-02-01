@extends('admin/layout')


@section('title')
    Show Exam
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
              <li class="breadcrumb-item active">{{$exam->name()}}</li>
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

<div class="col-md-10 offset-md-1 pb-3">
    <div class="card">

        <div class="card-header">
            <h3 class="card-title">Exam Details</h3>
        </div>

    
     <div class="card-body p-0">

             <table class="table table-sm">

          
            <tr> 
               <th>name_en</th>
                <td>{{$exam->name('en')}}</td>
            </tr>
            <tr> 
                <th>name_ar</th>
                <td>{{$exam->name('ar')}}</td>

             </tr>
             <tr> 
                <th>Desc</th>
                <td>{{ $exam->desc()}}</td>
                
             </tr>
             <tr> 
                 <th>Image</th>
                  <td>
                      <img src="{{asset("uploads/$exam->img")}}" height="50px">
                  </td>
              </tr>
              <tr> 
                <th>Questions Numbers</th>
                <td>{{$exam->questions_no}}</td>
                 
             </tr>
             <tr> 
                 <th>Difficulty</th>
                 <td>{{$exam->difficulty}}</td>

              </tr>
              <tr> 
                 <th>Duration Mins</th>
                 <td>{{$exam->duration_mins}}</td>

              </tr>
              <tr> 
                <th>Skill</th>
                <td>{{$exam->Skill->name()}}</td>
             </tr>
             <tr> 
                <th>Active</th>
                <td>
                    @if($exam->active)
                    <td><span class="badge bg-success">yes</span></td>
                    @else
                    <td><span class="badge bg-danger">No</span></td>
                    @endif  
                
                </td>
             </tr>
              <tr> 
                  <th>Created At</th>
                  <td>{{$exam->created_at}}</td>
               </tr>
              
        </table>

    </div>
    <div class="col-md-6 offset-md-1 pb-3">

        <a href="{{url("dashboard/exams/show/$exam->id/questions")}}" class="btn  btn-sm btn-primary">Show Questions</a>
        <a href="{{ url()->previous() }}" class="btn btn-sm btn-success">Back</a>

    </div>

    </div>
</div>


             
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

 
  @endsection


