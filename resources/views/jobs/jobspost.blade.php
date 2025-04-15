@extends('layouts.app')

@section('content')
<style>
  .select2-container--default .select2-selection--multiple .select2-selection__rendered li {
    color: #285c4d;
  }
</style>
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
        <h3 class="card-title">JOB POSTING</h3>
        @if(Auth::user()->level == 2)
        <div class="float-sm-right">
          <button type="button" class="btn btn-block btn-success btn-sm" data-toggle="modal" data-target="#modal-job-post"><i class="fas fa-plus"></i> ADD JOB</button>
        </div>
        @endif
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <table id="jobs_tbl" class="table table-bordered table-hover">
          <thead>
          <tr>
            <th>ACTIONS</th>
            <th>JOB TITLE</th>
            <th>Place of Assignment</th>
            <th>Status of Employment</th>
            <th>DATE POSTED</th>
            <th>DATE CLOSED</th>
            <th>TOTAL APPLICANTS</th>
            <th>STATUS</th>
          </tr>
          </thead>
          <tbody>
            @foreach($jobs as $j)
            <tr>
              <td>
                <div class="btn-group">
                    <button type="button" class="btn dropdown-toggle"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-ellipsis-v"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="{{asset('/list-applicants')}}?job={{base64_encode($j->id)}}" target="_blank"><i class="fas fa-users"></i>Applicants</a>
                        <a class="dropdown-item" href="{{asset('jobs/description')}}?job={{base64_encode($j->id)}}" data-id="{{$j->id}}"><i class="far fa-eye"></i>View Details/Attachments</a>
                        <button class="btn-edit dropdown-item" data-id="{{$j->id}}"><i class="far fa-edit"></i>Edit</button>
                        <button class="dropdown-item" type="button"><i class="far fa-trash-alt"></i> Delete</button>
                    </div>
                </div>
              </td>
              <td>{{$j->job_title}}</td>
              <td>{{$j->area_ass}}</td>
              <td>{{$j->term()}}</td>
              <td>{{date('m/d/Y',strtotime($j->date_posted))}}</td>
              <td>{{date('m/d/Y',strtotime($j->date_closed))}}</td>
              <td>{{ $j->applicants->count() }}</td>
              <!-- <td>{{ $j->applicants->where('is_deleted', 0)->count() }}</td> -->
              <td>{{$j->stat()}}</td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      <!-- /.card-body -->
    </div> 
