@extends('layouts.main')

@section('content')
<?php
$user = Auth::user(); 
$user_id = $user->id;
$role_user = App\Models\RoleUser::where('user_id', $user_id)->first();
$role_name = App\Models\Role::where('id', $role_user->role_id)->first();
$school = App\Models\School_Teachers::where('user_id', $user_id)->first();
$school_id = $school->school_id;
$school =  App\Models\School::where('id', $school_id)->first();
$school_name = $school->name;
$role = $role_name->name;
?>

<div class="row">
  <div class="col-md-8" style="margin-bottom: 10px ;">
    {{-- <a href="javascript::void()" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#modal-add-student">Add Student</a>    --}}
    </div>
</div>
<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-body">

        <table class="table table-striped data-table table-bordered table-hover display" id="example" style="width:100%">
          <thead>
            <tr>
              <th scope="col">C/N</th>
              <th scope="col">Name of Student</th>
              <th scope="col">Gender</th>
              <th scope="col">Stream</th>
              <th scope="col">Class</th>
              <th scope="col">Attendance</th>
              <th scope="col">Actions</th>
            </tr>
          </thead>
          <tbody>

            @foreach($students as $student)
            <tr>
              <td> {{ $loop-> index + 1 }}</td>
              <td>{{ $student->student_name }}</td>
              <td>{{ $student->gender }}</td>
              <td>{{ $student->stream->name }}</td>
              <td>{{ $student->grade }}</td>
              <td>
                <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="radio" class="form-check-input" name="attendance">Absent
                    </label>
                  </div>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="radio" class="form-check-input" name="optradio">Present
                    </label>
                  </div>
                 
            </td>
              <td>
                <a href="javascript::void()" class="btn btn-xs btn-primary" data-toggle="modal" data-target="#modal-edit-student-{{$student->id}}">Edit</a>
                <a href="javascript::void()" class="btn btn-danger btn-xs" onclick="if(confirm('Are you sure you want to delete this role ?')){
                              	getElementById('delete-role-{{$student->id}}').submit()}">Delete</a>
                <form action="/roles/{{$student->id}}" method="post" style="display: inline-block;" id="delete-role-{{$student->id}}">
                  @csrf
                  @method('DELETE')
                </form>

              </td>
            </tr>
            @endforeach
          </tbody>
          <tfoot>
            <tr>
            <th scope="col">C/N</th>
              <th scope="col">Name of Student</th>
              <th scope="col">Gender</th>
              <th scope="col">Stream</th>
              <th scope="col">Class</th>
              <th scope="col">Attendance</th>
              <th scope="col">Actions</th>
            </tr>
          </tfoot>
        </table>
      </div>
    </div>
  </div>
</div>

<!--add modal-->
{{-- <div class="modal fade" id="modal-add-student">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Add Student</h4>
                </div>
                <form action="/studentsinschool" method="post" role="form">
                    @csrf
                    <div class="modal-body">
                        @include('dashboard.student.headMasteraddStudent')
                    </div>
                    <div class="modal-footer">        
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
  </div> --}}

    <div class="modal fade" id="modal-add-excelfile">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Add Excel File</h4>
                </div>
                <form action="/addBulkStudent" method="post" role="form" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        @include('dashboard.student.addStudentinExcell')
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

@endsection

   





<script>
  $(document).ready(function() {
    $('#example').DataTable({
      paging: false,
      ordering: false,
      info: false,
    });
  });
</script>