@extends('layouts.main')

@section('content')

<div class="row">
  <div class="col-md-8" style="margin-bottom: 10px ;">
    <a href="javascript::void()" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#modal-add-role">Add Student</a>
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
              <th scope="col">Name of Class</th>
              <th scope="col">Name of School</th>
              <th scope="col">Actions</th>
            </tr>
          </thead>
          <tbody>

            @foreach($students as $student)
            <tr>
              <td> {{ $loop-> index + 1 }}</td>
              <td>{{ $student->student_name }}</td>
              <td>{{ $student->gender }}</td>
              <td>{{ $student->grade->name }}</td>
              <td>{{ $student->grade->school->name }}</td>
              <td>
                <a href="javascript::void()" class="btn btn-xs btn-primary" data-toggle="modal" data-target="#modal-edit-role-{{$student->id}}">Edit</a>
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
              <th scope="col">Name of Class</th>
              <th scope="col">Name of School</th>
              <th scope="col">Actions</th>
            </tr>
          </tfoot>
        </table>




      </div>
    </div>


  </div>



</div>



<script>
  $(document).ready(function() {
    $('#example').DataTable({
      paging: false,
      ordering: false,
      info: false,
    });
  });
</script>



@endsection