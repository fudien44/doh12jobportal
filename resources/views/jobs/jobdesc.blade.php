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
          <li class="breadcrumb-item"><a href="{{asset('/')}}">Home</a></li>
          <li class="breadcrumb-item active">Jobs</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<div class="container">
  <div class="row">
    <div class="col-sm-12">
      <div class="card card-outline card-success">
        <div class="card-header">
          <h3 class="card-title text-gray text-xl font-weight-bold">{{$job->job_title}}</h3>
          <div class="card-tools">
            <a href="{{ url()->previous() }}" class="btn btn-danger"><i class="fas fa-arrow-left"></i> BACK
            </a>
            @if($job->status=='0' || $job->status=='2')
            @if(Auth::user() && Auth::user()->level == 0)
            <a href="{{asset('/jobs/apply/review')}}?job={{base64_encode($job->id)}}" class="btn btn-success">APPLY TO THIS JOB
            </a>
            @elseif(Auth::user() && Auth::user()->level > 0)
            @else
            <a href="{{route('login')}}" class="btn btn-success">LOGIN TO APPLY
            </a>
            @endif
            @endif
          </div>
          <!-- /.card-tools -->
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <label>Area of assignment: {{$job->area_ass}}</label>
          <table class="table table-bordered table-hover">
            <tbody>
              <tr data-widget="expandable-table" aria-expanded="false">
                <td width="20%">Salary Grade: </td>
                <td width="80%"><label>{{$job->sg->salary_grade}}</label></td>
              </tr>
              <tr data-widget="expandable-table" aria-expanded="false">
                <td width="20%">Monthly salary:</td>
                <td width="80%"><label>{{$job->monthly_salary}}</label></td>
              </tr>
              <tr data-widget="expandable-table" aria-expanded="false">
                <td width="20%">Status of Employment: </td>
                <td width="80%"><label>{{$job->term()}}</label></td>
              </tr>
              <tr data-widget="expandable-table" aria-expanded="false">
                <td width="20%">Date Posted: </td>
                <td width="80%"><label>{{date('F d,Y', strtotime($job->date_posted))}}</label></td>
              </tr>
              <tr data-widget="expandable-table" aria-expanded="false">
                <td width="20%">Date Closed:</td>
                <td width="80%"><label>{{date('F d,Y', strtotime($job->date_closed))}}</label></td>
              </tr>
            </tbody>
          </table>
          @if($job->term_emp == '2')
          <label>Minimum Qualifications(Based on CSC Qualification Standards)</label>
          <table class="table table-bordered table-hover">
            <tbody>
              <tr data-widget="expandable-table" aria-expanded="false">
                <td width="20%">Education: </td>
                <td width="80%"><label>{{$job->education}}</label></td>
              </tr>
              <tr data-widget="expandable-table" aria-expanded="false">
                <td width="20%">Experience:</td>
                <td width="80%"><label>{{$job->experience}}</label></td>
              </tr>
              <tr data-widget="expandable-table" aria-expanded="false">
                <td width="20%">Training: </td>
                <td width="80%"><label>{{$job->training}}</label></td>
              </tr>
              <tr data-widget="expandable-table" aria-expanded="false">
                <td width="20%">Eligibility: </td>
                <td width="80%"><label>{{$job->eligibility}}</label></td>
              </tr>
            </tbody>
          </table>
          <label>Additional Requirements(based on DOH-CHD Regional Memorandum No.: 142 s. 2018)</label>
          <table class="table table-bordered table-hover">
            <tbody>
              <tr data-widget="expandable-table" aria-expanded="false">
                <td width="100%">{{$job->add_req}}</td>
              </tr>
            </tbody>
          </table>
          @endif
          <b>Attachment:</b><br>
          <object data="{{ asset('storage/app/public/jobs') }}/{{$job->attach}}" type="application/pdf" width="100%" height="800px">
            <p>Your web browser doesn't have a PDF plugin.
            Instead you can <a download href="{{ asset('storage/app/public/jobs') }}/{{$job->attach}}">click here to
            download the PDF file.</a></p>
          </object>
        </div>
        <!-- /.card-body -->
      </div>
    </div>
  </div>
</div>
@endsection
@section('js')
@endsection