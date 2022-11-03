@extends('layouts.main')

@section('content')

<div class="row">
  <div class="col-md-8" style="margin-bottom: 10px ;">
    <a href="javascript::void()" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#modal-add-teacher">Add Teacher</a>
    <!-- <a href="javascript::void()" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#modal-add-teacher-onduty">Register Teacher on Duty</a> -->
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
              <th scope="col">Name of School teacher</th>
              <th scope="col">Email of School teacher</th>
              <th scope="col">Name of School</th>
              <th scope="col">Name of Ward</th>
              <th scope="col">Name of District</th>
              <th scope="col">Name of Region</th>
              <th scope="col">Actions</th>
            </tr>
          </thead>
          <tbody>

            @foreach($Teachers as $Teacher)
            <tr>
              <td> {{ $loop-> index + 1 }}</td>
              <td>{{ $Teacher->firstname }} {{ $Teacher->lastname }} </td>
              <td>{{ $Teacher->email }}</td>
              @foreach($Teacher->schools as $school)
              <td>{{ $school->name ?? '-' }} {{$school->educationLevel}}</td>
              <td>{{ App\Models\Ward::where('id' , $school->ward_id)->pluck('name')[0] }} </td>
              <td>{{ App\Models\District::where('id' , App\Models\Ward::where('id' , $school->ward_id)->pluck('district_id') )->pluck('name')[0] }} </td>
              <td>{{  App\Models\Region::where('id',  App\Models\District::where('id' , App\Models\Ward::where('id' , $school->ward_id)->pluck('district_id'))->pluck('region_id') )->pluck('name')[0] }} </td>
              @endforeach
           
              <td>
                <a href="javascript::void()" class="btn btn-xs btn-primary" data-toggle="modal" data-target="#modal-edit-teacher-{{$Teacher->id}}">Edit</a>
                <a href="javascript::void()" class="btn btn-danger btn-xs" onclick="if(confirm('Are you sure you want to delete this Teacher ?')){
                              	getElementById('delete-role-{{$Teacher->id}}').submit()}">Delete</a>
                <form action="/teacher/{{$Teacher->id}}" method="post" style="display: inline-block;" id="delete-role-{{$Teacher->id}}">
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
 <div class="modal fade" id="modal-edit-teacher-{{ $Teacher->id }}">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title">Edit Teacher</h4>
                              </div>
                              <form action="/teacher/{{ $Teacher->id }}" method="post" role="form">
                                @csrf
                                @method('PATCH')
                                 <div class="modal-body">
                                    @include('dashboard.teachers.edit')
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
            <th scope="col">Name of School teacher</th>
            <th scope="col">Email of School teacher</th>
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

<div class="modal fade" id="modal-add-teacher">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Add Teacher</h4>
                </div>
                <form action="/teacher" method="post" role="form">
                    @csrf
                    <div class="modal-body">
                        @include('dashboard.teachers.create')
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



    <div class="modal fade" id="modal-add-teacher-onduty">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Add Teacher On Duty</h4>
                </div>
                <form action="/teacheronduty" method="post" role="form">
                    @csrf
                    <div class="modal-body">
                        @include('dashboard.teachers.ondutyTeacher')
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
<script>
         $(document).ready(function() {
        $('.js-example-basic-multiple').select2({
            allowClear: true,
            placeholder: 'Select'
        });
    });
    </script>



@endsection