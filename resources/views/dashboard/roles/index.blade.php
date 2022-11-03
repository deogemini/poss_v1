@extends('layouts.main')

@section('content')

<div class="row">
  <div class="col-md-8" style="margin-bottom: 10px ;">
    <a href="javascript::void()" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#modal-add-level">Add Roles</a>
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
              <th scope="col">Name of role</th>
              <th scope="col">Actions</th>
            </tr>
          </thead>
          <tbody>

            @foreach($roles as $role)
            <tr>
              <td> {{ $loop-> index + 1 }}</td>
              <td>{{ $role->name }}</td>
              <td>
                <a href="javascript::void()" class="btn btn-xs btn-primary" data-toggle="modal" data-target="#modal-edit-role-{{$role->id}}">Edit</a>
                <a href="javascript::void()" class="btn btn-danger btn-xs" onclick="if(confirm('Are you sure you want to delete this role ?')){
                              	getElementById('delete-role-{{$role->id}}').submit()}">Delete</a>
                <form action="/roles/{{$role->id}}" method="post" style="display: inline-block;" id="delete-role-{{$role->id}}">
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
     <div class="modal fade" id="modal-edit-role-{{ $role->id }}">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title">Edit role</h4>
                              </div>
                              <form action="/roles/{{ $role->id }}" method="post" role="form">
                                @csrf
                                @method('PATCH')
                                 <div class="modal-body">
                                    @include('dashboard.roles.edit')
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
                    <h4 class="modal-title">Add Role</h4>
                </div>
                <form action="/roles" method="post" role="form">
                    @csrf
                    <div class="modal-body">
                        @include('dashboard.roles.create')
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
       } );
   </script>


@endsection

 