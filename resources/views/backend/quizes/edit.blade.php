
@extends('backend.layouts.app')

@section('headContent')

<!-- summernote -->
<link rel="stylesheet" href="{{ asset('AdminLTE/plugins/summernote/summernote-bs4.css')}}">

<!-- iCheck for checkboxes and radio inputs -->
<link rel="stylesheet" href="{{ asset('AdminLTE/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">

<link rel="stylesheet" href="https://code.jquery.com/ui/1.11.0/themes/smoothness/jquery-ui.css">

<style>
  #sortable li{
    padding: 10px;
    color: black;
    cursor: pointer;
    margin-bottom: 2px;
    background: white;
  }   
</style>

@endsection

@section('javascriptsContent')

<!-- AdminLTE for demo purposes -->
<script src="{{ asset('AdminLTE/dist/js/demo.js')}}"></script>
<!-- Summernote -->
<script src="{{ asset('AdminLTE/plugins/summernote/summernote-bs4.min.js')}}"></script>

<script src="https://code.jquery.com/jquery-1.10.2.js"></script>
<script src="https://code.jquery.com/ui/1.11.0/jquery-ui.js"></script>

<!-- jquery-validation -->
<script src="{{ asset('AdminLTE/plugins/jquery-validation/jquery.validate.min.js')}}"></script>
<script src="{{ asset('AdminLTE/plugins/jquery-validation/additional-methods.min.js')}}"></script>

