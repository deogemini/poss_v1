@extends('layouts.main')

@section('content')

<div class="row">
  <div class="col-md-8" style="margin-bottom: 10px ;">
    <a href="javascript::void()" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#modal-add-headTeacher">Add Head Teacher</a>
    <!-- <a href="javascript::void()" class="btn btn-success btn-xs" data-toggle="modal" data-target="#modal-add-role">Upload File</a> -->
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
              <th scope="col">Email of Head teacher</th>
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
              <td>{{ $headTeacher->email }}</td>
              @foreach($headTeacher->schools as $school)
              <td>{{ $school->name ?? '-' }} {{$school->educationLevel}}</td>
              <td>{{ App\Models\Ward::where('id' , $school->ward_id)->pluck('name')[0] }} </td>
              <td>{{ App\Models\District::where('id' , App\Models\Ward::where('id' , $school->ward_id)->pluck('district_id') )->pluck('name')[0] }} </td>
              <td>{{  App\Models\Region::where('id',  App\Models\District::where('id' , App\Models\Ward::where('id' , $school->ward_id)->pluck('district_id'))->pluck('region_id') )->pluck('name')[0] }} </td>
              @endforeach
           
              <td>
                <a href="javascript::void()" class="btn btn-xs btn-primary" data-toggle="modal" data-target="#modal-edit-headTeacher-{{$headTeacher->id}}">Edit</a>
                <a href="javascript::void()" class="btn btn-danger btn-xs" onclick="if(confirm('Are you sure you want to delete this head teacher ?')){
                              	getElementById('delete-headTeacher-{{$headTeacher->id}}').submit()}">Delete</a>
                <form action="/headTeacher/{{$headTeacher->id}}" method="post" style="display: inline-block;" id="delete-headTeacher-{{$headTeacher->id}}">
                  @csrf
                  @method('DELETE')
                </form>

              </td>
            </tr>

      </div>
    </div>
  </div>
</div>

<!-- edit modal -->
            <div class="modal fade" id="modal-edit-headTeacher-{{ $headTeacher->id }}">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title">Edit Head Teacher</h4>
                              </div>
                              <form action="/headTeacher/{{ $headTeacher->id }}" method="post" role="form">
                                @csrf
                                @method('PATCH')
                                 <div class="modal-body">
                                    @include('dashboard.headTeachers.edit')
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
            <th scope="col">Name of Head teacher</th>
            <th scope="col">Email of Head teacher</th>
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

 <!--add modal-->
 <div class="modal fade" id="modal-add-headTeacher">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Add Head Teacher</h4>
                </div>
                <form action="/headTeacher" method="post" role="form">
                    @csrf
                    <div class="modal-body">
                        @include('dashboard.headTeachers.create')
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