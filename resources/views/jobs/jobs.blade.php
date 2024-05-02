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
        <blockquote class="quote-green">
          <h1 class="text-secondary">Jobs - {{$division->description}}</h1>
        </blockquote>
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
        <div class="row">
            <div class="col-md-10 offset-md-1">
                <div class="row">
                    <div class="col-3">
                        <div class="form-group">
                            <label>Section</label>
                            <select class="form-control select2 select-section" style="width: 100%;">
                              <option selected value="">Select Section</option>
                              @foreach($section as $s)
                              <option value="{{$s->id}}">{{$s->station}}</option>
                              @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label>Type of Job</label>
                            <select class="form-control select2 select-job" style="width: 100%;">
                              <option selected value="">Select Type of Job</option>
                              <option value="0">Full-Time</option>
                              <option value="1">Part-Time</option>
                              <option value="2">On-Call</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label>Term of Employment</label>
                            <select class="form-control select2 select-term" style="width: 100%;">
                              <option selected value="">Select Type of Employment</option>
                              <option value="0">Casual</option>
                              <option value="1">Co-terminous</option>
                              <option value="2">Contract of Service</option>
                              <option value="3">Contractual</option>
                              <option value="4">Job Order</option>
                              <option value="5">Permanent</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label>Status</label>
                            <select class="form-control select2 select-status" style="width: 100%;">
                              <option selected value="">Select Status</option>
                              <option value="0">Open</option>
                              <option value="1">Closed</option>
                              <option value="2">Re-Opened</option>
                              <option value="3">Screening</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group input-group-lg">
                        <input type="search" class="form-control form-control-lg job-search" placeholder="Search Jobs..." value="">
                        <div class="input-group-append">
                            <button type="button" class="btn btn-lg btn-default btn-search-engine">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="jobs-body-content" class="col-md-12 justify-content-center">
      <div class="text-center">
          <img src="{{ asset('public/img/load.gif')}}">
          <h3 class="text-primary">Loading Contents. . . . .</h3>
      </div> 
    </div>
  </div>
</div>
@endsection
@section('js')
<script>
  $(function() {
    $('.select2').select2();
    fetchdata();
  });
  $( ".btn-search-engine" ).on( "click", function() {
    fetchdata();
  } );
  function fetchdata() {
    var loading = '<div class="text-center">'+
                '<img src="{{ asset("public/img/load.gif")}}">'+
                '<h3 class="text-primary">Loading Contents. . . . .</h3>'+
            '</div>';
    $('#jobs-body-content').html(loading);
    var url = "{{secure_url('/fetch-jobs')}}";
    $.ajax({
        url: url,
        type: 'GET',
        async: false,
        data: {
          section: $('.select-section').val(),
          typejob: $('.select-job').val(),
          term: $('.select-term').val(),
          status: $('.select-status').val(),
          job: $('.job-search').val()
        },
        success : function(data){
          $('#jobs-body-content').html(data)
        },
        error: function (data) {
            $.toast({
                heading: 'Error',
                text: 'Something went wrong while fetching jobs, Please refresh the page',
                showHideTransition: 'fade',
                position: 'top-center',
                icon: 'error'
            })
        },
    });
  }
</script>
@endsection