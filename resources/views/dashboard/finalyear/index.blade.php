@extends('layouts.main')

@section('content')

<div class="row">
  <div class="col-md-8" style="margin-bottom: 10px ;">
    <a href="javascript::void()" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#modal-add-finishingYear">Add Finishing Year</a>
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
              <th scope="col">Year</th>
              <th scope="col">Actions</th>
            </tr>
          </thead>
          <tbody>

            @foreach($finalYears as $finalYear)
            <tr>
              <td> {{ $loop-> index + 1 }}</td>
              <td>{{ $finalYear->year }}</td>
              <td>
                <a href="javascript::void()" class="btn btn-xs btn-primary" data-toggle="modal" data-target="#modal-edit-finishingYear-{{$finalYear->id}}">Edit</a>
                <a href="javascript::void()" class="btn btn-danger btn-xs" onclick="if(confirm('Are you sure you want to delete this final year ?')){
                              	getElementById('delete-role-{{$finalYear->id}}').submit()}">Delete</a>
                <form action="/finalYears/{{$finalYear->id}}" method="post" style="display: inline-block;" id="delete-role-{{$finalYear->id}}">
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
                        <div class="modal fade" id="modal-edit-finishingYear-{{ $finalYear->id }}">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title">Edit District</h4>
                              </div>
                              <form action="/finishingYears/{{ $finalYear->id }}" method="post" role="form">
                                @csrf
                                @method('PATCH')
                                 <div class="modal-body">
                                    @include('dashboard.finalyear.edit')
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
              <th scope="col">Year</th>
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



<div class="modal fade" id="modal-add-finishingYear">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">Add Finishing Year</h4>
            </div>
            <form action="/finishingYears" method="post" role="form">
                @csrf
             <div class="modal-body">
                @include('dashboard.finalyear.create')
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
    $('#example').DataTable();
  });
</script>



@endsection