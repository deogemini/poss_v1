@extends('layouts.main')

@section('content')

<div class="row">
  <div class="col-md-8" style="margin-bottom: 10px ;">
    <a href="javascript::void()" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#modal-add-role">Add Ward</a>
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
              <th scope="col">Name of Ward</th>
              <th scope="col">Name of District</th>
              <th scope="col">Name of Region</th>
              <th scope="col">Actions</th>
            </tr>
          </thead>
          <tbody>

            @foreach($wards as $ward)
            <tr>
              <td> {{ $loop-> index + 1 }}</td>
              <td>{{ $ward->name }}</td>
              <td>{{ $ward->district->name }}</td>
              <td>{{ $ward->district->region->name ?? '-' }}</td>
              <td>
                <a href="javascript::void()" class="btn btn-xs btn-primary" data-toggle="modal" data-target="#modal-edit-role-{{$ward->id}}">Edit</a>
                <a href="javascript::void()" class="btn btn-danger btn-xs" onclick="if(confirm('Are you sure you want to delete this role ?')){
                              	getElementById('delete-role-{{$ward->id}}').submit()}">Delete</a>
                <form action="/roles/{{$ward->id}}" method="post" style="display: inline-block;" id="delete-role-{{$ward->id}}">
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