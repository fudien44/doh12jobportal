@extends('layouts.app')

@section('content')
<span id="particles-js" ></span>
<div class="content-header mt-3">
  <div class="container">
    <div class="row mb-2">
      <div class="col-sm-6">
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<div class="content-header mt-3">
  <div class="container">
    <div class="row mb-2">
      <div class="col-sm-6">
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<div class="container-fluid">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Users</h3>
        <div class="float-sm-right">
          <button type="button" class="btn btn-block btn-success btn-sm" data-toggle="modal" data-target="#modal-user-post"><i class="fas fa-plus"></i> ADD USER</button>
        </div>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <table id="user_tbl" class="table table-bordered table-hover">
          <thead>
          <tr>
            <th width="5%">ACTIONS</th>
            <th>Name</th>
            <th>Level</th>
            <th>Email</th>
            <th>Verified</th>
          </tr>
          </thead>
          <tbody>
          	@forelse($users as $u)
          	<tr>
          		<td>
          			<div class="btn-group">
	                    <button type="button" class="btn dropdown-toggle"
	                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-ellipsis-v"></i>
	                    </button>
	                    <div class="dropdown-menu dropdown-menu-right">
	                        <button class="btn-edit dropdown-item" data-id="{{$u->id}}"><i class="far fa-edit"></i>Edit</button>
	                        <button class="dropdown-item" type="button"><i class="far fa-trash-alt"></i> Delete</button>
	                    </div>
	                </div>
          		</td>
          		<td>{{$u->fname}} {{$u->lname}} {{$u->lname}}</td>
          		<td>{{$u->lvl()}}</td>
          		<td>{{$u->email}}</td>
          		<td>{!! $u->is_verified() !!}</td>
          	</tr>
          	@empty
          	@endforelse
          </tbody>
        </table>
      </div>
      <!-- /.card-body -->
    </div> 
</div>
<div class="modal fade" id="modal-user-post">
  <div class="modal-dialog modal-lg modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">User</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="post_form" method="POST">
          @csrf
          <input type="hidden" name="post_id" value="">
        
      </div>
      <div class="modal-footer justify-content-right">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-success">Save</button>
      </form>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
@endsection
@section('js')
<script>
	$("#user_tbl").DataTable({
          "responsive": true, "lengthChange": false, "autoWidth": false,
          "buttons": [{
            extend: 'print',
            exportOptions: {
                columns: ':visible'
            },
          },{
            extend: 'excel',
            exportOptions: {
                columns: ':visible'
            },
          },{
            extend: 'pdf',
            exportOptions: {
                columns: ':visible'
            },
          },
          'colvis']
        }).buttons().container().appendTo('#user_tbl_wrapper .col-md-6:eq(0)');
	$('#user_tbl').on('click', '.btn-edit',function() {
        var id = $(this).attr('data-id');
        var url = "{{secure_url('/users-edit')}}/"+id;
        $(".loading").show();
        $.ajax({
            url: url,
            type: 'GET',
            async: false,
            success : function(data){
              $(".loading").hide();
              if(data != 'none') {
                var val = JSON.parse(data)
              }
            },
            error: function (data) {
                $(".loading").hide();
                $.toast({
                    heading: 'Error',
                    text: 'Something went wrong, Please contact administrator',
                    showHideTransition: 'fade',
                    position: 'top-center',
                    icon: 'error'
                })
            },
        });
    });
</script>
@endsection