@foreach($jobs as $j)
<a href="{{asset('jobs/description')}}?job={{base64_encode($j->id)}}" class="col-sm-12 div-job-full-description">
  <div class="card callout callout-warning">
    <div class="card-header">
      <h3 class="text-success">{{$j->job_title}}</h3>
      <h5 class="text-secondary">{{$j->section->station}}</h5>
    </div>
    <div class="card-body">
      <div class="float-sm-right">
        <div class="info-box">
          <span class="info-box-icon bg-info"><i class="far fa-star"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">Salary Grade: {{$j->sg->salary_grade}}</span>
            <span class="info-box-number">Monthly Salary: {{$j->monthly_salary}}</span>
            <span class="info-box-number text-danger">Total Applicants: {{$j->applicants->count()}}</span>
          </div>
        </div>
      </div>
      <label class="text-gray"><i class="fas fa-briefcase"></i> Type of Job: {{$j->typejob()}}</label><br>
      <label class="text-gray"><i class="fas fa-calendar-alt"></i> Term of Employment: {{$j->term()}}</label><br>
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