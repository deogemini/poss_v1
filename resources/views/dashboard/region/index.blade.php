@extends('layouts.main')

@section('content')

<div class="row">
  <div class="col-md-8" style="margin-bottom: 10px ;">
    <a href="javascript::void()" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#modal-add-level">Add Region</a>
    <a href="javascript::void()" class="btn btn-success btn-xs" data-toggle="modal" data-target="#modal-add-ExcelFile">Upload File</a>
  </div>
</div>
<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-body">

      <table id="example" class="table table-striped table-bordered" style="width:100%">
          <thead>
            <tr>
              <th scope="col">C/N</th>
              <th scope="col">Name</th>
              <th scope="col">Actions</th>
            </tr>
          </thead>
          <tbody>

            @foreach($regions as $region)
            <tr>
              <td> {{ $loop-> index + 1 }}</td>
              <td>{{ $region->name }}</td>
              <td>
                <a href="javascript::void()" class="btn btn-xs btn-primary" data-toggle="modal" data-target="#modal-edit-role-{{$region->id}}">Edit</a>
                <a href="javascript::void()" class="btn btn-danger btn-xs" onclick="if(confirm('Are you sure you want to delete this Region ?')){
                              	getElementById('delete-role-{{$region->id}}').submit()}">Delete</a>
                <form action="/region/{{$region->id}}" method="post" style="display: inline-block;" id="delete-role-{{$region->id}}">
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
 <div class="modal fade" id="modal-edit-role-{{ $region->id }}">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title">Edit Region</h4>
                              </div>
                              <form action="/region/{{ $region->id }}" method="post" role="form">
                                @csrf
                                @method('PATCH')
                                 <div class="modal-body">
                                    @include('dashboard.region.edit')
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
              <th>C/N</th>
              <th>Name of role</th>
              <th>Actions</th>
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
   <div class="modal fade" id="modal-add-level">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Add Region</h4>
                </div>
                <form action="/region" method="post" role="form">
                    @csrf
                    <div class="modal-body">
                        @include('dashboard.region.create')
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
   <div class="modal fade" id="modal-add-ExcelFile">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Add Excel File</h4>
                </div>
                <form action="/addBulkRegions" method="post" role="form" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        @include('dashboard.region.addExcelFile')
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









@endsection

<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
   <script>
       $(document).ready(function() {
           $('#example').DataTable();
       } );
   </script>