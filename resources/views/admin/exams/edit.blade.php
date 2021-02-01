@extends('admin/layout')


@section('title')
    Edit-Exam
@endsection

@section('content')
    
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Edit-Exam step-1</h1>
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
            <form method="POST" action="{{url("dashboard/exams/update/$exam->id")}}" enctype="multipart/form-data">
              @csrf
      
      <div class="card-body">
      <div class="row">
      <div class="col-12">
      

      <div class="row">
              <div class="col-6">
                <div class="form-group">
                  <label for="exampleInputEmail1">Name (en) </label>
                  <input type="text" class="form-control" name="name_en" placeholder="Enter name in english" value="{{$exam->name('en')}}">
                </div>
              </div>
      
              <div class="col-6">
                <div class="form-group">
                  <label for="exampleInputEmail1">الاسم باللغة العربية</label>
                  <input type="text" class="form-control" name="name_ar" placeholder="ادخل اسمك باللغة العربية" value="{{$exam->name('ar')}}">
                </div>
              </div>
      </div>
      
               <div class="form-group">
                 <label>Description (En)</label>
                 <textarea name="desc_en" class="form-control summernote"  rows="5">{{$exam->desc('en')}}</textarea>
               </div>
      
               <div class="form-group">
                <label>الوصف باللغة العربية</label>
                <textarea name="desc_ar" class="form-control summernote"  rows="5">{{$exam->desc('ar')}}</textarea>
              </div>
      
     <div class="row">  
            {{-- <div class="row"> --}}
              <div class="col-6">
                    <div class="form-group">
                      <label>Skills</label>
                      <select name="skill_id"  class="custom-select form-control" id="store-form-skill-id">
                        @foreach ($skills as $skill) 
                        <option value="{{$skill->id}}" @if ($skill->id == $exam->exam_id) selected @endif>{{$skill->name('en')}}</option>
                        @endforeach
                      </select>
                  </div>
                </div>
              
                  <div class="col-6">
                    <div class="form-group">
                      <label>image</label>
                      <div class="input-group">
                        <div class="custom-file">
                          <input type="file" class="custom-file-input" name="img">
                          <label class="custom-file-label">Choose file</label>
                        </div>
                      </div>
      
                    </div>
                  </div>
              {{-- </div> --}}
      
      
              {{--       
                <div class="row d-flex p-2 bd-highlight">
              <div class="col-4">
                <div class="form-group">
                  <label>Questions NO</label>
                  <input type="number" class="form-control" name="questions_no">
                </div>
              </div> --}}
      
              <div class="col-6">
                <div class="form-group">
                  <label>Difficulty</label>
                  <input type="number" class="form-control" name="difficulty" value="{{$exam->difficulty}}">
                </div>
              </div>
      
              <div class="col-6">
                <div class="form-group">
                  <label>Duration (mins)</label>
                  <input type="number" class="form-control" name="duration_mins" value="{{$exam->duration_mins}}">
                </div>
              </div>
            {{-- </div> --}}
          </div>
                 
      
          
          <div class="card-footer">
            <button type="submit" class="btn btn-success">Update</button>
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

<!-- summernote css/js -->

@section('style')
    <!-- include summernote css/js-->
{{-- <link href="{{asset('admin/js/summernote.css')}}"> --}}
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
@endsection



@section('script')
{{-- <script src="{{asset('admin/js/summernote.js')}}"></script> --}}
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>

<script>

$(document).ready(function() {
  $('.summernote').summernote();
});
</script>

@endsection