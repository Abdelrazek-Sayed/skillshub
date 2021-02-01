@extends('admin/layout')


@section('title')
    Admin-skills
@endsection

@section('content')
    
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">{{__('web.skills')}}</h1>

            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#add-modal">
             Create New Skill
            </button>

          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('dashboard')}}">{{__('web.home')}}</a></li>
              <li class="breadcrumb-item active">{{__('web.skills')}}</li>
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
                            <th>Category</th>
                            <th>Active</th>
                            <th>Actions</th>
                             
                          </tr>
                        </thead>
                        <tbody>
                         @foreach ($skills as $skill) 
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{$skill->name('en')}}</td>
                                <td>{{$skill->name('ar')}}</td>
                                <td>
                                  <img src="{{asset("uploads/$skill->img")}}" height="50px">
                                </td>
                                <td>{{$skill->cat->name('en')}}</td>

                                @if($skill->active)
                                <td><span class="badge bg-success">yes</span></td>
                                @else
                                <td><span class="badge bg-danger">No</span></td>
                                @endif
                                <td>
                                 <button type="button" class="btn btn-info edit-btn"  href="{{url("dashboard/skills/update")}}" 
                                 skill-id="{{$skill->id}}" 
                                 skill-name-en="{{$skill->name('en')}}"  
                                 skill-name-ar="{{$skill->name('ar')}}" 
                                 skil-img = "{{$skill->img}}" 
                                 cat-id="{{$skill->cat_id}}" 
                                 data-toggle="modal" data-target="#edit-modal"> 
                                 <i class="fas fa-edit"></i>
                                </button>
                                 <a href="{{url("dashboard/skills/delete/$skill->id")}}" class="btn btn-danger"> <i class="fas fa-trash"></i></a>
                                 <a href="{{url("dashboard/skills/toggle/$skill->id")}}" class="btn btn-secondry"> <i class="fas fa-toggle-on"></i></a>
                                </td>
                            </tr>

                            @endforeach
                        </tbody>
                      </table>
                            <div class="d-flex my-3 justify-content-center">
                                {{ $skills->links() }}
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



  {{-- modal create skill start --}}
  <div class="modal fade" id="add-modal" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">New Skill</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          @include('admin.inc.errors')
              <!-- form start -->
              <form method="POST" action="{{url('dashboard/skills/store')}}" id="add-form" enctype="multipart/form-data">
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

                  <div class="col-6">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Category</label>
                      <div class="form-group">   
                        <select class="custom-select rounded-0" id="exampleSelectRounded0" name="cat_id">
                          @foreach ($cats as $cat)
                          <option value="{{$cat->id}}">{{$cat->name()}}</option>
                              
                          @endforeach
                        </select>
                      </div>
                    </div>
                  </div>

                  <div class="col-6">
                    <div class="form-group">
                      <label>Image</label>
                      <div class="input-group">
                        <div class="custom-file">
                          <input type="file" class="custom-file-input" name="img">
                          <label class="custom-file-label">Choose file</label>
                        </div>
                      </div>
                    </div>
                  </div>

                 
                
  
                  </div>
                   
               
              </form>
            
            <!-- /.card -->

           
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary" form="add-form">Add Skill </button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>


  {{-- modal update skill start --}}
  <div class="modal fade" id="edit-modal" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Update Skill</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          @include('admin.inc.errors')

              <!-- form start -->
              <form method="POST" action="{{url('dashboard/skills/update')}}" id="edit-form" enctype="multipart/form-data">
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

                  <div class="col-6">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Category</label>
                      <div class="form-group">   
                        <select class="custom-select rounded-0" id="edit-form-cat-id" name="cat_id">
                          @foreach ($cats as $cat)
                          <option value="{{$cat->id}}">{{$cat->name()}}</option>
                              
                          @endforeach
                        </select>
                      </div>
                    </div>
                  </div>

                  <div class="col-6">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Image</label>
                      <br>
                      {{-- <img src="{{asset("uploads/$skill->img")}}" height="50px"> --}}
                      <input type="file" class="form-control"  name="img"  id="edit-form-img">
                    </div>
                  </div>
  
                 


                  </div>
                   
               
              </form>
            
            <!-- /.card -->

           
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary" form="edit-form">Edit the  Skill </button>
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

        let id     =$(this).attr('skill-id')
        let nameEn =$(this).attr('skill-name-en')
        let nameAr =$(this).attr('skill-name-ar')
        let img    =$(this).attr('skill-img')
        let catId  =$(this).attr('cat-id')


        $('#edit-form-id').val(id)
        $('#edit-form-name-en').val(nameEn)
        $('#edit-form-name-ar').val(nameAr)
        // $('#edit-form-img').val(Img)
        $('#edit-form-cat-id').val(catId)

      //  console.log(id,nameEn,nameAr);
      })
      
      </script>  


  @endsection