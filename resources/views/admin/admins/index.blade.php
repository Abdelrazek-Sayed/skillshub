@extends('admin/layout')


@section('title')
    Admin-admins
@endsection

@section('content')
    
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Admins</h1>

            <a href="{{url("dashboard/admins/create")}}" class="btn btn-success" >
             Add New admin
            </a>

          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('dashboard')}}">{{__('web.home')}}</a></li>
              {{-- <li class="breadcrumb-item"><a href="{{url('dashboard/admins')}}">Admins</a></li> --}}
              {{-- <li class="breadcrumb-item active">Admins</li> --}}
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
                            <th>Role</th>
                            <th>Verified</th>  
                            <th>Actions</th>
                             
                          </tr>
                        </thead>
                        <tbody>
                         @foreach ($admins as $admin) 
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{$admin->name}}</td>
                                <td>{{$admin->email}}</td>
                                <td>{{$admin->role->name}}</td>
                                
                                @if($admin->email_verified_at)
                                <td><span class="badge bg-success">yes</span></td>
                                @else
                                <td><span class="badge bg-danger">No</span></td>
                                @endif

                                <td>
                                    @if($admin->role->name == 'admin')
                                 <a href="{{url("dashboard/admins/promote/$admin->id")}}" class="btn btn-success"> <i class="fas fa-level-up-alt"></i></a>
                                @else
                                
                                <a href="{{url("dashboard/admins/demote/$admin->id")}}" class="btn btn-danger"> <i class="fas fa-level-down-alt"></i></a>
                                  @endif    
                            </td>
                            </tr>

                            @endforeach
                        </tbody>
                      </table>
                            <div class="d-flex my-3 justify-content-center">
                                {{ $admins->links() }}
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


   