</div>
<div class="modal fade" id="modal-job-post">
  <div class="modal-dialog modal-lg modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Job Posting</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="post_form" method="POST">
          @csrf
          <input type="hidden" name="post_id" value="">
        <div class="form-group">
          <label >Job Title</label>
          <input type="text" class="form-control form-control-border" name="job_title" placeholder="Job title" required>
        </div>
        <div class="form-group">
          <label >Area of Assignment</label>
          <input type="text" class="form-control form-control-border" name="area_ass" placeholder="Area of Assignment" required>
        </div>
        <hr>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>Salary Grade</label>
              <select class="form-control-lg select2 salary_grade" name="salary_grade" required>
                <option selected value="">Select Salary Grade</option>
                @foreach($salary as $s)
                <option value="{{$s->id}}">{{$s->salary_grade}}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>Monthly Salary</label>
              <input type="text" class="form-control form-control-border" name="monthly_salary" placeholder="Monthly Salary" >
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>Status of Employment</label>
              <select class="form-control-lg select2 term_emp" name="term_emp" >
                <option selected value="">Select Status of Employment</option>
                <option value="0">PS-Contractual</option>
                <option value="1">Contract of Service/ Job Order</option>
                <option value="2">Plantilla/Permanent</option>
              </select>
            </div>
          </div>
          <div class="if-permanent d-none row">
            <div class="col-md-12"><hr>
              <h5>Minimum Qualifications(Based on CSC Qualification Standards)</h5>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>Education</label>
                <input type="text" class="form-control form-control-border" name="education" placeholder="Education" >
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>Experience</label>
                <input type="text" class="form-control form-control-border" name="experience" placeholder="Experience" >
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>Training</label>
                <input type="text" class="form-control form-control-border" name="training" placeholder="Training" >
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>Eligibility</label>
                <input type="text" class="form-control form-control-border" name="eligibility" placeholder="Eligibility" >
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <label>Additional Requirements(based on DOH-CHD Regional Memorandum No.: 142 s. 2018)</label>
                <input type="text" class="form-control form-control-border" name="add_req" placeholder="Additional Requirements" >
              </div>
            </div>
          </div>
          <div class="col-md-12"><hr></div>
          <div class="col-md-4">
            <div class="form-group">
              <label>Date Posted:</label>
                <input type="text" class="form-control form-control-border datemask date_posted" data-inputmask-alias="datetime" data-inputmask-inputformat="mm/dd/yyyy" data-mask="" inputmode="numeric" name="date_posted" value="{{date('m/d/Y')}}">
              <!-- /.input group -->
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label>Date Closed:</label>
              <input type="text" class="form-control form-control-border datemask" data-inputmask-alias="datetime" data-inputmask-inputformat="mm/dd/yyyy" data-mask name="date_closed">
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label>Status</label>
              <select class="form-control-lg select2 status" name="status" >
                <option value="">Select status</option>
                <option selected value="0">Open</option>
                <option value="1">Closed</option>
                <option value="2">Re-Opened</option>
                <option value="3">Screening</option>
              </select>
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
              <label>Document Reviewer Personnel</label>
              <select class="form-control-lg select2 drp" name="drp[]" multiple >
                <option value="">Select Personnel</option>
                @foreach($us as $u)
                <option value="{{$u->id}}">{{$u->fname}} {{$u->lname}}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="col-md-12">
              <h6 class="card-subtitle req-field">Attachment:</h6>
              <div class="form-group">
                  <div class="input-group">
                    <div class="custom-file">
                      <input type="file" name="attach" class="custom-file-input" accept=".pdf">
                      <label class="custom-file-label" for="upProfile">Choose file</label>
                    </div>
                  </div>
              </div>
          </div>
        </div>
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
        $("#jobs_tbl").DataTable({
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
        }).buttons().container().appendTo('#jobs_tbl_wrapper .col-md-6:eq(0)');
    });
    $( ".division_id" ).change(function() {
        var id = $(this).val();
        var url = "{{ secure_url('/select-section') }}";
        $.ajax({
            async: true,
            url: url,
            type: 'GET',
            data: {
                id: id
            },
            success : function(data){
                $('.section_id').empty();
                var val = JSON.parse(data);
                if(val.length > 0) {
                    $(".section_id").append('<option value="">Select section</option>').change();
                    $.each(val,function(key,value){
                        $('.section_id').append($("<option/>", {
                           value: value.id,
                           text: value.station
                        }));
                    });
                } else {
                    $.toast({
                        heading: 'Error',
                        text: 'No section found',
                        showHideTransition: 'fade',
                        position: 'top-center',
                        icon: 'error'
                    })
                }
            }
        });
    });
    $('#post_form').on('submit',function(e){
        var url = "{{ secure_url('/save-update-job-post') }}";
        e.preventDefault();
        $(".loading").show();
        $('#post_form').ajaxSubmit({
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
    $('#jobs_tbl').on('click', '.btn-edit',function() {
        var id = $(this).attr('data-id');
        var url = "{{secure_url('/jobs-edit')}}/"+id;
        $(".loading").show();
        $.ajax({
            url: url,
            type: 'GET',
            async: false,
            success : function(data){
              $(".loading").hide();
              if(data != 'none') {
                var val = JSON.parse(data)
                var drp = val.drp != null ? val.drp.split(',') : [];
                $('#modal-job-post').modal('show')
                $('input[type=hidden][name=post_id]').val(val.id)
                $('input[type=text][name=education]').val(val.education)
                $('input[type=text][name=area_ass]').val(val.area_ass)
                $('input[type=text][name=job_title]').val(val.job_title)
                $('.jobdesc').summernote("code",val.job_description)
                $(".salary_grade").val(val.salary_grade).change()
                $('input[type=text][name=monthly_salary]').val(val.monthly_salary)
                $('input[type=text][name=eligibility]').val(val.eligibility)
                $('input[type=text][name=monthly_salary]').val(val.monthly_salary)
                $('input[type=text][name=highest_education]').val(val.highest_education)
                $('input[type=text][name=education]').val(val.education)
                $('input[type=text][name=training]').val(val.training)
                $('input[type=text][name=experience]').val(val.experience)
                $('input[type=text][name=date_posted]').val(formatdate(val.date_posted))
                $('input[type=text][name=date_closed]').val(formatdate(val.date_closed))
                $(".status").val(val.status).change()
                $(".type_job").val(val.type_job).change()
                $(".term_emp").val(val.term_emp).change()
                $(".division_id").val(val.division_id).change()
                $('.instruct').summernote("code",val.instruction)
                $('.drp').val(drp).change()

              } else {
                $(".loading").hide();
                $.toast({
                    heading: 'Error',
                    text: 'No Data Found',
                    showHideTransition: 'fade',
                    position: 'top-center',
                    icon: 'error'
                })
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
    $('.term_emp').on('select2:select', function (e) {
        var data = e.params.data.id;
        if(data == 2) {
          $('.if-permanent').removeClass('d-none');
        } else {
          $('.if-permanent').addClass('d-none');
          $('input[type=text][name=eligibility]').val('')
          $('input[type=text][name=education]').val('')
          $('input[type=text][name=training]').val('')
          $('input[type=text][name=experience]').val('')
          $('input[type=text][name=add_req]').val('')
        }
    });
</script>
@endsection