<script type="text/javascript">
  $(document).ready(function () {
    $.validator.setDefaults({
      submitHandler: function (form) {
        if($("input[name='quizQues[]']").length == $("input[name='noOfQues']").val())
        {
          form.submit();
        }
        else{
          alert("Add More Question in the Quiz\n No. of question does not match the actuall questions");
        }
      }
    });
    $('#createQuiz').validate({
      rules: {
        title: {
          required: true
        },
        description:{
          required:true
        },
        noOfQues:{
          required:true
        },
        timeSpan:{
          required:true
        },
        quizTime:{
          required:true
        }  
      },
      messages: {

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

    var quesCount=<?php echo count($livequizques); ?>;
    $("input[name='addQues']").click(function() {
      var max=$("input[name='noOfQues']").val();
      if ($(this).is(':checked')) {
        if(quesCount<max){
          quesCount++;
        }
        else{
          alert("You can not add more than "+max+" questions here\n Please change no of questions above to add more");
          return false;
        }
      }
      else{
        quesCount--;
      }
    });
    // $("tr").click(function(){
    //     var max=$("input[name='noOfQues']").val();
    //     var quesId=$(this).data('id');
    //     // $("#checkbox"+quesId).prop("checked")
    //     $("#checkbox"+quesId).prop("checked",!$("#checkbox"+quesId).prop("checked"));
    // });
    $("#addtoquizbtn").click(function(){
      $('#sortable').empty();
      $.each($("input[name='addQues']:checked"), function(){
        var quesId=$(this).val();
        var quesName=$(this).data('ques');
        $("#sortable").append(`<li class="ui-state-default">${quesName}<input type="hidden" name="quizQues[]" value="${quesId}"></li>`); 
      });
    });
  });
</script>

<script>
  $(function () {
    $( "#sortable" ).sortable();
    $( "#sortable" ).disableSelection();
  })
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
          <h1>Add a new Quiz</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/admin/home">Home</a></li>
            <li class="breadcrumb-item active">Add Quiz</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <form method="post" action="/admin/quiz/edit/{{$livequiz['id']}}" id="createQuiz">
      @csrf
      <div class="card card-primary">
        <div class="card-body">
          <div class="row">
            <div class="col-sm-12">
              <div class="form-group">
                <label>Title</label>
                <input type="text" name="title" value="{{$livequiz['quiz_title']}}" class="form-control" placeholder="Enter ...">
              </div>
            </div>
            <div class="col-sm-12">
              <div class="form-group">
                <label>Description</label>
                <input type="text" name="description" value="{{$livequiz['quiz_desc']}}" class="form-control" placeholder="Enter ...">
              </div>
            </div>

            <div class="col-sm-4">
              <div class="form-group">
                <label>No. of Questions</label>
                <input type="number" value="{{$livequiz['no_of_ques']}}" max=50 min=1 name="noOfQues" class="form-control" placeholder="Enter ...">
              </div>
            </div>
            <div class="col-sm-4">
              <div class="form-group">
                <label>Time Span (In Sec)</label>
                <input type="number" name="timeSpan" value="{{$livequiz['ques_time_span']}}" min=10 max=120 class="form-control" placeholder="Enter ...">
              </div>
            </div>
            <div class="col-sm-4">
              <div class="form-group">
                <label>Start Date and Time</label>
                <input type="datetime-local" value="<?php echo date("Y-m-d\TH:i:s", strtotime($livequiz['start_time'])); ?>" class="form-control" name="quizTime">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12">
              <div class="form-group">
                <h4 class="text-center mt-5 mb-3"><b>QUESTIONS</b></h4>
                <ol id="sortable">
                  @foreach($livequizques as $ques)
                  <li class="ui-state-default">{{$ques['question']['question']}}<input type="hidden" name="quizQues[]" value="{{$ques['question']['id']}}"></li>
                  @endforeach
                </ol>
              </div>
              <!-- /.form-group -->
            </div>
            <!-- /.col -->
          </div>
        </div>
        <div class="card-footer">
          <button type="submit" class="btn btn-primary float-right">Submit</button>
        </div>
      </div>
    </form>
    <div class="card card-info">
      <div class="card-header">
        <h3 class="card-title">Add Questions to quiz</h3>
        <div class="card-tools">
          <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
        </div>
      </div>
      <div class="card-body">
        <div class="row" style="max-height: 500px;overflow: scroll;">
          <table id="example2" class="table table-bordered table-hover">
            <thead>
              <tr>
                <th>Select</th>
                <th>Id</th>
                <th>Question</th>
                <th>Level</th>
                <th>Already In</th>
                <th>Type</th>    
                <th>Action</th>              
              </tr>
            </thead>
            <tbody>
              @foreach($questions as $question)
              <tr data-id="{{$question['id']}}">
                <td>
                 <div class="custom-control custom-checkbox">
                  @foreach($livequizques as $ques)
                  @if($ques['question_id']==$question['id'])
                  <input class="custom-control-input" type="checkbox" name="addQues" id="checkbox{{$question['id']}}" checked data-ques="{{$question['question']}}" value="{{$question['id']}}">
                  @else
                  <input class="custom-control-input" type="checkbox" name="addQues" id="checkbox{{$question['id']}}" data-ques="{{$question['question']}}" value="{{$question['id']}}">
                  @endif
                  @endforeach
                  <label for="checkbox{{$question['id']}}" class="custom-control-label"/>
                </div>
              </td>
              <td>#{{$question['id']}}</td>
              <td>{{$question['question']}}</td>
              @if($question['ques_level']=='easy')
              <td><span class="right badge badge-success">E</span></td>
              @elseif($question['ques_level']=='medium')
              <td><span class="right badge badge-primary">M</span></td>
              @else
              <td><span class="right badge badge-danger">H</span></td>
              @endif     

              <td>  
                @isset($question['live_quiz_ques'])
                  @foreach($question['live_quiz_ques'] as $live_quiz)
                  <span class="right badge badge-warning">#{{$live_quiz['live_quiz_id']}}</span>
                  @endforeach
                @endisset
              </td>

              <td>{{$question['ques_type']}}</td>
              <td><a target="_blank" href="/admin/question/{{$question['id']}}"><span class="right badge badge-info">view</span></a></td>
              <!-- <td><a href ="/admin/question/edit/{{$question['id']}}" class="mr-3"><i class="far fa-edit text-info"></i></a><a href ="" ><i class="far fa-trash-alt text-danger"></i></a></td> -->
            </tr>
            @endforeach
          </tbody>
          <tfoot>

          </tfoot>
        </table>
      </div>
    </div>
    <div class="card-footer">
      <button class="btn btn-primary float-right" id="addtoquizbtn">Add to quiz</button>
    </div>
  </div>
</section>
</div>

@endsection


