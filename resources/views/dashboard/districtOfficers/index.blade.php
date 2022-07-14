@extends('layouts.main')

@section('content')

<div class="row">
  <div class="col-md-8" style="margin-bottom: 10px ;">
    <a href="javascript::void()" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#modal-add-districtOfficer">Add District Officer</a>
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
              <th scope="col">Name of District Officer</th>
              <th scope="col">Email of District Officer</th>
              <th scope="col">Name of District</th>
              <th scope="col">Name of Region</th>
              <th scope="col">Actions</th>
            </tr>
          </thead>
          <tbody>

            @foreach($districtOfficers as $districtOfficer)
            <tr>
              <td> {{ $loop-> index + 1 }}</td>
              <td>{{ $districtOfficer->firstname }} {{ $districtOfficer->lastname }} </td>
              <td>{{ $districtOfficer->email }}</td>
              @foreach($districtOfficer->districts as $district)
              <td>{{ $district->name ?? '-' }}</td>
              <td>{{ App\Models\Region::where('id',$district->region_id )->pluck('name')[0 ?? '-']}}</td>
              @endforeach
              <td>
                <a href="javascript::void()" class="btn btn-xs btn-primary" data-toggle="modal" data-target="#modal-edit-districtOfficer-{{$districtOfficer->id}}">Edit</a>
                <a href="javascript::void()" class="btn btn-danger btn-xs" onclick="if(confirm('Are you sure you want to delete this District Officer ?')){
                              	getElementById('delete-role-{{$districtOfficer->id}}').submit()}">Delete</a>
                <form action="/districtOfficer/{{$districtOfficer->id}}" method="post" style="display: inline-block;" id="delete-role-{{$districtOfficer->id}}">
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
<div class="modal fade" id="modal-edit-districtOfficer-{{ $districtOfficer->id }}">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title">Edit District Officer</h4>
                              </div>
                              <form action="/districtOfficer/{{ $districtOfficer->id }}" method="post" role="form">
                                @csrf
                                @method('PATCH')
                                 <div class="modal-body">
                                    @include('dashboard.districtOfficers.edit')
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
            <th scope="col">Name of District Officer</th>
            <th scope="col">Email of District Officer</th>
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

   <!--add modal-->
   <div class="modal fade" id="modal-add-districtOfficer">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Add District Officer</h4>
                </div>
                <form action="/districtOfficer" method="post" role="form">
                    @csrf
                    <div class="modal-body">
                        @include('dashboard.districtOfficers.create')
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



@endsection