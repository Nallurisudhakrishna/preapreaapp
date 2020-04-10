
@extends('backend.layouts.app')

@section('javascriptsContent')

<!-- DataTables -->
<script src="{{ asset('AdminLTE/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{ asset('AdminLTE/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{ asset('AdminLTE/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{ asset('AdminLTE/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<script src="https://unpkg.com/ionicons@5.0.0/dist/ionicons.js"></script>

<!-- AdminLTE for demo purposes -->
<script src="{{ asset('AdminLTE/dist/js/demo.js')}}"></script>
<!-- page script -->
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true,
      "autoWidth": false,
    });
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>

@endsection

@section('headContent')
  
  <!-- DataTables -->
  <link rel="stylesheet" href="{{ asset('AdminLTE/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('AdminLTE/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
  
  
@endsection


@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>List of topics in {{$course['name']}}</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/admin/home">Home</a></li>
              <li class="breadcrumb-item">{{$course['name']}}</li>
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
          <div class="card">
            <div class="card-header">
              <a href="/admin/topic/create/{{$course['name']}}"class="btn btn-success">New</a>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>Id</th>
                  <th>Name</th>
                  <th>Action</th>
                  <th>Resources</th>
                </tr>
                </thead>
                <tbody>
                  @foreach($course['CourseTopic'] as $topic)
                     <tr>
                      <td><a href ="" >#{{$topic['id']}}</a></td>
                      <td>{{$topic['name']}}</td>
                      <td>
                        <a href ="/admin/topic/edit/{{$topic['id']}}" data-toggle="tooltip" title="Edit"  class="mr-3"><i class="far fa-edit text-info"></i></a>
                        <a target="_blank" data-toggle="tooltip" title="View Image" href="/uploads/topics/{{$topic['image_url']}}" class="mr-3"><i class="fas fa-image text-success"></i></a>
                        <a target="_blank" data-toggle="tooltip" title="Add Resource" href ="/admin/resource/create/{{$topic['id']}}" class="mr-3"><i class="fas fa-plus"></i></a>
                        <a target="_blank" data-toggle="tooltip" title="Go to Resources" href ="/admin/resource/all/{{$topic['id']}}" class="mr-3"><ion-icon name="file-tray-stacked" class="text-body"></ion-icon></a>
                        <a href ="" class="mr-3" ><i class="far fa-trash-alt text-danger"></i></a>
                      </td>
                      <td>
                        @php
                          $a=$topic['Resource']->groupBy('type')->toArray();
                        @endphp
                        @isset($a['video'])
                        <span class="right badge badge-warning">{{count($a['video'])}}  V</span>
                        @endisset
                        @isset($a['theory'])
                        <span class="right badge badge-danger">{{count($a['theory'])}} T</span>
                        @endisset
                        
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
  </div>

@endsection