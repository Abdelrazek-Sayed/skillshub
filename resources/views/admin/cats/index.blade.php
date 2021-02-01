@extends('admin/layout')


@section('title')
    Admin-cats
@endsection

@section('content')
    
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">{{__('web.cats')}}</h1>

            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#add-modal">
             Create New Cat
            </button>

          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('dashboard')}}">{{__('web.home')}}</a></li>
              <li class="breadcrumb-item active">{{__('web.cats')}}</li>
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
                            <th>Active</th>
                            <th>Actions</th>
                             
                          </tr>
                        </thead>
                        <tbody>
                         @foreach ($cats as $cat) 
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{$cat->name('en')}}</td>
                                <td>{{$cat->name('ar')}}</td>
                                @if($cat->active)
                                <td><span class="badge bg-success">yes</span></td>
                                @else
                                <td><span class="badge bg-danger">No</span></td>
                                @endif
                                <td>
                                 <button type="button" class="btn btn-info edit-btn"  href="{{url("dashboard/cats/update")}}" 
                                 cat-id="{{$cat->id}}" cat-name-en="{{$cat->name('en')}}"  cat-name-ar="{{$cat->name('ar')}}" 
                                 data-toggle="modal" data-target="#edit-modal"> 
                                 <i class="fas fa-edit"></i>
                                </button>
                                 <a href="{{url("dashboard/cats/delete/$cat->id")}}" class="btn btn-danger"> <i class="fas fa-trash"></i></a>
                                 <a href="{{url("dashboard/cats/toggle/$cat->id")}}" class="btn btn-secondry"> <i class="fas fa-toggle-on"></i></a>
                                </td>
                            </tr>

                            @endforeach
                        </tbody>
                      </table>
                            <div class="d-flex my-3 justify-content-center">
                                {{ $cats->links() }}
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



  {{-- modal create cat start --}}
  <div class="modal fade" id="add-modal" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">New Cat</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          @include('admin.inc.errors')

              <!-- form start -->
              <form method="POST" action="{{url('dashboard/cats/store')}}" id="add-form" >
                @csrf

                <div class="row">
                  <div class="col-6">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Name (en)</label>
                      <input type="text" class="form-control"  name="name_en">
                    </div>
  
                  </div>
                  <br> <br>
                  <div class="col-6">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Name (ar)</label>
                      <input type="text" class="form-control"  name="name_ar">
                    </div>
                  </div>
                
  
                  </div>
                   
               
              </form>
            
            <!-- /.card -->

           
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary" form="add-form">Add Cat </button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>


  {{-- modal update cat start --}}
  <div class="modal fade" id="edit-modal" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Update Cat</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          @include('admin.inc.errors')

              <!-- form start -->
              <form method="POST" action="{{url('dashboard/cats/update')}}" id="edit-form" e >
                @csrf
                    {{-- sendind id  --}}
                <input type="hidden" name="id"  id="edit-form-id">

                <div class="row">
                  <div class="col-6">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Name (en)</label>
                      <input type="text" class="form-control"  name="name_en"  id="edit-form-name-en">
                    </div>
                  </div>
                  
                  <div class="col-6">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Name (ar)</label>
                      <input type="text" class="form-control"  name="name_ar"  id="edit-form-name-ar">
                    </div>
                  </div>
                
  
                  </div>
                   
               
              </form>
            
            <!-- /.card -->

           
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary" form="edit-form">Edit the  Cat </button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  @endsection


  @section('script')
    <script>
      $('.edit-btn').click(function(){

        let id     =$(this).attr('cat-id')
        let nameEn =$(this).attr('cat-name-en')
        let nameAr =$(this).attr('cat-name-ar')


        $('#edit-form-id').val(id)
        $('#edit-form-name-en').val(nameEn)
        $('#edit-form-name-ar').val(nameAr)

      //  console.log(id,nameEn,nameAr);
      })
      
      </script>  


  @endsection