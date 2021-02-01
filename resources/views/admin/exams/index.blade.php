@extends('admin/layout')


@section('title')
    Admin-Exams
@endsection

@section('content')
    
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">{{__('web.exams')}}</h1>

            <a href="{{url('dashboard/exams/create')}}" class="btn btn-success" >
             Create New Exam
            </a>

          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('dashboard')}}">{{__('web.home')}}</a></li>
              <li class="breadcrumb-item active">{{__('web.exams')}}</li>
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
                            <th>Name (En)</th>
                            <th>Name (En)</th>
                            <th>Img</th>
                            <th>Questions Numbers</th>
                            <th>Skill</th>
                            <th>Active</th>
                            <th>Actions</th>
                           
                             
                          </tr>
                        </thead>
                        <tbody>
                         @foreach ($exams as $exam) 
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{$exam->name('en')}}</td>
                                <td>{{$exam->name('ar')}}</td>
                                <td>
                                    <img src="{{asset("uploads/$exam->img")}}" height="50px">
                                </td>
                                <td>{{$exam->questions_no}}</td>
                               
                                <td>{{$exam->skill->name()}}</td>

                                @if($exam->active)
                                <td><span class="badge bg-success">yes</span></td>
                                @else
                                <td><span class="badge bg-danger">No</span></td>
                                @endif
                                <td>
                                 <a href="{{url("dashboard/exams/show/$exam->id")}}" class="btn btn-success"><i class="fas fa-eye"></i> </a>
                                 <a href="{{url("dashboard/exams/show-questions/$exam->id")}}" class="btn btn-primary"><i class="fas fa-question"></i></a>
                                 <a class="btn btn-info"  href="{{url("dashboard/exams/edit/$exam->id")}}" ><i class="fas fa-edit"></i></a>
                                 <a href="{{url("dashboard/exams/delete/$exam->id")}}" class="btn btn-danger"> <i class="fas fa-trash"></i></a>
                                 <a href="{{url("dashboard/exams/toggle/$exam->id")}}" class="btn btn-secondry"> <i class="fas fa-toggle-on"></i></a>
                                </td>
                            </tr>

                            @endforeach
                        </tbody>
                      </table>
                            <div class="d-flex my-3 justify-content-center">
                                {{ $exams->links() }}
                            </div>
                    
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
  </div>
  <!-- /.content-wrapper -->



 

 

  @endsection


  @section('script')
    <script>
     
      
      
      </script>  


  @endsection