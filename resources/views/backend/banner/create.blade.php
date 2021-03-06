
@extends('backend.layouts.app')

@section('headContent')
<!-- summernote -->
<link rel="stylesheet" href="{{ asset('AdminLTE/plugins/summernote/summernote-bs4.css')}}">

<!-- iCheck for checkboxes and radio inputs -->
<link rel="stylesheet" href="{{ asset('AdminLTE/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">

@endsection

@section('javascriptsContent')

<!-- AdminLTE for demo purposes -->
<script src="{{ asset('AdminLTE/dist/js/demo.js')}}"></script>
<!-- Summernote -->
<script src="{{ asset('AdminLTE/plugins/summernote/summernote-bs4.min.js')}}"></script>

<!-- jquery-validation -->
<script src="{{ asset('AdminLTE/plugins/jquery-validation/jquery.validate.min.js')}}"></script>
<script src="{{ asset('AdminLTE/plugins/jquery-validation/additional-methods.min.js')}}"></script>
<!-- bs-custom-file-input -->
<script src="{{ asset('AdminLTE/plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>

<script type="text/javascript">
  $(document).ready(function () {

    bsCustomFileInput.init();
    $.validator.setDefaults({
      submitHandler: function (form) {
        form.submit();
      }
    });
    $('#createBanner').validate({
      rules: {
        bannerImage:{
          required:true
        },
        id:{
          required:true
        }

      },
      messages: {
        name: {
          required: "Please enter a name"
        }
      },
      errorElement: 'span',
      errorPlacement: function (error, element) {
        error.addClass('invalid-feedback');
        element.closest('.form-group').append(error);
      },
      highlight: function (element, errorClass, validClass) {
        $(element).addClass('is-invalid');
      },
      unhighlight: function (element, errorClass, validClass) {
        $(element).removeClass('is-invalid');
      }
    });
  });
</script>

<script>

  $( "#screen" ).on('change',function() {
    if($(this).val()=="allProject" || $(this).val()=="allTopic" || $(this).val()=="course")
    {
      $('#screen_id').show();
    }
    else if($(this).val()=="allCourse" || $(this).val()=="feedback" || $(this).val()=="prefrence"){
      $('#screen_id').hide();
    }
  });


 function readURL(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function (e) {
      $('#showImage')
      .attr('src', e.target.result)
    };

    reader.readAsDataURL(input.files[0]);
  }
}
</script>
@endsection

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Add a new Banner</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/admin/home">Home</a></li>
            <li class="breadcrumb-item"><a href="route('admin.banner.show')">Banner</a></li>
            <li class="breadcrumb-item active">New</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <form method="post" action="/admin/banner/create" id="createBanner" enctype="multipart/form-data">
      @csrf
      <div class="card card-primary">
        <div class="card-body">
          <div class="row">
            <div class="col-sm-6">
              <div class="form-group">
                <label>Title</label>
                <input type="text" name="title" class="form-control" placeholder="Enter ...">
              </div>
              <div class="form-group">
                <label for="exampleInputFile">Banner Image</label>
                <div class="input-group">
                  <div class="custom-file">
                    <input type="file" class="custom-file-input" name="bannerImage" onchange="readURL(this)"
                    id="exampleInputFile">
                    <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                  </div>
                  <div class="input-group-append">
                    <span class="input-group-text" id="">Upload</span>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-9">
                 <div class="form-group">
                  <label>Select Screen</label>
                  <select name="screen" id="screen" class="form-control">
                    <option value="allProject">Open All Project Screen</option>
                    <option value="allTopic">Open All Topic Screen</option>
                    <option value="allCourse">Open All course Screen</option>
                    <option value="feedback">Open feedback</option>
                    <option value="prefrence">Open Prefrences</option>
                    <option value="project">project Screen</option>
                  </select>
                </div>
              </div>
              <div class="col-sm-3" id="screen_id" >
                <div class="form-group">
                 <label>Course Id</label>
                 <input type="number" name="id" class="form-control" placeholder="">
               </div>    
             </div>
           </div>

           <div class="form-group">
             <div class="checkbox">
              <label><input type="checkbox" name="publish" value="publish">Publish</label>
            </div>
          </div>

        </div>
        <div class="col-sm-6">
          <div class="text-center">
            <img src="/defaults/defaultImage.png" id="showImage" alt="Girl in a jacket" width="auto" height="300">
          </div>
        </div>
      </div>
    </div>
    <div class="card-footer">
      <button type="submit" class="btn btn-primary float-right">Submit</button>
    </div>
  </div>
</form>
</section>
</div>

@endsection


