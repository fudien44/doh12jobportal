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
      <h3 class="card-title">APPLICANTS</h3><br>
      <h3 class="text-success">{{$apps->job_title}} - {{$apps->area_ass}}</h3>
      <div class="customize-input float-right">
          <a href="{{asset('attendance')}}" class=" btn btn-secondary" target="_blank" role="button"><i class="fas fa-file-alt"></i>&nbsp;ATTENDANCE</a>
      </div>
    </div>
    <div class="card-body">
      <table id="applicants_tbl" class="table table-bordered table-hover">
        <thead>
          <tr>
            <th></th>
            <th>Date Submitted</th>
            <th>Surname</th>
            <th>First Name</th>
            <th>Middle Name</th>
            <th>Gender</th>
            <th>Civil Status</th>
            <th>Course/Graduate</th>
            <th>Contact No.</th>
            <th>Email Address</th>
            <th>Residential Address</th>
            <th>Ethnicity</th>
            <th>Solo Parent</th>
            <th>PWD</th>
            <th>Position Applied</th>
            <th>Eligibility</th>
            <th>Remarks</th>
          </tr>
        </thead>
        <tbody>
          @foreach($apps->applicants as $a)
          <tr>
              @php
              $j = $a->applicant->myjobs->where('job_id',$apps->id)->first();
              @endphp
            <td>
              <a class="btn btn-success btn-app-info" data-id="{{$j->id}}" href="#"><i class="fas fa-mail-bulk"></i></a>
              <a class="btn btn-info href-app-profile" data-id="{{$a->id}}" href="#"><i class="fas fa-eye"></i></a>
            </td>
            <td>
              <a href="#" class="text-secondary font-weight-bold btn-app-info" data-id="{{$j->id}}">
                {{$j->job->created_at ? date('m/d/Y h:i a', strtotime($j->created_at)): ''}}
              </a>
            </td>
            <td>
              <a class="text-success font-weight-bold href-app-profile" data-id="{{$a->id}}" href="#">{{$a->applicant->lname}}</a>
            </td>
            <td>
              <a class="text-success font-weight-bold href-app-profile" data-id="{{$a->id}}" href="#">{{$a->applicant->fname}}</a>
            </td>
            <td>
              <a class="text-success font-weight-bold href-app-profile" data-id="{{$a->id}}" href="#">{{$a->applicant->mname}}</a>
            </td>
            <td>{{$a->applicant->profile ? $a->applicant->profile->gnder() : $a->applicant->profile}}</td>
            <td>{{$a->applicant->profile ? $a->applicant->profile->cs() : $a->applicant->profile}}</td>
            <td>{{$a->applicant->profile ? $a->applicant->profile->course : $a->applicant->profile}}</td>
            <td>{{$a->applicant->profile ? $a->applicant->profile->contactno : $a->applicant->profile}}</td>
            <td>{{$a->applicant->profile ? $a->applicant->email : $a->applicant->profile}}</td>
            <td>{{$a->applicant->profile ? $a->applicant->profile->address : $a->applicant->profile}}</td>
            <td>{{$a->applicant->profile ? $a->applicant->profile->ethnicity : $a->applicant->profile}}</td>
            <td>{{$a->applicant->profile ? $a->applicant->profile->solpar() : $a->applicant->profile}}</td>
            <td>{{$a->applicant->profile ? $a->applicant->profile->pwd() : $a->applicant->profile}}</td>
            <td>
              <a href="#" class="text-secondary font-weight-bold btn-app-info" data-id="{{$j->id}}">
                {{$j->job->job_title ?? ''}}
              </a><br>
            </td>

            <td>{{$a->applicant->profile ? $a->applicant->profile->eligibility : ''}}</td>
            <td>{{$j->latst}}</td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
<div class="modal fade" id="modal-view-app-profile" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title job-title-modal">Applicant Profile</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div id="applicant-viewer">
          
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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
        <h4 class="modal-title job-title-modal">Application Details</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div id="application-viewer">
          
        <!-- </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Disqualify</button>
        <button type="button" class="btn btn-success" data-dismiss="modal">Message</button>
      </div> -->
    <!-- </div> -->
    <!-- /.modal-content -->
  <!-- </div> -->
  <!-- /.modal-dialog -->
<!-- </div> -->
@endsection
@section('js')
<script>
  $(function() {
    $('.select2').select2();
    $("#applicants_tbl").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "pagingType": 'simple_numbers', "paging": true,
      "buttons": [{
        extend: 'print',
        exportOptions: {
            columns: ':visible'
        },
      },{
        extend: 'excelHtml5',
        exportOptions: {
            columns: ':visible'
        },
        messageTop: 'Application Electronic Copy of Contract of Service Applicants',
        customize: function(doc) {
          var sheet = doc.xl.worksheets['sheet1.xml'];
            $('c[r=A1] t', sheet).text( 'Department of Health - Center for Health Development SOCCSKSARGEN' ).attr( 's', '2' );
        }    
      },{
        extend: 'pdf',
        exportOptions: {
            columns: ':visible'
        },
      },
      'colvis',],
    }).buttons().container().appendTo('#applicants_tbl_wrapper .col-md-6:eq(0)');
  });
   $('#applicants_tbl').on('click', '.btn-app-info',function() {
      var id = $(this).attr('data-id');
      var url = "{{secure_url('/get-application-letter')}}";
      $.ajax({
          url: url,
          type: 'GET',
          async: false,
          data: {
            id: id
          },
          success : function(data){
            $('#modal-view-app').modal('show');
            $('#application-viewer').html(data)
          },
          error: function (data) {
              $.toast({
                  heading: 'Error',
                  text: 'Something went wrong',
                  showHideTransition: 'fade',
                  position: 'top-center',
                  icon: 'error'
              })
          },
      });
  });
   $('#applicants_tbl').on('click', '.href-app-profile',function() {
      var id = $(this).attr('data-id');
      var url = "{{secure_url('/get-app-profile')}}";
      $.ajax({
          url: url,
          type: 'GET',
          async: false,
          data: {
            id: id
          },
          success : function(data){
            $('#modal-view-app-profile').modal('show');
            $('#applicant-viewer').html(data)
          },
          error: function (data) {
              $.toast({
                  heading: 'Error',
                  text: 'Something went wrong',
                  showHideTransition: 'fade',
                  position: 'top-center',
                  icon: 'error'
              })
          },
      });
  });
</script>
@endsection