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
        <h3 class="card-title">MY APPLICATIONS</h3>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <table id="my_jobs_tbl" class="table table-bordered table-hover">
          <thead>
          <tr>
            <th></th>
            <th>JOB TITLE</th>
            <th>APPLIED ON</th>
            <th>DATE CLOSED</th>
            <th>STATUS</th>
            <!-- <th>ACTION</th> -->
          </tr>
          </thead>
          <tbody>
            @if($user->myjobs->where('is_deleted', 0)->isEmpty())
                <tr>
                    <td colspan="6" class="text-center">
                        <em>You have not applied to any jobs.</em>
                    </td>
                </tr>
            @else
                @foreach($user->myjobs->where('is_deleted', 0) as $mj)
                    <tr>
                        <td class="text-center">
                            <div class="btn-group">
                                <button type="button" class="btn btn-upload" data-toggle="modal" data-target="#modal_app_letter" data-id="{{$mj->id}}">Upload Letter of Intent</button>
                                <div class="btn-group mr-2">
                                    <button title="Application history" type="button" class="btn btn-light" data-toggle="dropdown">
                                        <i class="fas fa-history"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        @if($mj->letters->isNotEmpty())
                                            @foreach($mj->letters as $l)
                                                <a class="dropdown-item btn-view-app" href="#" data-id="{{$mj->id}}" data-file="{{$l->file_upload}}" data-user="{{Auth::user()->id}}" data-title="{{$mj->job->job_title}}">
                                                    <i class="fas fa-file-pdf"></i> {{$l->file_name}}
                                                </a>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td>{{$mj->job->job_title}}</td>
                        <td>{{date('F d,Y', strtotime($mj->created_at))}}</td>
                        <td>{{date('F d,Y', strtotime($mj->job->date_closed))}}</td>
                        <td class="text-center">
                            @if($mj->msg->isNotEmpty())
                                {!! $mj->latst->tp() !!}
                            @else
                                <!-- <small class="badge badge-danger" style="cursor: pointer;"><i class="far fa-clock"></i> In review</small> -->
                            @endif
                        </td>
                        <!-- <td class="text-center">
                            <div class="btn-group">
                                <button title="Cancel Application" type="button" class="btn btn-danger" data-toggle="modal" data-target="#cancelModal" data-id="{{$mj->id}}">
                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                </button>
                            </div>
                        </td> -->
                    </tr>
                @endforeach
            @endif
          </tbody>
        </table>
      </div>
      <!-- /.card-body -->
    </div> 
</div>
<div class="modal fade" id="modal_app_letter">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Upload Application Letter</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form id="app_upload" method="POST">
        @csrf
        <div class="form-group">
          <label>File Name</label>
          <input type="text" class="form-control form-control-border" name="file_name" placeholder="File name" required>
        </div>
        <label for="customFile">Upload Application(Max:10mb)<br>Accepted file:.pdf</label>
        <div class="custom-file">
          <input type="hidden" name="app_id" class="app_id">
          <input type="file" class="custom-file-input" id="customFileApp" name="app_letter_name" accept=".pdf" required>
          <label class="custom-file-label" for="customFileApp">Choose file</label>
        </div>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save</button>
      </form>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<div class="modal fade" id="modal-view-app" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title job-title-modal">My application</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <embed id="view-app" frameborder="0" width="100%" height="800px"></embed>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<div class="modal fade" id="modal-track-app" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title job-title-modal">Status</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body track-message-content">
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- Cancel Application Modal -->
<div class="modal fade" id="cancelModal" tabindex="-1" role="dialog" aria-labelledby="cancelModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="cancelModalLabel">Confirm Cancellation</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" style="text-align: left;">
        Are you sure you want to cancel the application? This action cannot be undone.
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-danger" id="confirmCancel">Cancel Application</button>
      </div>
    </div>
  </div>
</div>
@endsection
@section('js')
<script>
	$(function () {
    bsCustomFileInput.init();
		$('#my_jobs_tbl').DataTable({
	      "paging": true,
	      "searching": true,
	      "ordering": true,
	      "info": true,
	      "autoWidth": true,
	      "responsive": true,
	    });
	});
  $('#app_upload').on('submit',function(e){
      var url = "{{ secure_url('/save-app-letter') }}";
      e.preventDefault();
      $(".loading").show();
      $('#app_upload').ajaxSubmit({
          url:  url,
          type: "POST",
          success: function(data){
            setTimeout(function(){
                window.location.reload(false);
            },500);
          },
          error: function (data) {
              $(".loading").hide();
              $.toast({
                  heading: 'Error',
                  text: 'Something went wrong, Please contact administrator',
                  showHideTransition: 'fade',
                  icon: 'error'
              })
          },
      });
  });
  $("#customFileApp").on("change", function (e) {

      if(this.files[0].size > 10097152){
         alert("File is too big!");
         this.value = "";
      }
      if(this.value.split('.').pop() != 'pdf') {
        alert('Invalid Format!')
        this.value = "";
      }

  });
  $('#my_jobs_tbl').on('click', '.btn-upload',function() {
      var id = $(this).attr('data-id');
      $('.app_id').val(id)
  });
  $('#my_jobs_tbl').on('click', '.btn-view-app',function() {
      $('#modal-view-app').modal('show');
      var me =  $(this).attr('data-title');
      var title = "My Application -"+me;
      $('.job-title-modal').html(title)
      var id = $(this).attr('data-id');
      $('.app_id').val(id)
      var user = $(this).attr('data-user');
      var file = $(this).attr('data-file');
      var url = "{{ asset('storage/app/public') }}/"+user+"/"+file; 
      jQuery('embed#view-app').attr('src', url);
  });
  var appid;
  $('#modal-track-app').on('shown.bs.modal', function (e) {
    var url = "{{secure_url('/track-message')}}/"+appid;
    $(".loading").show();
    $.ajax({
        url: url,
        type: 'GET',
        async: false,
        success : function(data){
          $(".loading").hide();
          $('.track-message-content').html(data)
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
  function getAppID(id) {
    appid = id;
  }
  $('button[data-target="#cancelModal"]').on('click', function () {
      var jobId = $(this).data('id'); 
      $('#confirmCancel').data('id', jobId);  
  });
  $(document).ready(function() {
      $('#confirmCancel').on('click', function(e) {
          var id = $(this).data('id');
          var url = "{{ secure_url('/cancel-application') }}";  
          e.preventDefault();  
          $.ajax({
              url: url,
              method: 'POST',
              data: {
                  id: id,  
                  _token: '{{ csrf_token() }}'  
              },
              success: function(response) {
                  $(".loading").hide();  
                  if (response.success) {
                      $.toast({
                          heading: 'Success',
                          text: response.message,  
                          showHideTransition: 'fade',
                          position: 'top-center',  
                          icon: 'success'
                      });
                      setTimeout(function(){
                          window.location.reload(false);  
                      }, 2000);  
                  } else {
                      $.toast({
                          heading: 'Error',
                          text: response.message || 'Something went wrong, Please contact administrator',
                          showHideTransition: 'fade',
                          position: 'top-center',  
                          icon: 'error'
                      });
                  }
              },
          });
      });
  });
</script>
@endsection