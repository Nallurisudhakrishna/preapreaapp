
@extends('backend.layouts.app')

@section('javascriptsContent')

@include('backend.layouts.datatables')

<script src="https://unpkg.com/ionicons@5.0.0/dist/ionicons.js"></script>

<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<!-- AdminLTE for demo purposes -->
<script src="{{ asset('AdminLTE/dist/js/demo.js')}}"></script>
<!-- page script -->
<script>

  function publishCourse(id,status,element){
    $.ajax({
            url: '{{route("admin.courseTopic.publish")}}',
            method: 'post',
            async:false,
            data: {id:id,status:status,"_token":"{{ csrf_token() }}"},
            success: function (data, status, xhr) {
              if(data.success)
              {
                $(element).text(data.status);
                $(element).toggleClass('badge-success');
                $(element).toggleClass('badge-danger');
              }
              alert(data.message);
            },
            error: function (jqXhr, textStatus, errorMessage) {
                console.log(errorMessage);
                alert("Something Went Wrong Please Try Again After Sometime")
                return false;
            }
        });
  }
  $('.publish').on('click',function(){

      var status=$(this).data('status');
      var id=$(this).data('id');
      if(status=='publish'){
        status='dev';
      }
      else if(status=='dev'){
        status='publish';
      }
      publishCourse(id,status,this)
  });

  $(".deleteButton").on('click',function() {
    var id=$(this).data('id');
    var title=$(this).data('name');
    var courseName=$(this).data('course');
    console.log(courseName);
    $('#deleteTopicCourseName').val(courseName);
    $('#deleteTopicId').val(id);
    $('#deleteTopicTitle').text(title);       
  });

  $("#sortable4").sortable({
    placeholder: 'drop-placeholder',
    items: "li:not(.ui-state-disabled)"
  });

  $(".pin").on('click',function(){
    var id=$(this).data('id');      
    $(this).toggleClass('text-light');
    $(this).toggleClass('text-muted');
    $('#listItem'+id).toggleClass('bg-danger');
    $('#listItem'+id).toggleClass('ui-state-disabled');

  });
</script>

@endsection

@section('headContent')

<style type="text/css">
  .drop-placeholder {
    background-color: lightgray;
    height: 3.5em;
    padding-top: 12px;
    padding-bottom: 12px;
    line-height: 1.2em;
  }
  .publish{
    cursor: pointer;
  }
</style>
@endsection


@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Topics in <b class="text-danger">{{$course['name']}}</b> Course</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/admin/home">Home</a></li>
            <li class="breadcrumb-item active">{{$course['name']}}</li>
            <li class="breadcrumb-item active">topics</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-12">
        <div class="card card-outline card-primary">
          <div class="card-header">
            <h3 class="card-title"><b>See All Topics</b></h3>
            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
              </button>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <a href="/admin/topic/create/{{$course['name']}}"class="btn btn-success mb-3">Create a New Topic</a>
            <button type="button" class="btn btn-danger mb-3 ml-3" data-toggle="modal" data-target="#changeMySequenceModal">Change Sequence</button>
            <a href="/admin/topic/publish/{{$course['id']}}"class="btn btn-primary mb-3 ml-3">Publish all Topics</a>
            <table id="example2" class="table table-bordered table-hover">
              <thead>
                <tr>
                  <th>Id</th>
                  <th>Seq</th>
                  <th>Name</th>
                  <th>Status</th>
                  <th>Action</th>
                  <th>Resources</th>
                </tr>
              </thead>
              <tbody>
                @foreach($courseTopic as $topic)
                <tr>
                  <td><a href ="" >#{{$topic['id']}}</a></td>
                  <td>{{$topic['sequence']}}</td>
                  <td>{{$topic['name']}}</td>
                  @if($topic['status']=='publish')
                  <td><span data-status="{{$topic['status']}}" data-id="{{$topic['id']}}" class="right badge badge-success mr-3 publish">{{$topic['status']}}</a></td>
                  @elseif($topic['status']=='dev')
                  <td><span data-status="{{$topic['status']}}" data-id="{{$topic['id']}}" class="right badge badge-danger mr-3 publish">{{$topic['status']}}</a></td>
                  @endif
                  <td>
                    <a href ="/admin/topic/edit/{{$topic['id']}}" data-toggle="tooltip" title="Edit"  class="mr-3"><i class="far fa-edit text-info"></i></a>
                    <a target="_blank" data-toggle="tooltip" title="View Image" href="/uploads/topics/{{$topic['image_url']}}" class="mr-3"><i class="fas fa-image text-success"></i></a>
                    <a target="_blank" data-toggle="tooltip" title="Add Resource" href ="/admin/resource/create/{{$topic['id']}}" class="mr-3"><i class="fas fa-plus"></i></a>
                    <a target="_blank" data-toggle="tooltip" title="Go to Resources" href ="/admin/resource/all/{{$topic['id']}}" class="mr-3"><ion-icon name="file-tray-stacked" class="text-body"></ion-icon></a>

                    <i data-toggle="modal" data-course="{{$course['name']}}" data-name="{{$topic['name']}}" data-id="{{$topic['id']}}" data-target="#deleteModal" style="cursor: pointer;" class="deleteButton far fa-trash-alt text-danger"></i>
                  </td>
                  <td>
                    <span class="right badge badge-warning">{{$topic['resource_video']}}  V</span>
                    <span class="right badge badge-danger">{{$topic['resource_theory']}} T</span>
                  </td>
                </tr>
                @endforeach
              </tbody>
              <tfoot>

              </tfoot>
            </table>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </section>
  <!-- /.content -->

  <!-- Change Sequence Modal -->

  <!-- Button trigger modal -->

  <!-- Modal -->
  <div class="modal fade" id="changeMySequenceModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
    <div class="modal-dialog"  role="document">
      <div class="modal-content">
       <form action="{{route('admin.courseTopic.sequence')}}" method="post">
        <div class="modal-header">
          @csrf
          <h5 class="modal-title" id="exampleModalScrollableTitle"><b>Change Sequence of Topics</b></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-sm-12" style="height:400px; overflow-y: scroll;">
             <ul id="sortable4" class="list-group list-unstyled">
              @foreach($courseTopic as $topic)
              <li class="list-group-item ui-state-default" id="listItem{{$topic['id']}}" style="cursor: pointer;">
                <input type="hidden" name="id[]" value="{{$topic['id']}}">
                <span><b>{{$topic['sequence']}}</b>. &nbsp</span>
                <span>{{$topic['name']}}</span>
                <span class="float-right"><i class="fas fa-thumbtack pin text-muted"  data-id="{{$topic['id']}}" ></i></span>
              </li>
              @endforeach
            </ul>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
    </form>
  </div>
</div>
</div>



<!-- Delete Modal -->
<!-- Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form method="post" action="/admin/topic/delete">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Are You sure ?</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

          <p>Are you sure you Want to delete <b><span id="deleteTopicTitle"></span></b> </p>
          @csrf
          <input type="hidden" name="courseName" id="deleteTopicCourseName">
          <input type="hidden" name="id" id="deleteTopicId">
          <div class="form-check">
            <input class="form-check-input" name="resourceAlso" checked="checked" type="checkbox" value="1" id="defaultCheck1">
            <label class="form-check-label" for="defaultCheck1">
              Delete Resources Also
            </label>
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-danger">Delete</button>
        </div>
      </div>
    </form>
  </div>
</div>

</div>



@endsection