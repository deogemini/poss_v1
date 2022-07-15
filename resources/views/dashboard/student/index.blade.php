@extends('layouts.main')

@section('content')

<div class="row">
  <div class="col-md-8" style="margin-bottom: 10px ;">
    <a href="javascript::void()" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#modal-add-student">Add Student</a>
    <a href="javascript::void()" class="btn btn-success btn-xs" data-toggle="modal" data-target="#modal-add-role">Add Students via Excell File</a>
    <a href="javascript::void()" class="btn btn-info btn-xs" data-toggle="modal" data-target="#modal-add-role">Download Excel file template</a>
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

<!--add modal-->
<div class="modal fade" id="modal-add-student">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Add Student</h4>
                </div>
                <form action="/students" method="post" role="form">
                    @csrf
                    <div class="modal-body">
                        @include('dashboard.student.create')
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
    $('#example').DataTable({
      paging: false,
      ordering: false,
      info: false,
    });
  });
</script>

<script>
  $(document).ready(function(){
    $('#school_id').change(function(){
    var $grade = $('#grade_id');
    $.ajax({
      url: "{{route('grade.gradesinschool')}}",
      data: {
        school_id: $(this).val()
      },
      success: function(data){
        $grade.html('<option value="" selected>Chooseee Grade</option>');
        $.each(data, function(id, value){
          $grade.append('<option value="'+id+'">' +value+'</option>');
        });
      }
    });
    $('#grade_id, #stream_id').val("");
    $('#grade').removeClass('d-none');

  });

  $('#grade_id').change(function(){
    var $stream = $('#stream_id');
    $.ajax({
      url: "{{route('stream.streamsingrade')}}",
      data: {
        grade_id: $(this).val()
      },
      success: function(data){
        $stream.html('<option value="" selected>Choose Stream</option>');
        $.each(data, function(id, value){
          $stream.append('<option value="'+id+'">' +value+'</option>');
        });
      }
    });

    $('#stream').removeClass('d-none');

  });
});
</script>


  

@endsection