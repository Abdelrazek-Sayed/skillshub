@extends('admin/layout')


@section('title')
    Add-Exam
@endsection

@section('content')
    
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">New Exam step-1</h1>
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
            <form method="POST" action="{{url("dashboard/admins/store")}}">
              @csrf
      
      <div class="card-body">
          <div class="row">
              <div class="col-12">
      

      <div class="row">
              <div class="col-6">
                <div class="form-group">
                  <label for="exampleInputEmail1">Name</label>
                  <input type="text" class="form-control" name="name">
                </div>
              </div>

              <div class="col-6">
                <div class="form-group">
                  <label for="exampleInputEmail1">Email</label>
                  <input type="email" class="form-control" name="email">
                </div>
              </div>

              <div class="col-6">
                <div class="form-group">
                  <label for="exampleInputEmail1">password</label>
                  <input type="password" class="form-control" name="password">
                </div>
              </div>

              <div class="col-6">
                <div class="form-group">
                  <label for="exampleInputEmail1">confirm password</label>
                  <input type="password" class="form-control" name="password_confirmation">
                </div>
              </div>

              <div class="col-6">
                <div class="form-group">
                  <label>Role</label>
                  <select name="role_id"  class="custom-select form-control">
                    @foreach ($roles as $role) 
                    <option value="{{$role->id}}">{{$role->name}}</option>
                    @endforeach
                  </select>
              </div>
            </div>
      </div>
       
   
      
       
          </div>
                 
      
          
          <div class="card-footer">
            <button type="submit" class="btn btn-success">Submit</button>
            <a href="{{url()->previous()}}" class="btn btn-primary">Back</a>
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

