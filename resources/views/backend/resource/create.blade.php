
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
        if(confirm("Please Check The content below from the attached Link"))
          form.submit();  
      }
    });
    $('#createResource').validate({
      rules: {
        title: {
          required: true
        },
        link:{
          required:true
        },
        type:{
          required:true
        },
        backImage:{
          required:true
        }
      },
      messages: {
        title: {
          required: "Please enter a title"
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

  var type='video';

  $('input[type=radio][name=type]').change(function() {
    if (this.value == 'video') {
      type='video';
      $('#imageBox').hide();
    }
    else if (this.value == 'theory') {
      type='theory';
      $('#imageBox').show();
    }
    readURL($("input[name='link'"));
  });

  function readURL(input) {
    if(type=='video')
    {
      var url=$(input).val();
      if(url.includes('youtu.be'))
      {
        var result=url.split("/");
        id=result[result.length-1];
        url="https://www.youtube.com/embed/"+id;
        $('#imageBox').hide();
      }
      else if(url.includes('youtube')){
        url=url.replace("watch?v=", "embed/");
        $('#imageBox').hide();
      }
      else{
        $('#imageBox').show();
      }
      $('#showURL').attr('src',url);
    }
    else{
      $('#showURL').attr('src',url);

    }
  }

  function readImageURL(input)
  {
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
          <h1>Add a new resource in {{$topic['name']}}</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/admin/home">Home</a></li>
            <li class="breadcrumb-item"><a href="/admin/topic/{{$topic['course_id']}}">{{$topic['name']}}</a></li>
            <li class="breadcrumb-item active">New</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <form method="post" action="/admin/resource/create/{{$topic['id']}}" id="createResource" enctype="multipart/form-data">
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
                <label>Description</label>
                <input type="text" name="description" class="form-control" placeholder="Enter ...">
              </div>
              <label>Type</label>
              <div class="form-group">
                <div class="icheck-primary d-inline">
                  <input type="radio" id="radioPrimary1" checked value="video" name="type">
                  <label for="radioPrimary1">
                    Video
                  </label>
                </div>
                <div class="icheck-primary d-inline">
                  <input type="radio" id="radioPrimary2" value="theory" name="type">
                  <label for="radioPrimary2">
                    Theory
                  </label>
                </div>
              </div>
              <div class="form-group">
                <label>Link Url</label>
                <input type="text" name="link" onchange="readURL(this)" class="form-control" placeholder="Enter ...">
              </div>
            </div>
            <div class="col-sm-6" id="imageBox" style="display: none;">
              <div class="form-group">
                <label for="exampleInputFile">Background Image</label>
                <div class="input-group">
                  <div class="custom-file">
                    <input type="file" class="custom-file-input" name="backImage" onchange="readImageURL(this)"
                    id="exampleInputFile">
                    <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                  </div>
                  <div class="input-group-append">
                    <span class="input-group-text" id="">Upload</span>
                  </div>
                </div>
              </div>
              <div class="text-center">
                <img src="/defaults/defaultImage.png" id="showImage" alt="" width="auto" height="200">
              </div>
            </div>
          </div>
        </div>    
        <div class="card-footer">
          <button type="submit" class="btn btn-primary float-right">Submit</button>
        </div>
      </div>
    </form>
    <br>
    <h3 style="text-align: center;">Content in Link</h3> 
    <iframe id="showURL" target="_self" width="100%" height="400" src="https://cdn.dribbble.com/users/727458/screenshots/4153279/dribbble-icons.jpg">
    </iframe>
  </section>
</div>

@endsection


