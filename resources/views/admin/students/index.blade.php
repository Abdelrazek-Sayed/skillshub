@extends('admin/layout')


@section('title')
    Admin-students
@endsection

@section('content')
    
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">{{__('web.students')}}</h1>

            {{-- <button type="button" class="btn btn-success" data-toggle="modal" data-target="#add-modal">
             Add New student
            </button> --}}

          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('dashboard')}}">{{__('web.home')}}</a></li>
              <li class="breadcrumb-item active">{{__('web.students')}}</li>
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
                            <th>Name</th>
                            <th>Email</th>
                            <th>Verified</th>  
                            <th>Actions</th>
                             
                          </tr>
                        </thead>
                        <tbody>
                         @foreach ($students as $student) 
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{$student->name}}</td>
                                <td>{{$student->email}}</td>
                                
                                @if($student->email_verified_at)
                                <td><span class="badge bg-success">yes</span></td>
                                @else
                                <td><span class="badge bg-danger">No</span></td>
                                @endif

                                <td>
                                 <a href="{{url("dashboard/students/show-scores/$student->id")}}" class="btn btn-success"> <i class="fas fa-percent"></i></a>
                                </td>
                            </tr>

                            @endforeach
                        </tbody>
                      </table>
                            <div class="d-flex my-3 justify-content-center">
                                {{ $students->links() }}
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


   