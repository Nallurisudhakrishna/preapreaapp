
@extends('backend.layouts.app')

@section('headContent')
<!-- iCheck for checkboxes and radio inputs -->
<link rel="stylesheet" href="{{ asset('AdminLTE/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
@endsection

@section('javascriptsContent')

<!-- AdminLTE for demo purposes -->
<script src="{{ asset('AdminLTE/dist/js/demo.js')}}"></script>

<!-- jquery-validation -->
<script src="{{ asset('AdminLTE/plugins/jquery-validation/jquery.validate.min.js')}}"></script>
<script src="{{ asset('AdminLTE/plugins/jquery-validation/additional-methods.min.js')}}"></script>

<script type="text/javascript">
  $(document).ready(function () {

    $.validator.setDefaults({
      submitHandler: function (form) {
        form.submit();
      }
    });
    $('#createQuestion').validate({
      rules: {
        question: {
          required: true
        },
        "option1":{
          required:true,
        },
        "option2":{
          required:true,
        },
        "option3":{
          required:true,
        },
        "option4":{
          required:true,
        },
        level:{
          required:true
        }
      },
      messages: {
        question: {
          required: "Please enter a question"
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
@include('backend.layouts.summerNoteEditor',['height'=>'100'])

@endsection

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Add a new Question</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/admin/home">Home</a></li>
            <li class="breadcrumb-item"><a href="/admin/question/all">questions</a></li>
            <li class="breadcrumb-item active">New</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <form method="post" action="/admin/question/create" id="createQuestion">
      @csrf
      <div class="card card-primary">
        <div class="card-body">
          <div class="row">
            <div class="col-sm-12">
              <div class="form-group">
                <label>Questions</label>
                <textarea name="question" class="textareaLimited" class="form-control" placeholder="Enter ..."></textarea>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <label>Option 1</label>
                <textarea name="option1" class="textareaLimited" class="form-control" placeholder="Enter ..."></textarea>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <label>Option 2</label>
                <textarea name="option2" class="textareaLimited" class="form-control" placeholder="Enter ..."></textarea>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <label>Option 3</label>
                <textarea name="option3" class="textareaLimited" class="form-control" placeholder="Enter ..."></textarea>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <label>Option 4</label>
                <textarea name="option4" class="textareaLimited" class="form-control" placeholder="Enter ..."></textarea>
              </div>
            </div>
            <div class="col-sm-6">
              <label>Level</label>
              <div class="form-group">
                <div class="icheck-success d-inline">
                  <input type="radio" id="radioPrimary1" checked value="easy" name="level">
                  <label for="radioPrimary1">
                    Easy
                  </label>
                </div>
                <div class="icheck-primary d-inline">
                  <input type="radio" id="radioPrimary2" value="medium" name="level">
                  <label for="radioPrimary2">
                    Medium
                  </label>
                </div>
                <div class="icheck-danger d-inline">
                  <input type="radio" id="radioPrimary3" value="hard" name="level">
                  <label for="radioPrimary3">
                    Hard
                  </label>
                </div>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <label>Answer</label>
                <select name="answer" class="form-control">
                  <option value="1">option 1</option>
                  <option value="2">option 2</option>
                  <option value="3">option 3</option>
                  <option value="4">option 4</option>
                </select>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <label>Select Course Type</label>
                <select name="course_id" class="form-control">
                  @foreach ($courses as $course)
                    <option value="{{ $course->id }}">{{ $course->name }}</option>
                  @endforeach
                </select>
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


