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
  <div class="row">
    <div class="col-md-4">

      <!-- Profile Image -->
      <div class="card card-primary card-outline">
        <div class="card-body box-profile">
          <div class="text-center">
            @if($users->profile && $users->profile->picture_link)
            <img src="{{ asset('storage/app/public')}}/{{$users->id}}/{{$users->profile->picture_link}}" alt="photo will appear here" class="rounded-circle profile-picture" width="160" />
            @else
            <img src="{{ asset('public/img/profile.png') }}" alt="user" class="rounded-circle profile-picture" width="160">
            @endif
          </div>

          <h3 class="profile-username text-center">{{$users->fname}} {{$users->mname}} {{$users->lname}}</h3>

          <p class="text-muted text-center">Applicant</p>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->

      <!-- About Me Box -->
      <div class="card card-primary collapsed-card">
        <div class="card-header">
          <h3 class="card-title">Personal Information</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i>
            </button>
          </div>
          <!-- /.card-tools -->
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <div class="row" style="pointer-events: none;">
            <div class="col-sm-12">
                <h6 class="card-subtitle req-field">First name:</h6>
                <div class="form-group">
                    <input type="text" class="form-control form-control-border required" name="fname" value="{{$users->fname}}">
                </div>
            </div>
            <div class="col-sm-12">
                <h6 class="card-subtitle req-field">Middle name:</h6>
                <div class="form-group">
                    <input type="text" class="form-control form-control-border required" name="mname" value="{{$users->mname}}">
                </div>
            </div>
            <div class="col-sm-12">
                <h6 class="card-subtitle req-field">Last name:</h6>
                <div class="form-group">
                    <input type="text" class="form-control form-control-border required" name="lname" value="{{$users->lname}}">
                </div>
            </div>
            <div class="col-md-12">
                <h6 class="card-subtitle req-field">Extension:</h6>
                <div class="form-group">
                    <input type="text" class="form-control form-control-border required" name="extension" value="{{$profile->extension}}">
                </div>
            </div>
            <div class="col-md-12">
                <h6 class="card-subtitle req-field">Date of Birth:</h6>
                <div class="form-group">
                    <input type="date"class="form-control form-control-border" id="dob" name="dob" value="{{$profile->dob}}" required>
                </div>
            </div>
          </div>
          <div class="row" style="pointer-events: none;">
            <div class="col-md-12">
                <h6 class="card-subtitle req-field">Age:</h6>
                <input type="text" class="form-control form-control-border required" disabled id="age" name="age">
            </div>
            <div class="col-md-12">
              <h6 class="card-subtitle req-field">Gender:</h6>
              <select class="form-control form-control-border gender" name="gender">
                <option selected value="">Select Gender</option>
                <option value="0">Male</option>
                <option value="1">Female</option>
                <option value="2">Transgender</option>
                <option value="3">Two-Spirit</option>
                <option value="4">Cisgender</option>
                <option value="5">Non-binary</option>
                <option value="6">Genderqueer</option>
                <option value="7">Gender expression</option>
                <option value="8">Gender fluid</option>
                <option value="9">Gender neutral</option>
                <option value="10">Prefer Not to Say</option>
              </select>
            </div>
            <div class="col-md-12">
                <h6 class="card-subtitle req-field">Ethnicity:</h6>
                <div class="form-group">
                    <input type="text" class="form-control form-control-border required" name="ethnicity" value="{{$profile->ethnicity}}">
                </div>
            </div>
          </div>
          <div class="row" style="pointer-events: none;">
            <div class="col-md-12">
                <h6 class="card-subtitle req-field">Religion:</h6>
                  <select class="form-control form-control-border religion" name="religion">
                    <option selected value="">Select Religion</option>
                    <option value="AGLIP">AGLIPAY</option><option value="ALLY">ALLIANCE OF BIBLE CHRISTIAN COMMUNITIES</option><option value="ANGLI">ANGLICAN</option><option value="BAPTI">BAPTIST</option><option value="BRNAG">BORN AGAIN CHRISTIAN</option><option value="BUDDH">BUDDHISM</option><option value="CATHO">CATHOLIC</option><option value="XTIAN">CHRISTIAN</option><option value="CHOG">CHURCH OF GOD</option><option value="EVANG">EVANGELICAL</option><option value="IGNIK">IGLESIA NI CRISTO</option><option value="MUSLI">ISLAM</option><option value="JEWIT">JEHOVAHS WITNESS</option><option value="MORMO">LDS-MORMONS</option><option value="LRCM">LIFE RENEWAL CHRISTIAN MINISTRY</option><option value="LUTHR">LUTHERAN</option><option value="METOD">METHODIST</option><option value="PENTE">PENTECOSTAL</option><option value="PROTE">PROTESTANT</option><option value="SVDAY">SEVENTH DAY ADVENTIST</option><option value="UCCP">UCCP</option><option value="UNKNO">UNKNOWN</option><option value="WESLY">WESLEYAN</option>
                  </select>
            </div>
            <div class="col-sm-12">
                <h6 class="card-subtitle req-field">Civil Status:</h6>
                  <select class="form-control form-control-border civilstat" name="civilstat">
                    <option selected value="">Select Status</option>
                    <option value="0">Single</option>
                    <option value="1">Married</option>
                    <option value="2">Separated</option>
                    <option value="3">Widowed</option>
                    <option value="4">Other</option>
                  </select>
            </div>
          </div>
        </div>
        <!-- /.card-body -->
      </div>
      <div class="card card-primary collapsed-card">
        <div class="card-header">
          <h3 class="card-title">Contact</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i>
            </button>
          </div>
          <!-- /.card-tools -->
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <div class="row" style="pointer-events: none;">
            <div class="col-md-12">
                <h6 class="card-subtitle req-field">Address:</h6>
                <div class="form-group">
                    <textarea class="form-control form-control-border required" name="address" rows="2">{{$profile->address}}</textarea>
                </div>
            </div>
            <div class="col-md-12">
                <h6 class="card-subtitle req-field">Contact Number:</h6>
                <div class="form-group">
                    <input type="text" class="form-control form-control-border required" name="contactno" value="{{$users->contactno}}">
                </div>
            </div>
            <div class="col-md-12">
                <h6 class="card-subtitle req-field">Email Address:</h6>
                <div class="form-group">
                    <input type="email" class="form-control form-control-border required" name="email" value="{{$users->email}}">
                </div>
            </div>
          </div>
        </div>
        <!-- /.card-body -->
      </div>
      <div class="card card-primary collapsed-card">
        <div class="card-header">
          <h3 class="card-title">Education</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i>
            </button>
          </div>
          <!-- /.card-tools -->
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <div class="row" style="pointer-events: none;">
            <div class="col-md-12">
                <h6 class="card-subtitle req-field">Highest Educational Attainment:</h6>
                <select class="form-control form-control-border civilstat" name="highest_education">
                  <option selected value="">Select</option>
                  <option value="0">N/A</option>
                  <option value="1">Vocational/Trade Course</option>
                  <option value="2">College</option>
                  <option value="3">Graduate Studies</option>
                </select>
            </div>
            <div class="col-md-12">
                <h6 class="card-subtitle req-field">Course Title:</h6>
                <div class="form-group">
                    <input type="text" class="form-control form-control-border required" name="course" value="{{$profile->course}}">
                </div>
            </div>
            <div class="col-sm-12">
                <h6 class="card-subtitle req-field">Name Of School/University:</h6>
                <div class="form-group">
                    <input type="text" class="form-control form-control-border required" name="school" value="{{$profile->school}}">
                </div>
            </div>
            <div class="col-sm-12">
                <h6 class="card-subtitle req-field">Eligibility/License/Honor Graduate (If Applicable):</h6>
                <div class="form-group">
                    <input type="text" class="form-control form-control-border required" name="eligibility" value="{{$profile->eligibility}}">
                </div>
            </div>
          </div>
        </div>
        <!-- /.card-body -->
      </div>
      <div class="card card-primary collapsed-card">
        <div class="card-header">
          <h3 class="card-title">Other Information</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i>
            </button>
          </div>
          <!-- /.card-tools -->
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <div class="row" style="pointer-events: none;">
             <div class="col-sm-12">
                 <h6 class="card-subtitle req-field">PWD:</h6>
                <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="is_pwd"value="1" onchange="stat(1)" @if($profile->is_pwd == '1')checked @endif>
                        <label class="form-check-label">No</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="is_pwd"value="0" onchange="stat(0)" @if($profile->is_pwd == '0')checked @endif>
                        <label class="form-check-label">Yes</label>
                    </div>
                    <div class="form-group" id="status">
                    <input type="text" class="form-control form-control-border required" name="pwd_no" placeholder="Please Specify I.D. No." value="{{$profile->pwd_no}}">
                </div>
             </div>
             <div class="col-md-12">
                 <h6 class="card-subtitle req-field">Solo Parent</h6>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="is_solpar"value="1"onchange="solo(1)"@if($profile->is_solpar == '1')checked @endif>
                    <label class="form-check-label">No</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="is_solpar"value="0"onchange="solo(0)"@if($profile->is_solpar == '0')checked @endif>
                    <label class="form-check-label">Yes</label>
                </div>
                <div class="form-group" id="solopar">
                    <input type="text" class="form-control form-control-border required" name="soloparent_no" placeholder="Please Specify I.D. No." value="{{$profile->soloparent_no}}">
                </div>
             </div>
          </div>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
    <!-- /.col -->
    <div class="col-md-8">
      <div class="card">
        <div class="card-header p-2">
          <ul class="nav nav-pills">
            <li class="nav-item"><a class="nav-link active" href="#pds" data-toggle="tab">PDS</a></li>
            <li class="nav-item"><a class="nav-link" href="#wes" data-toggle="tab">WES</a></li>
            <li class="nav-item"><a class="nav-link" href="#tc" data-toggle="tab">TC</a></li>
            <li class="nav-item"><a class="nav-link" href="#dtor" data-toggle="tab">DTOR</a></li>
            <li class="nav-item"><a class="nav-link" href="#coe" data-toggle="tab">COE</a></li>
            <li class="nav-item"><a class="nav-link" href="#prcbr" data-toggle="tab">PRC/BR</a></li>
            <li class="nav-item"><a class="nav-link" href="#ipcr" data-toggle="tab">IPCR</a></li>
            <li class="nav-item"><a class="nav-link" href="#osd" data-toggle="tab">OSD</a></li>
          </ul>
        </div><!-- /.card-header -->
        <div class="card-body">
          <div class="tab-content">
            <div class="active tab-pane" id="pds">
                @if($users->pds)
                @foreach($users->pds as $key => $pds)
                <a href="{{ asset('storage/app/public') }}/{{$users->id}}/{{$pds->filename}}" target="_blank">Personal Data Sheet(CS Form No. 212, Revised 2017) {{(int)$key + 1}} </a><br>
                <div class="modal fade" id="pds-xl-{{$key}}">
                    <div class="modal-dialog modal-xl">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h4 class="modal-title">Personal Data Sheet(CS Form No. 212, Revised 2017)</h4>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                            @if(Auth::user()->level == 2 || Auth::user()->id == $pds->user_id)
                            <a class="btn btn-app bg-danger btn-delete-pds" data-id="{{$pds->id}}">
                              <i class="fas fa-trash"></i> Delete
                            </a>
                            @endif
                            <object data="{{ asset('storage/app/public') }}/{{$users->id}}/{{$pds->filename}}" type="application/pdf" width="100%" height="800px">
                                <p>Your web browser doesn't have a PDF plugin.
                                Instead you can <a download href="{{ asset('storage/app/public') }}/{{$users->id}}/{{$pds->filename}}">click here to
                                download the PDF file.</a></p>
                            </object>
                        </div>
                      </div>
                      <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>
                @endforeach
                @endif
            </div>
            <!-- /.tab-pane -->
            <div class="tab-pane" id="wes">
              @if($users->wes)
              @foreach($users->wes as $key => $wes)
              <a href="{{ asset('storage/app/public') }}/{{$users->id}}/{{$wes->filename}}" target="_blank">CSC Work Experience Sheet {{(int)$key + 1}} </a><br>
              <div class="modal fade" id="wes-xl-{{$key}}">
                  <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h4 class="modal-title">CSC Work Experience Sheet</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                          @if(Auth::user()->level == 2 || Auth::user()->id == $wes->user_id)
                          <a class="btn btn-app bg-danger btn-delete-wes" data-id="{{$wes->id}}">
                            <i class="fas fa-trash"></i> Delete
                          </a>
                          @endif
                          <object data="{{ asset('storage/app/public') }}/{{$users->id}}/{{$wes->filename}}" type="application/pdf" width="100%" height="800px">
                              <p>Your web browser doesn't have a PDF plugin.
                              Instead you can <a download href="{{ asset('storage/app/public') }}/{{$users->id}}/{{$wes->filename}}">click here to
                              download the PDF file.</a></p>
                          </object>
                      </div>
                    </div>
                    <!-- /.modal-content -->
                  </div>
                  <!-- /.modal-dialog -->
              </div>
              @endforeach
              @endif
            </div>
            <!-- /.tab-pane -->

            <div class="tab-pane" id="tc">
              @if($users->tc)
                @foreach($users->tc as $key => $tc)
                <a href="{{ asset('storage/app/public') }}/{{$users->id}}/{{$tc->filename}}" target="_blank">Training Certificates {{(int)$key + 1}} </a><br>
                <div class="modal fade" id="tc-xl-{{$key}}">
                    <div class="modal-dialog modal-xl">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h4 class="modal-title">Training Certificates</h4>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                            @if(Auth::user()->level == 2 || Auth::user()->id == $tc->user_id)
                            <a class="btn btn-app bg-danger btn-delete-tc" data-id="{{$tc->id}}">
                              <i class="fas fa-trash"></i> Delete
                            </a>
                            @endif
                            <object data="{{ asset('storage/app/public') }}/{{$users->id}}/{{$tc->filename}}" type="application/pdf" width="100%" height="800px">
                              <p>Your web browser doesn't have a PDF plugin.
                              Instead you can <a download href="{{ asset('storage/app/public') }}/{{$users->id}}/{{$tc->filename}}">click here to
                              download the PDF file.</a></p>
                            </object>
                        </div>
                      </div>
                      <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>
                @endforeach
                @endif
            </div>
            <div class="tab-pane" id="dtor">
              @if($users->tor)
              @foreach($users->tor as $key => $tor)
              <a href="{{ asset('storage/app/public') }}/{{$users->id}}/{{$tor->filename}}" target="_blank">Diploma & Transcript of Record {{(int)$key + 1}} </a><br>
              <div class="modal fade" id="tor-xl-{{$key}}">
                  <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h4 class="modal-title">Diploma & Transcript of Record </h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                          @if(Auth::user()->level == 2 || Auth::user()->id == $tor->user_id)
                          <a class="btn btn-app bg-danger btn-delete-tor" data-id="{{$tor->id}}">
                            <i class="fas fa-trash"></i> Delete
                          </a>
                          @endif
                          <object data="{{ asset('storage/app/public') }}/{{$users->id}}/{{$tor->filename}}" type="application/pdf" width="100%" height="800px">
                            <p>Your web browser doesn't have a PDF plugin.
                            Instead you can <a download href="{{ asset('storage/app/public') }}/{{$users->id}}/{{$tor->filename}}">click here to
                            download the PDF file.</a></p>
                          </object>
                      </div>
                    </div>
                    <!-- /.modal-content -->
                  </div>
                  <!-- /.modal-dialog -->
              </div>
              @endforeach
              @endif
            </div>
            <div class="tab-pane" id="coe">
              @if($users->coe)
              @foreach($users->coe as $key => $coe)
              <a href="{{ asset('storage/app/public') }}/{{$users->id}}/{{$coe->filename}}" target="_blank">Certificate of Employment {{(int)$key + 1}} </a><br>
              <div class="modal fade" id="coe-xl-{{$key}}">
                  <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h4 class="modal-title">Certificate of Employment</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                          @if(Auth::user()->level == 2 || Auth::user()->id == $coe->user_id)
                          <a class="btn btn-app bg-danger btn-delete-coe" data-id="{{$coe->id}}">
                            <i class="fas fa-trash"></i> Delete
                          </a>
                          @endif
                          <object data="{{ asset('storage/app/public') }}/{{$users->id}}/{{$coe->filename}}" type="application/pdf" width="100%" height="800px">
                            <p>Your web browser doesn't have a PDF plugin.
                            Instead you can <a download href="{{ asset('storage/app/public') }}/{{$users->id}}/{{$coe->filename}}">click here to
                            download the PDF file.</a></p>
                          </object>
                      </div>
                    </div>
                    <!-- /.modal-content -->
                  </div>
                  <!-- /.modal-dialog -->
              </div>
              @endforeach
              @endif
            </div>
            <div class="tab-pane" id="prcbr">
              @if($users->elig)
              @foreach($users->elig as $key => $elig)
              <a href="{{ asset('storage/app/public') }}/{{$users->id}}/{{$elig->filename}}" target="_blank">Eligibility/PRC {{(int)$key + 1}} </a><br>
              <div class="modal fade" id="elig-xl-{{$key}}">
                  <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h4 class="modal-title">Eligibility/PRC</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                          @if(Auth::user()->level == 2 || Auth::user()->id == $elig->user_id)
                          <a class="btn btn-app bg-danger btn-delete-elig" data-id="{{$elig->id}}">
                            <i class="fas fa-trash"></i> Delete
                          </a>
                          @endif
                          <object data="{{ asset('storage/app/public') }}/{{$users->id}}/{{$elig->filename}}" type="application/pdf" width="100%" height="800px">
                            <p>Your web browser doesn't have a PDF plugin.
                            Instead you can <a download href="{{ asset('storage/app/public') }}/{{$users->id}}/{{$elig->filename}}">click here to
                            download the PDF file.</a></p>
                          </object>
                      </div>
                    </div>
                    <!-- /.modal-content -->
                  </div>
                  <!-- /.modal-dialog -->
              </div>
              @endforeach
              @endif
            </div>
            <div class="tab-pane" id="ipcr">
              @if($users->ipcr)
              @foreach($users->ipcr as $key => $ipcr)
              <a href="{{ asset('storage/app/public') }}/{{$users->id}}/{{$ipcr->filename}}" target="_blank">IPCR/Performance Evaluation {{(int)$key + 1}} </a><br>
              <div class="modal fade" id="ipcr-xl-{{$key}}">
                  <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h4 class="modal-title">IPCR/Performance Evaluation</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                          @if(Auth::user()->level == 2 || Auth::user()->id == $ipcr->user_id)
                          <a class="btn btn-app bg-danger btn-delete-ipcr" data-id="{{$ipcr->id}}">
                            <i class="fas fa-trash"></i> Delete
                          </a>
                          @endif
                          <object data="{{ asset('storage/app/public') }}/{{$users->id}}/{{$ipcr->filename}}" type="application/pdf" width="100%" height="800px">
                            <p>Your web browser doesn't have a PDF plugin.
                            Instead you can <a download href="{{ asset('storage/app/public') }}/{{$users->id}}/{{$ipcr->filename}}">click here to
                            download the PDF file.</a></p>
                        </object>
                      </div>
                    </div>
                    <!-- /.modal-content -->
                  </div>
                  <!-- /.modal-dialog -->
              </div>
              @endforeach
              @endif
            </div>
            <div class="tab-pane" id="osd">
              @if($users->odoc)
              @foreach($users->odoc as $key => $odoc)
              <a href="{{ asset('storage/app/public') }}/{{$users->id}}/{{$odoc->filename}}" target="_blank">Other Document {{(int)$key + 1}} </a><br>
              <div class="modal fade" id="doc-xl-{{$key}}">
                  <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h4 class="modal-title">Other Document</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                          @if(Auth::user()->level == 2 || Auth::user()->id == $odoc->user_id)
                          <a class="btn btn-app bg-danger btn-delete-doc" data-id="{{$odoc->id}}">
                            <i class="fas fa-trash"></i> Delete
                          </a>
                          @endif
                          <embed id="view-app" src="{{ asset('storage/app/public') }}/{{$users->id}}/{{$odoc->filename}}" frameborder="0" width="100%" height="800px"></embed>
                      </div>
                    </div>
                    <!-- /.modal-content -->
                  </div>
                  <!-- /.modal-dialog -->
              </div>
              @endforeach
              @endif
            </div>
            <!-- /.tab-pane -->
          </div>
          <!-- /.tab-content -->
        </div><!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
    <!-- /.col -->
  </div>
