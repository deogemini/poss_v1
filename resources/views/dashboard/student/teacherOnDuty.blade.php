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
    <!-- <a href="javascript::void()" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#modal-add-student">Add Teacher On Duuty</a>
    <a href="javascript::void()" class="btn btn-success btn-xs" data-toggle="modal" data-target="#modal-add-excelfile">Upload File</a>
   <a href="/exportStudents" class="btn btn-info btn-xs">Download Excel File</a> -->
   
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
              <th scope="col">Name of Teacher</th>
              <th scope="col">Phone Number</th>
              <th scope="col">Email</th>
              <th scope="col">Actions</th>
            </tr>
          </thead>
          <tbody>

            @foreach($teachers as $teacher)
            <tr>
              <td> {{ $loop-> index + 1 }}</td>
              <td>{{ $teacher->firstname }}  {{ $teacher->lastname }}</td>
              <td>{{ $teacher->phonenumber }}</td>
              <td>{{ $teacher->email }}</td>
              <td>
                <a href="javascript::void()" class="btn btn-xs btn-primary" data-toggle="modal" data-target="#modal-edit-teacher-{{$teacher->id}}">Edit</a>
                <a href="javascript::void()" class="btn btn-danger btn-xs" onclick="if(confirm('Are you sure you want to delete this role ?')){
                              	getElementById('delete-role-{{$teacher->id}}').submit()}">Delete</a>
                <form action="/roles/{{$teacher->id}}" method="post" style="display: inline-block;" id="delete-role-{{$teacher->id}}">
                  @csrf
                  @method('DELETE')
                </form>

              </td>
            </tr>

            
                       
      </div>
    </div>
  </div>
</div>


            <div class="modal fade" id="modal-edit-teacher-{{ $teacher->id }}">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title">Edit Teacher</h4>
                              </div>
                              <form action="/teacher/{{ $teacher->id }}" method="post" role="form">
                                @csrf
                                @method('PATCH')
                                 <div class="modal-body">
                                    @include('dashboard.student.editTOD')
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
            @endforeach
          </tbody>
          <tfoot>
            <tr>
            <th scope="col">C/N</th>
              <th scope="col">Name of Teacher</th>
              <th scope="col">Phone Number</th>
              <th scope="col">Email</th>
              <th scope="col">Actions</th>
            </tr>
          </tfoot>
        </table>
      </div>
    </div>
  </div>
</div>

<!--add modal-->
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

    <script>
  $(document).ready(function() {
    $('#example').DataTable();
  });
</script>
@endsection

   


