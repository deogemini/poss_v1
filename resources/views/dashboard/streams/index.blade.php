@extends('layouts.main')

@section('content')

<div class="row">
  <div class="col-md-8" style="margin-bottom: 10px ;">
    <a href="javascript::void()" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#modal-add-stream">Add Stream</a>
    <a href="javascript::void()" class="btn btn-success btn-xs" data-toggle="modal" data-target="#modal-add-role">Add Schools via Excell File</a>
    <a href="javascript::void()" class="btn btn-info btn-xs" data-toggle="modal" data-target="#modal-add-role">Download the Excel Template</a>
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
              <th scope="col">Name of Stream</th>
              <th scope="col">Name of Grade</th>
              <th scope="col">Name of School</th>
              <th scope="col">Name of Ward</th>
              <th scope="col">Name of District</th>
              <th scope="col">Name of Region</th>
              <th scope="col">Actions</th>
            </tr>
          </thead>
          <tbody>

            @foreach($streams as $stream)
            <tr>
              <td> {{ $loop-> index + 1 }}</td>
              <td>{{ $stream->name }}</td>
              <td>{{ App\Models\Grade::where('id', $stream->grade_id)->pluck('name')[0] ?? '-' }}</td>
              <td>{{ App\Models\School::where('id', App\Models\Grade::where('id', $stream->grade_id)->pluck('school_id'))->pluck('name')[0] ?? '-'}}</td>
              <td>{{ App\Models\Ward::where('id', App\Models\School::where('id', App\Models\Grade::where('id', $stream->grade_id)->pluck('school_id'))->pluck('ward_id'))->pluck('name')[0] ?? '-' }}</td>
              <td>{{ App\Models\District::where('id', App\Models\Ward::where('id',
                                                                                 App\Models\School::where('id' ,
                                                                                 App\Models\Grade::where('id', $stream->grade_id)->pluck('school_id'))->pluck('ward_id'))->pluck('district_id'))->pluck('name')[0] ?? '-'}}</td>
              <td>{{ App\Models\Region::where('id',                             App\Models\District::where('id', 
                                                                                App\Models\Ward::where('id',
                                                                                 App\Models\School::where('id' , 
                                                                                 App\Models\Grade::where('id', $stream->grade_id)->pluck('school_id'))
                                                                                 ->pluck('ward_id'))
                                                                                 ->pluck('district_id'))
                                                                                 ->pluck('region_id'))->pluck('name')[0] ?? '-'}}</td>
              <td> 
                <a href="javascript::void()" class="btn btn-xs btn-primary" data-toggle="modal" data-target="#modal-edit-stream-{{$stream->id}}">Edit</a>
                <a href="javascript::void()" class="btn btn-danger btn-xs" onclick="if(confirm('Are you sure you want to delete this Stream ?')){
                              	getElementById('delete-role-{{$stream->id}}').submit()}">Delete</a>
                <form action="/streams/{{$stream->id}}" method="post" style="display: inline-block;" id="delete-role-{{$stream->id}}">
                  @csrf
                  @method('DELETE')
                </form>

              </td>
            </tr>
      </div>
    </div>
  </div>
</div>


<!--edit modal-->
<div class="modal fade" id="modal-edit-stream-{{ $stream->id }}">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title">Edit School</h4>
                              </div>
                              <form action="/streams/{{ $stream->id }}" method="post" role="form">
                                @csrf
                                @method('PATCH')
                                 <div class="modal-body">
                                    @include('dashboard.streams.edit')
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
                        <!-- /.modal -->
                        @endforeach
          </tbody>
          <tfoot>
            <tr>
            <th scope="col">C/N</th>
              <th scope="col">Name of Stream</th>
              <th scope="col">Name of Grade</th>
              <th scope="col">Name of School</th>
              <th scope="col">Name of Ward</th>
              <th scope="col">Name of District</th>
              <th scope="col">Name of Region</th>
              <th scope="col">Actions</th>
            </tr>
          </tfoot>
        </table>
            </div>
            <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->
    </div>

<div class="modal fade" id="modal-add-stream">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">Add Stream</h4>
            </div>
            <form action="/streams" method="post" role="form">
                @csrf
             <div class="modal-body">
                @include('dashboard.streams.create')
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
      <!-- /.modal -->



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