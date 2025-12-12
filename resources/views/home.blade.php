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
<div class="container">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <div class="row">
      <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box">
          <span class="info-box-icon bg-info elevation-1"><i class="fas fa-search"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">Still Open</span>
            <span class="info-box-number">
              {{$jobs->count()}}
            </span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->
      <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box mb-3">
          <span class="info-box-icon bg-danger elevation-1"><i class="fab fa-usps"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">Jobs Posted</span>
            <span class="info-box-number">{{$jobsposted->count()}}</span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->

      <!-- fix for small devices only -->
      <div class="clearfix hidden-md-up"></div>

      <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box mb-3">
          <span class="info-box-icon bg-success elevation-1"><i class="far fa-sticky-note"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">Application Submitted</span>
            <span class="info-box-number">{{ $apps->where('is_deleted', 0)->count() }}</span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->
      <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box mb-3">
          <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">Registered Applicants</span>
            <span class="info-box-number">{{$users->count()}}</span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->
    </div>
    <br>
    <div class="form-group">
      <form action="{{asset('/home')}}" method="POST">
        @csrf
        <div class="input-group input-group-lg">
            <input type="search" name="jobs_title" class="form-control form-control-lg job-search" placeholder="Search Jobs..." value="{{Session::get('sjob')}}">
            <div class="input-group-append">
                <button type="submit" class="btn btn-lg btn-default btn-search-engine">
                    <i class="fa fa-search"></i>
                </button>
            </div>
        </div>
      </form>
    </div>
    <div class="row">
      <div class="col-md-3">
        <div class="info-box">

          <div class="info-box-content">
            <span class="info-box-text">Sample Attachments</span>
            <small><a href="{{ asset('public/uploads/pds.xlsx') }}" download="CSC Form 212(Revised 2017) Personal Data Sheet.xlsx">CSC Form 212(Revised 2017) Personal Data Sheet</a></small>
            <small><a href="{{ asset('public/uploads/wes.docx') }}" download="CSC Form 212 Work Experience Sheet">CSC Form 212 Work Experience Sheet</a></small>
          </div>
        </div>
        <a class="info-box @if($sjobtype == '2') bg-success @endif" href="{{asset('/home')}}?type={{base64_encode('2')}}">
          <span class="info-box-icon"><i class="fas fa-user-lock"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">Permanent</span>
            <span class="info-box-number">{{$jobs2type}}</span>
          </div>
        </a>
        <a class="info-box @if($sjobtype == '0') bg-success @endif" href="{{asset('/home')}}?type={{base64_encode('0')}}">
          <span class="info-box-icon"><i class="fas fa-user-clock"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">PS-Contractual</span>
            <span class="info-box-number">{{$jobs0type}}</span>
          </div>
        </a>
        <a class="info-box @if($sjobtype == '1') bg-success @endif" href="{{asset('/home')}}?type={{base64_encode('1')}}">
          <span class="info-box-icon"><i class="fas fa-user-edit"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">Contract of Service</span>
            <span class="info-box-number">{{$jobs1type}}</span>
          </div>
        </a>



        
        <!-- Age -->
        <div class="">
          <div class="card h-100">
            <div class="card-header">
              Age Distribution
            </div>
            <div class="card-body">
              <canvas id="ageChart"></canvas>
            </div>
          </div>
        </div>
        
        <!-- Gender -->
        <div class="">
          <div class="card h-100">
            <div class="card-header">
              Gender Distribution
            </div>
            <div class="card-body">
              <canvas id="genderChart"></canvas>
            </div>
          </div>
        </div>

        <!-- Education -->
        <div class="">
          <div class="card h-100">
            <div class="card-header">Education Level</div>
            <div class="card-body">
              <canvas id="educationChart"></canvas>
            </div>
          </div>
        </div>
        
        <!-- Ethinicity -->
        <div class="">
          <div class="card h-100">
            <div class="card-header">Top Ethnicity Distribution</div>
            <div class="card-body">
              <canvas id="ethnicityChart"></canvas>
            </div>
          </div>
        </div>

        <!-- PWD -->
        <div class="">
          <div class="card h-100">
            <div class="card-header">PWD Status</div>
            <div class="card-body">
              <canvas id="pwdChart"></canvas>
            </div>
          </div>
        </div>
      
        <!-- SOLO parent -->
        <div class="">
          <div class="card h-100">
            <div class="card-header">Solo Parent Status</div>
            <div class="card-body">
              <canvas id="soloChart"></canvas>
            </div>
          </div>
        </div>

        <!-- Religion -->
        <div class="">
          <div class="card h-100">
            <div class="card-header">Top Religion Distribution</div>
            <div class="card-body">
                <canvas id="religionChart"></canvas>
            </div>
          </div>
        </div>
        
        
        


        

        





      </div>
      <div class="col-md-9">
        @foreach($jobs as $j)
        <a href="{{asset('jobs/description')}}?job={{base64_encode($j->id)}}" class="col-sm-12 div-job-full-description">
          <div class="card callout callout-success">
            <div class="card-header">
              <h3 class="text-success">{{$j->job_title}}</h3>
              <h5 class="text-secondary">{{$j->area_ass}}</h5>
            </div>
            <div class="card-body">
              <div class="float-sm-right">
                <div class="info-box">
                  <span class="info-box-icon bg-warning"><i class="fas fa-briefcase"></i></span>

                  <div class="info-box-content">
                    <span class="info-box-text">Salary Grade: {{$j->sg->salary_grade}}</span>
                    <span class="info-box-number">Monthly Salary: {{$j->monthly_salary}}</span>
                    <span class="info-box-number text-danger">Total Applicants: {{$j->applicants->where('is_deleted', 0)->count()}}</span>
                  </div>
                </div>
              </div>
              <label class="text-gray"><i class="fas fa-calendar-alt"></i> Status of Employment: {{$j->term()}}</label><br>
              @if($j->status=='0' || $j->status=='2')
              <label class="text-success"><i class="fas fa-exclamation-circle"></i>Status: {{$j->stat()}}</label><br>
              @elseif($j->status=='1')
              <label class="text-danger"><i class="fas fa-exclamation-circle"></i> Status: {{$j->stat()}}</label><br>
              @elseif($j->status=='3')
              <label class="text-warning"><i class="fas fa-exclamation-circle"></i>Status: {{$j->stat()}}</label><br>
              @endif
              <label class="text-primary">Click for more info <i class="fas fa-arrow-circle-right"></i></label>
            </div>
          </div>
        </a>
        @endforeach
        @if($jobs->count() <= 0)
        <div class="row">
          <div class="col-sm-12">
            <div class="info-box bg-danger">
              <span class="info-box-icon"><i class="fas fa-exclamation-circle"></i></span>

              <div class="info-box-content">
                <span class="info-box-number">NO JOBS FOUND!</span>
              </div>
              <!-- /.info-box-content -->
            </div>
          </div>
        </div>
        @endif
      </div>
    </div>
</div>

@include('scripts.dashboard.dashboard_script')
@endsection

@section('js')
@endsection


