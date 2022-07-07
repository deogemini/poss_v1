@extends('layouts.main')

@section('content')

<div class="row">
  <div class="col-md-8" style="margin-bottom: 10px ;">
    <a href="javascript::void()" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#modal-add-role">Add Head Teacher</a>
    <a href="javascript::void()" class="btn btn-success btn-xs" data-toggle="modal" data-target="#modal-add-role">Upload File</a>
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
              <th scope="col">Name of Head teacher</th>
              <th scope="col">Name of School</th>
              <th scope="col">Name of Ward</th>
              <th scope="col">Name of District</th>
              <th scope="col">Name of Region</th>
              <th scope="col">Actions</th>
            </tr>
          </thead>
          <tbody>

            @foreach($headTeachers as $headTeacher)
            <tr>
              <td> {{ $loop-> index + 1 }}</td>
              <td>{{ $headTeacher->firstname }} {{ $headTeacher->lastname }} </td>
              @foreach($headTeacher->schools as $school)
              <td>{{ $school->name ?? '-' }} {{$school->educationLevel}}</td>
              <td>{{ App\Models\Ward::where('id' , $school->ward_id)->pluck('name')[0] }} </td>
              <td>{{ App\Models\District::where('id' , App\Models\Ward::where('id' , $school->ward_id)->pluck('district_id') )->pluck('name')[0] }} </td>
              <td>{{  App\Models\Region::where('id',  App\Models\District::where('id' , App\Models\Ward::where('id' , $school->ward_id)->pluck('district_id'))->pluck('region_id') )->pluck('name')[0] }} </td>
              @endforeach
           
              <td>
                <a href="javascript::void()" class="btn btn-xs btn-primary" data-toggle="modal" data-target="#modal-edit-role-{{$headTeacher->id}}">Edit</a>
                <a href="javascript::void()" class="btn btn-danger btn-xs" onclick="if(confirm('Are you sure you want to delete this role ?')){
                              	getElementById('delete-role-{{$headTeacher->id}}').submit()}">Delete</a>
                <form action="/roles/{{$headTeacher->id}}" method="post" style="display: inline-block;" id="delete-role-{{$headTeacher->id}}">
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
            <th scope="col">Name of Head teacher</th>
              <th scope="col">Name of School</th>
              <th scope="col">Name of Ward</th>
              <th scope="col">Name of District</th>
              <th scope="col">Name of Region</th>
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