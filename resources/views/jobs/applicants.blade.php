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
      <h3 class="card-title">APPLICANTS</h3>
    </div>
    <div class="card-body">
      <table id="applicants_tbl" class="table table-bordered table-hover">
        <thead>
          <tr>
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
            <th>Eligibility</th>
            <th>Remarks</th>
          </tr>
        </thead>
        <tbody>
          @foreach($apps as $a)
          <tr>
            <td>
              <a class="text-success font-weight-bold href-app-profile" data-id="{{$a->id}}" href="#">{{$a->lname}}</a>
            </td>
            <td>
              <a class="text-success font-weight-bold href-app-profile" data-id="{{$a->id}}" href="#">{{$a->fname}}</a>
            </td>
            <td>
              <a class="text-success font-weight-bold href-app-profile" data-id="{{$a->id}}" href="#">{{$a->mname}}</a>
            </td>
            <td>{{$a->profile ? $a->profile->gnder() : ''}}</td>
            <td>{{$a->profile ? $a->profile->cs() : ''}}</td>
            <td>{{$a->profile ? $a->profile->course : ''}}</td>
            <td>{{$a->profile ? $a->profile->contactno: ''}}</td>
            <td>{{$a->email}}</td>
            <td>{{$a->profile ? $a->profile->address : ''}}</td>
            <td>{{$a->profile ? $a->profile->ethnicity : ''}}</td>
            <td>{{$a->profile ? $a->profile->solpar() : ''}}</td>
            <td>{{$a->profile ? $a->profile->pwd() : ''}}</td>

            <td>{{$a->profile ? $a->profile->eligibility : ''}}</td>
            <td></td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
<div class="modal fade" id="modal-view-app-profile" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-hidden="true">
  <div class="modal-dialog modal-lg">
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
  $(function () {
      bsCustomFileInput.init();
      $('.summernote').summernote({
        height: 100,
        codemirror: {
          theme: 'paper'
        }
      })
      $('.datemask').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
      $('.select2').select2()
        $("#applicants_tbl").DataTable({
          "responsive": true, "lengthChange": false, "autoWidth": false,
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