@extends('admin/layout')


@section('title')
    Student-score
@endsection

@section('content')
    
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">{{ $student->name}}</h1>

            

          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('dashboard')}}">{{__('web.home')}}</a></li>
              <li class="breadcrumb-item"><a href="{{url('dashboard/students')}}">{{__('web.students')}}</a></li>
             
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

      <div class="col-sm-6">
        @include('admin.inc.msg');
      </div>

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
              
              <div class="row">
                <div class="col-12">
                  <div class="card">
                   
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                      <table class="table table-hover text-nowrap">
                        <thead>
                          <tr>
                            <th>ID</th>
                            <th>Exam</th>
                            <th>Score</th>
                            <th>Time (mins)</th>  
                            <th>At</th>  
                            <th>Status</th>
                            <th>Action</th>
                             
                          </tr>
                        </thead>
                        <tbody>
                         @foreach ($exams as $exam) 
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{$exam->name()}}</td>
                                <td>{{$exam->pivot->score}}</td>
                                <td>{{$exam->pivot->time_mins}}</td>
                                <td>{{$exam->pivot->created_at}}</td>
                                <td>{{$exam->pivot->status}}</td>
                                <td>
                                  {{-- <div class="row"> --}}
                                    @if($exam->pivot->status == 'closed')
                                    <a href="{{url("dashboard/students/open-exam/$student->id/$exam->id")}}" 
                                      class="btn btn-success"> <i class="fas fa-lock-open"></i></a>
                                      @else
                                  {{-- @endif 
                                  @if($exam->pivot->status == 'opened') --}}
                                  <a href="{{url("dashboard/students/close-exam/$student->id/$exam->id")}}" 
                                    class="btn btn-danger"> <i class="fas fa-lock"></i></a>
                                @endif 


                                  {{-- </div> --}}
                                </td>
                            </tr>

                            @endforeach
                        </tbody>
                      </table>
                          
                      
                    </div>
                    <!-- /.card-body -->
                  </div>
                  <!-- /.card -->
                </div>
              </div>
 
          </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
    <a href="{{url()->previous()}}" class="btn btn-success" >back</a>
  </div>
  <!-- /.content-wrapper -->



   


  
  @endsection


   