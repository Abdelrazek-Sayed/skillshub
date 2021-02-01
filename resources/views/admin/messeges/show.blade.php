@extends('admin/layout')


@section('title')
    Admin-messeges
@endsection

@section('content')
    
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">{{$messege->name}}</h1>

            {{-- <a href="{{url("dashboard/messeges/create")}}" class="btn btn-success" >
             Add New messege
            </a> --}}

          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('dashboard')}}">{{__('web.home')}}</a></li>
              <li class="breadcrumb-item"><a href="{{url('dashboard/messeges')}}">Messeges</a></li>
            
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
                        
                        <tbody>
                            <tr>
                                 <th>Name</th>
                                 <td>{{$messege->name}}</td>
                            </tr>

                            <tr>
                                <th>Email</th>
                                <td>{{$messege->email}}</td>
                            </tr>

                            <tr>
                            
                            <th>Subject</th>
                            <td>{{$messege->subject ?? "...."}}</td>
                            </tr>

                            <tr>
                                <th>Body</th>
                                <td>{{$messege->body}}</td>
                            </tr>


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
                  {{-- form         --}}
    <div class="card-body">
        <div class="card-header">
            <h2>Send Response</h2>
        </div>

      <div class="card-body p-0">

            <form method="POST" action="{{url("dashboard/messeges/response/$messege->id")}}">
                @csrf
                @include('admin.inc.errors')

                

    <div class="card-body">
        <div class="row">
            <div class="col-12">
                
<div class="form-body">
    {{-- <div class="col-6"> --}}
      <div class="form-group">
        <label>Title</label>
        <input type="text" class="form-control" name="title">
      </div>
    {{-- </div> --}}
    
    {{-- <div class="col-6"> --}}
        <div class="form-group">
          <label>Body</label>
          <textarea name="body" class="form-control"  rows="12"></textarea>
           
        </div>
      {{-- </div> --}}
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
    </div>
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->



   


  
  @endsection


   