</div>
@endsection
@section('js')
<script>
  $( ".btn-delete-pds" ).on( "click", function() {
        var id = $(this).attr('data-id');
        var url = "{{ secure_url('/delete-pds') }}";
        $.ajax({
            async: true,
            url: url,
            type: 'GET',
            data: {
                id: id
            },
            success : function(data){
                $.toast({
                    heading: 'Deleted',
                    text: 'Successfully Deleted',
                    showHideTransition: 'fade',
                    icon: 'error'
                })
                setTimeout(function(){
                  window.location.reload(false);
              },500);
            }
        });
    } );
    
    $( ".btn-delete-wes" ).on( "click", function() {
        var id = $(this).attr('data-id');
        var url = "{{ secure_url('/delete-wes') }}";
        $.ajax({
            async: true,
            url: url,
            type: 'GET',
            data: {
                id: id
            },
            success : function(data){
                $.toast({
                    heading: 'Deleted',
                    text: 'Successfully Deleted',
                    showHideTransition: 'fade',
                    icon: 'error'
                })
                setTimeout(function(){
                  window.location.reload(false);
              },500);
            }
        });
    } );
    $( ".btn-delete-tc" ).on( "click", function() {
        var id = $(this).attr('data-id');
        var url = "{{ secure_url('/delete-tc') }}";
        $.ajax({
            async: true,
            url: url,
            type: 'GET',
            data: {
                id: id
            },
            success : function(data){
                $.toast({
                    heading: 'Deleted',
                    text: 'Successfully Deleted',
                    showHideTransition: 'fade',
                    icon: 'error'
                })
                setTimeout(function(){
                  window.location.reload(false);
              },500);
            }
        });
    } );
    $( ".btn-delete-coe" ).on( "click", function() {
        var id = $(this).attr('data-id');
        var url = "{{ secure_url('/delete-coe') }}";
        $.ajax({
            async: true,
            url: url,
            type: 'GET',
            data: {
                id: id
            },
            success : function(data){
                $.toast({
                    heading: 'Deleted',
                    text: 'Successfully Deleted',
                    showHideTransition: 'fade',
                    icon: 'error'
                })
                setTimeout(function(){
                  window.location.reload(false);
              },500);
            }
        });
    } );
    $( ".btn-delete-ipcr" ).on( "click", function() {
        var id = $(this).attr('data-id');
        var url = "{{ secure_url('/delete-ipcr') }}";
        $.ajax({
            async: true,
            url: url,
            type: 'GET',
            data: {
                id: id
            },
            success : function(data){
                $.toast({
                    heading: 'Deleted',
                    text: 'Successfully Deleted',
                    showHideTransition: 'fade',
                    icon: 'error'
                })
                setTimeout(function(){
                  window.location.reload(false);
              },500);
            }
        });
    } );

    $( ".btn-delete-tor" ).on( "click", function() {
        var id = $(this).attr('data-id');
        var url = "{{ secure_url('/delete-tor') }}";
        $.ajax({
            async: true,
            url: url,
            type: 'GET',
            data: {
                id: id
            },
            success : function(data){
                $.toast({
                    heading: 'Deleted',
                    text: 'Successfully Deleted',
                    showHideTransition: 'fade',
                    icon: 'error'
                })
                setTimeout(function(){
                  window.location.reload(false);
              },500);
            }
        });
    } );
    $( ".btn-delete-elig" ).on( "click", function() {
        var id = $(this).attr('data-id');
        var url = "{{ secure_url('/delete-elig') }}";
        $.ajax({
            async: true,
            url: url,
            type: 'GET',
            data: {
                id: id
            },
            success : function(data){
                $.toast({
                    heading: 'Deleted',
                    text: 'Successfully Deleted',
                    showHideTransition: 'fade',
                    icon: 'error'
                })
                setTimeout(function(){
                  window.location.reload(false);
              },500);
            }
        });
    } );
    $( ".btn-delete-doc" ).on( "click", function() {
        var id = $(this).attr('data-id');
        var url = "{{ secure_url('/delete-doc') }}";
        $.ajax({
            async: true,
            url: url,
            type: 'GET',
            data: {
                id: id
            },
            success : function(data){
                $.toast({
                    heading: 'Deleted',
                    text: 'Successfully Deleted',
                    showHideTransition: 'fade',
                    icon: 'error'
                })
                setTimeout(function(){
                  window.location.reload(false);
              },500);
            }
        });
    } );
</script>
@endsection