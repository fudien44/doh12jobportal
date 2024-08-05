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
<section class="py-5">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <div class="card card-widget widget-user">
                  <!-- Add the bg color to the header using any of the bg-* classes -->
                  <div class="widget-user-header text-white"
                       style="background: url('{{ asset("public/img/bg1.png") }}')center;">
                    <h5 class="widget-user-desc text-left">My Profile</h5>
                  </div>
                  <div class="widget-user-image">
                    @if($users->profile && $users->profile->picture_link)
                    <img class="img-circle profile-picture" src="{{ asset('storage/app/public')}}/{{$users->id}}/{{$users->profile->picture_link}}" alt="User Avatar" width="120">
                    @else
                    <img class="img-circle" src="{{ asset('public/img/profile.png') }}" alt="User Avatar">
                    @endif
                  </div>
                  <div class="card-footer">
                    <div class="row">
                      <div class="col-sm-12 text-center">
                         <h3 class="text-success">{{$users->fname}} {{$users->lname}}</h3>
                      </div>
                      <div class="col-sm-12 text-center">
                         <h5 class="text-success">Applicant</h5>
                      </div>
                      <div class="col-sm-12 text-right">
                         <button class="btn btn-sm btn-success btn-edit-profile">Edit Profile <i class="far fa-edit"></i>
                        </button>
                        <a href="{{asset('/jobs/apply')}}" class="btn btn-sm btn-primary">My Applications <i class="far fa-paper-plane"></i>
                        </a>
                      </div>
                      <div class="col-sm-4 border-right">
                        <div class="description-block">
                          <h5 class="description-header">{{$users->myjobs->count()}}</h5>
                          <span class="description-text">JOBS APPLIED</span>
                        </div>
                        <!-- /.description-block -->
                      </div>
                      <!-- /.col -->
                      <div class="col-sm-4 border-right">
                        <div class="description-block">
                            @php
                            $app = (int)0;
                              foreach($users->myjobs as $j) {
                                  $app += (int)$j->letters->count();
                              }
                            @endphp
                          <h5 class="description-header">{{$app}}</h5>
                          <span class="description-text">APPLICATION SUBMITTED</span>
                        </div>
                        <!-- /.description-block -->
                      </div>
                      <!-- /.col -->
                      <div class="col-sm-4">
                        <div class="description-block">
                          <h5 class="description-header">
                              @php
                              $att = (int)$users->pds->count() + (int)$users->tor->count() + (int)$users->wes->count() + (int)$users->tc->count() + (int)$users->coe->count() + (int)$users->ipcr->count() + (int)$users->elig->count() + (int)$users->odoc->count()
                              @endphp
                              {{$att}}
                          </h5>
                          <span class="description-text">ATTACHMENTS</span>
                        </div>
                        <!-- /.description-block -->
                      </div>
                      <!-- /.col -->
                    </div>
                    <!-- /.row -->
                  </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <form id="applicant-info-form" method="POST" enctype="multipart/form-data">
                            {{csrf_field()}}
                            <input type="hidden" name="profile_id" value="{{$profile->id}}">
                            <table id="applicant-info-table" class="table table-bordered table-hover">
                                <h5 class="text-success">Personal Information</h5>
                                <hr>
                                <div class="col-md-4">
                                    <h6 class="card-subtitle req-field">Upload Photo:</h6>
                                    <div class="form-group">
                                        <div class="input-group">
                                          <div class="custom-file">
                                            <input type="file" name="picture_link" class="custom-file-input" id="upProfile" accept="image/jpeg, image/png">
                                            <label class="custom-file-label" for="upProfile">Choose photo</label>
                                          </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <h6 class="card-subtitle req-field">First name:</h6>
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-border required" name="fname" value="{{$users->fname}}">
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <h6 class="card-subtitle req-field">Middle name:</h6>
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-border required" name="mname" value="{{$users->mname}}">
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <h6 class="card-subtitle req-field">Last name:</h6>
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-border required" name="lname" value="{{$users->lname}}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <h6 class="card-subtitle req-field">Extension:</h6>
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-border required" name="extension" value="{{$profile->extension}}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <h6 class="card-subtitle req-field">Date of Birth:</h6>
                                        <div class="form-group">
                                            <input type="date"class="form-control form-control-border" id="dob" name="dob" value="{{$profile->dob}}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <h6 class="card-subtitle req-field">Age:</h6>
                                        <input type="text" class="form-control form-control-border required" disabled id="age" name="age">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                      <h6 class="card-subtitle req-field">Sex:</h6>
                                      <select class="form-control form-control-border sex" name="sex">
                                        <option selected value="">Select Sex</option>
                                        <option value="0"@if($profile->sex == 0) selected @endif>Male</option>
                                        <option value="1"@if($profile->sex == 1) selected @endif>Female</option>
                                      </select>
                                    </div>
                                    <div class="col-md-4">
                                      <h6 class="card-subtitle req-field">Gender:</h6>
                                      <select class="form-control form-control-border gender" name="gender">
                                        <option selected value="">Select Gender</option>
                                        <option value="1"@if($profile->gender == 1) selected @endif>Agender</option>
                                        <option value="2" @if($profile->gender == 2) selected @endif>Cisgender</option>
                                        <option value="3"@if($profile->gender == 3) selected @endif>Gender fluid</option>
                                        <option value="4"@if($profile->gender == 4) selected @endif>Genderqueer</option>
                                        <option value="5"@if($profile->gender == 5) selected @endif>Non-binary</option>
                                        <option value="6"@if($profile->gender == 6) selected @endif>Transgender</option>
                                      </select>
                                    </div>
                                    <div class="col-md-4">
                                        <h6 class="card-subtitle req-field">Ethnicity:</h6>
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-border required" name="ethnicity" value="{{$profile->ethnicity}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <h6 class="card-subtitle req-field">Religion:</h6>
                                          <select class="form-control form-control-border religion" name="religion">
                                            <option selected value="">Select Religion</option>
                                            <option value="AGLIP"@if($profile->religion == 'AGLIP') selected @endif>AGLIPAY</option>
                                            <option value="ALLY"@if($profile->religion == 'ALLY') selected @endif>ALLIANCE OF BIBLE CHRISTIAN COMMUNITIES</option>
                                            <option value="ANGLI"@if($profile->religion == 'ANGLI') selected @endif>ANGLICAN</option>
                                            <option value="BAPTI"@if($profile->religion == 'BAPTI') selected @endif>BAPTIST</option>
                                            <option value="BRNAG"@if($profile->religion == 'BRNAG') selected @endif>BORN AGAIN CHRISTIAN</option>
                                            <option value="BUDDH"@if($profile->religion == 'BUDDH') selected @endif>BUDDHISM</option>
                                            <option value="CATHO"@if($profile->religion == 'CATHO') selected @endif>CATHOLIC</option>
                                            <option value="XTIAN"@if($profile->religion == 'XTIAN') selected @endif>CHRISTIAN</option>
                                            <option value="CHOG"@if($profile->religion == 'CHOG') selected @endif>CHURCH OF GOD</option>
                                            <option value="EVANG"@if($profile->religion == 'EVANG') selected @endif>EVANGELICAL</option>
                                            <option value="IGNIK"@if($profile->religion == 'IGNIK') selected @endif>IGLESIA NI CRISTO</option>
                                            <option value="MUSLI"@if($profile->religion == 'MUSLI') selected @endif>ISLAM</option>
                                            <option value="JEWIT"@if($profile->religion == 'JEWIT') selected @endif>JEHOVAHS WITNESS</option>
                                            <option value="MORMO"@if($profile->religion == 'MORMO') selected @endif>LDS-MORMONS</option>
                                            <option value="LRCM"@if($profile->religion == 'LRCM') selected @endif>LIFE RENEWAL CHRISTIAN MINISTRY</option>
                                            <option value="LUTHR"@if($profile->religion == 'LUTHR') selected @endif>LUTHERAN</option>
                                            <option value="METOD"@if($profile->religion == 'METOD') selected @endif>METHODIST</option>
                                            <option value="PENTE"@if($profile->religion == 'PENTE') selected @endif>PENTECOSTAL</option>
                                            <option value="PROTE"@if($profile->religion == 'PROTE') selected @endif>PROTESTANT</option>
                                            <option value="SVDAY"@if($profile->religion == 'SVDAY') selected @endif>SEVENTH DAY ADVENTIST</option>
                                            <option value="UCCP"@if($profile->religion == 'UCCP') selected @endif>UCCP</option>
                                            <option value="UNKNO"@if($profile->religion == 'UNKNO') selected @endif>UNKNOWN</option>
                                            <option value="WESLY"@if($profile->religion == 'WESLY') selected @endif>WESLEYAN</option>
                                          </select>
                                    </div>
                                    <div class="col-sm-4">
                                        <h6 class="card-subtitle req-field">Civil Status:</h6>
                                          <select class="form-control form-control-border civilstat" name="civilstat">
                                            <option selected value="">Select Status</option>
                                            <option value="0"@if($profile->civilstat == '0') selected @endif>Single</option>
                                            <option value="1"@if($profile->civilstat == '1') selected @endif>Married</option>
                                            <option value="2"@if($profile->civilstat == '2') selected @endif>Separated</option>
                                            <option value="3"@if($profile->civilstat == '3') selected @endif>Widowed</option>
                                            <option value="4"@if($profile->civilstat == '4') selected @endif>Other</option>
                                          </select>
                                    </div>
                                </div>
                                <br>
                                <h3>Contact</h3>
                                <hr>
                                <div class="row">
                                    <div class="col-md-4">
                                        <h6 class="card-subtitle req-field">Address:</h6>
                                        <div class="form-group">
                                            <textarea class="form-control form-control-border required" name="address" rows="2">{{$profile->address}}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <h6 class="card-subtitle req-field">Contact Number:</h6>
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-border required" name="contactno" value="{{$users->contactno}}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <h6 class="card-subtitle req-field">Email Address:</h6>
                                        <div class="form-group">
                                            <input type="email" class="form-control form-control-border required" name="email" value="{{$users->email}}">
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <h3>Education</h3>
                                <hr>
                                <div class="row">
                                    <div class="col-md-4">
                                        <h6 class="card-subtitle req-field">Highest Educational Attainment:</h6>
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-border required" name="highest_education" value="{{$profile->highest_education}}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <h6 class="card-subtitle req-field">Course Title:</h6>
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-border required" name="course" value="{{$profile->course}}">
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <h6 class="card-subtitle req-field">Name Of School/University:</h6>
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-border required" name="school" value="{{$profile->school}}">
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <h6 class="card-subtitle req-field">Eligibility/License/Honor Graduate (If Applicable):</h6>
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-border required" name="eligibility" value="{{$profile->eligibility}}">
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <h3>Other Information</h3>
                                <hr>
                                <div class="row">
                                     <div class="col-sm-4">
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
                                     <div class="col-md-4">
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
                                     <div class="col-sm-12">
                                        <br>
                                        <h3>Attachments</h3>
                                        <hr>
                                     </div>
                                     <div class="col-sm-12">
                                        <h5>Personal Data Sheet(CS Form No. 212, Revised 2017)</h5><hr>
                                        @if($users->pds)
                                        @foreach($users->pds as $key => $pds)
                                        <a href="#" data-toggle="modal" data-target="#pds-xl-{{$key}}">Personal Data Sheet(CS Form No. 212, Revised 2017) {{(int)$key + 1}} </a><br>
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
                                                    <a class="btn btn-app bg-danger btn-delete-pds" data-id="{{$pds->id}}">
                                                      <i class="fas fa-trash"></i> Delete
                                                    </a>
                                                    <embed id="view-app" src="{{ asset('storage/app/public') }}/{{$users->id}}/{{$pds->filename}}" frameborder="0" width="100%" height="800px"></embed>
                                                </div>
                                              </div>
                                              <!-- /.modal-content -->
                                            </div>
                                            <!-- /.modal-dialog -->
                                        </div>
                                        @endforeach
                                        @endif
                                        <div class="dropzone" id="pdsFile" name="pds_file"></div>
                                     </div>
                                     <div class="col-sm-12">
                                        <h5>CSC Work Experience Sheet</h5><hr>
                                        @if($users->wes)
                                        @foreach($users->wes as $key => $wes)
                                        <a href="#" data-toggle="modal" data-target="#wes-xl-{{$key}}">CSC Work Experience Sheet {{(int)$key + 1}} </a><br>
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
                                                    <a class="btn btn-app bg-danger btn-delete-wes" data-id="{{$wes->id}}">
                                                      <i class="fas fa-trash"></i> Delete
                                                    </a>
                                                    <embed id="view-app" src="{{ asset('storage/app/public') }}/{{$users->id}}/{{$wes->filename}}" frameborder="0" width="100%" height="800px"></embed>
                                                </div>
                                              </div>
                                              <!-- /.modal-content -->
                                            </div>
                                            <!-- /.modal-dialog -->
                                        </div>
                                        @endforeach
                                        @endif
                                        <div class="dropzone" id="wesFile" name="wes_file"></div>
                                     </div>
                                     <div class="col-sm-12">
                                        <h5>Training Certificates</h5><hr>
                                        @if($users->tc)
                                        @foreach($users->tc as $key => $tc)
                                        <a href="#" data-toggle="modal" data-target="#tc-xl-{{$key}}">Training Certificates {{(int)$key + 1}} </a><br>
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
                                                    <a class="btn btn-app bg-danger btn-delete-tc" data-id="{{$tc->id}}">
                                                      <i class="fas fa-trash"></i> Delete
                                                    </a>
                                                    <embed id="view-app" src="{{ asset('storage/app/public') }}/{{$users->id}}/{{$tc->filename}}" frameborder="0" width="100%" height="800px"></embed>
                                                </div>
                                              </div>
                                              <!-- /.modal-content -->
                                            </div>
                                            <!-- /.modal-dialog -->
                                        </div>
                                        @endforeach
                                        @endif
                                        <div class="dropzone" id="tcFile" name="tc_file"></div>
                                     </div>
                                     <div class="col-sm-12">
                                        <h5>Diploma & Transcript of Record</h5><hr>
                                        @if($users->tor)
                                        @foreach($users->tor as $key => $tor)
                                        <a href="#" data-toggle="modal" data-target="#tor-xl-{{$key}}">Diploma & Transcript of Record {{(int)$key + 1}} </a><br>
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
                                                    <a class="btn btn-app bg-danger btn-delete-tor" data-id="{{$tor->id}}">
                                                      <i class="fas fa-trash"></i> Delete
                                                    </a>
                                                    <embed id="view-app" src="{{ asset('storage/app/public') }}/{{$users->id}}/{{$tor->filename}}" frameborder="0" width="100%" height="800px"></embed>
                                                </div>
                                              </div>
                                              <!-- /.modal-content -->
                                            </div>
                                            <!-- /.modal-dialog -->
                                        </div>
                                        @endforeach
                                        @endif
                                        <div class="dropzone" id="torFile"></div>
                                     </div>
                                     <div class="col-sm-12">
                                        <h5>Certificate of Employment</h5><hr>
                                        @if($users->coe)
                                        @foreach($users->coe as $key => $coe)
                                        <a href="#" data-toggle="modal" data-target="#coe-xl-{{$key}}">Certificate of Employment {{(int)$key + 1}} </a><br>
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
                                                    <a class="btn btn-app bg-danger btn-delete-coe" data-id="{{$coe->id}}">
                                                      <i class="fas fa-trash"></i> Delete
                                                    </a>
                                                    <embed id="view-app" src="{{ asset('storage/app/public') }}/{{$users->id}}/{{$coe->filename}}" frameborder="0" width="100%" height="800px"></embed>
                                                </div>
                                              </div>
                                              <!-- /.modal-content -->
                                            </div>
                                            <!-- /.modal-dialog -->
                                        </div>
                                        @endforeach
                                        @endif
                                        <div class="dropzone" id="coeFile" name="coe_file"></div>
                                     </div>
                                     <div class="col-sm-12">
                                        <h5>Eligibility/PRC/Board Rating</h5><hr>
                                        @if($users->elig)
                                        @foreach($users->elig as $key => $elig)
                                        <a href="#" data-toggle="modal" data-target="#elig-xl-{{$key}}">Eligibility/PRC {{(int)$key + 1}} </a><br>
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
                                                    <a class="btn btn-app bg-danger btn-delete-elig" data-id="{{$elig->id}}">
                                                      <i class="fas fa-trash"></i> Delete
                                                    </a>
                                                    <embed id="view-app" src="{{ asset('storage/app/public') }}/{{$users->id}}/{{$elig->filename}}" frameborder="0" width="100%" height="800px"></embed>
                                                </div>
                                              </div>
                                              <!-- /.modal-content -->
                                            </div>
                                            <!-- /.modal-dialog -->
                                        </div>
                                        @endforeach
                                        @endif
                                        <div class="dropzone" id="eligFile"></div>
                                     </div>
                                     <div class="col-sm-12">
                                        <h5>IPCR/Performance Evaluation</h5><hr>
                                        @if($users->ipcr)
                                        @foreach($users->ipcr as $key => $ipcr)
                                        <a href="#" data-toggle="modal" data-target="#ipcr-xl-{{$key}}">IPCR/Performance Evaluation {{(int)$key + 1}} </a><br>
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
                                                    <a class="btn btn-app bg-danger btn-delete-ipcr" data-id="{{$ipcr->id}}">
                                                      <i class="fas fa-trash"></i> Delete
                                                    </a>
                                                    <embed id="view-app" src="{{ asset('storage/app/public') }}/{{$users->id}}/{{$ipcr->filename}}" frameborder="0" width="100%" height="800px"></embed>
                                                </div>
                                              </div>
                                              <!-- /.modal-content -->
                                            </div>
                                            <!-- /.modal-dialog -->
                                        </div>
                                        @endforeach
                                        @endif
                                        <div class="dropzone" id="ipcrFile" name="ipcr_file"></div>
                                     </div>
                                     <div class="col-sm-12">
                                        <h5>Other Supporting Documents</h5>
                                        <hr>
                                        <div class="dropzone" id="otherFile"></div>
                                        @if($users->odoc)
                                        @foreach($users->odoc as $key => $odoc)
                                        <a href="#" data-toggle="modal" data-target="#doc-xl-{{$key}}">Other Document {{(int)$key + 1}} </a><br>
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
                                                    <a class="btn btn-app bg-danger btn-delete-doc" data-id="{{$odoc->id}}">
                                                      <i class="fas fa-trash"></i> Delete
                                                    </a>
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
                                    <button type="submit" class="btn float btn-save-profile d-none"><i class="fas fa-save"></i></button>
                                </div>
                            </table>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
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
    });
    $(".btn-save-profile").click(function (e) {
        $( "#applicant-info-form" ).trigger( "submit" );
    });
    Dropzone.autoDiscover = false,
    $("#wesFile").dropzone({
      addRemoveLinks: true,
      autoProcessQueue: false,
      maxFiles: 2000,
      parallelUploads: 10000,
      acceptedFiles: ".pdf",
      paramName: "mywes[]",
      url: "{{secure_url('/save-application-update')}}",
      dictDefaultMessage: 'Click or drop files here. Accepted file: .pdf .Upload file size up to 5mb only',
      init: function() {
        var myDropzone = this;
        // Update selector to match your button
        $(".btn-save-profile").click(function (e) {
            if (myDropzone.getUploadingFiles().length > 0 || myDropzone.getQueuedFiles().length > 0) {
                myDropzone.processQueue();
            }
        });
        this.on('error', function(file, xhr, formData) {
            $.toast({
                heading: 'Invalid File Format',
                text: 'Only PDF File will accept/Upload size too large!',
                position: 'top-center',
                icon: 'error',
                hideAfter: false
            })
            this.removeFile(file);
        });
        this.on('sending', function(file, xhr, formData) {
            // Append all form inputs to the formData Dropzone will POST
            var data = $('#applicant-info-form').serializeArray();
            $.each(data, function(key, el) {
                formData.append(el.name, el.value);
            });
            $.toast({
                heading: 'Uploading',
                text: 'Uploading Work Experience Sheet',
                position: 'top-center'
            })
        });
        this.on("success", function(file, responseText) {
            $.toast({
                heading: 'Saved',
                text: 'Successfully Saved Work Experience Sheet, Refresh page to apply changes',
                position: 'top-center'
            })
            this.removeFile(file);
        });
      }   
    });
    $("#tcFile").dropzone({
      addRemoveLinks: true,
      autoProcessQueue: false,
      maxFiles: 2000,
      parallelUploads: 10000,
      acceptedFiles: ".pdf",
      paramName: "mytc[]",
      url: "{{secure_url('/save-application-update')}}",
      dictDefaultMessage: 'Click or drop files here. Accepted file: .pdf .Upload file size up to 5mb only',
      init: function() {
        var myDropzone = this;
        // Update selector to match your button
        $(".btn-save-profile").click(function (e) {
            if (myDropzone.getUploadingFiles().length > 0 || myDropzone.getQueuedFiles().length > 0) {
                myDropzone.processQueue();
            }
        });
        this.on('error', function(file, xhr, formData) {
            $.toast({
                heading: 'Invalid File Format',
                text: 'Only PDF File will accept/Upload size too large!',
                position: 'top-center',
                icon: 'error',
                hideAfter: false
            })
            this.removeFile(file);
        });
        this.on('sending', function(file, xhr, formData) {
            // Append all form inputs to the formData Dropzone will POST
            var data = $('#applicant-info-form').serializeArray();
            $.each(data, function(key, el) {
                formData.append(el.name, el.value);
            });
            $.toast({
                heading: 'Uploading',
                text: 'Uploading Training Certificates',
                position: 'top-center'
            })
        });
        this.on("success", function(file, responseText) {
            $.toast({
                heading: 'Saved',
                text: 'Successfully Saved Training Certificates, Refresh page to apply changes',
                position: 'top-center'
            })
            this.removeFile(file);
        });
      }   
    });
    $("#coeFile").dropzone({
      addRemoveLinks: true,
      autoProcessQueue: false,
      maxFiles: 2000,
      parallelUploads: 10000,
      acceptedFiles: ".pdf",
      paramName: "mycoe[]",
      url: "{{secure_url('/save-application-update')}}",
      dictDefaultMessage: 'Click or drop files here. Accepted file: .pdf .Upload file size up to 5mb only',
      init: function() {
        var myDropzone = this;
        // Update selector to match your button
        $(".btn-save-profile").click(function (e) {
            if (myDropzone.getUploadingFiles().length > 0 || myDropzone.getQueuedFiles().length > 0) {
                myDropzone.processQueue();
            }
        });
        this.on('error', function(file, xhr, formData) {
            $.toast({
                heading: 'Invalid File Format',
                text: 'Only PDF File will accept/Upload size too large!',
                position: 'top-center',
                icon: 'error',
                hideAfter: false
            })
            this.removeFile(file);
        });
        this.on('sending', function(file, xhr, formData) {
            // Append all form inputs to the formData Dropzone will POST
            var data = $('#applicant-info-form').serializeArray();
            $.each(data, function(key, el) {
                formData.append(el.name, el.value);
            });
            $.toast({
                heading: 'Uploading',
                text: 'Uploading Certificate of Employment',
                position: 'top-center'
            })
        });
        this.on("success", function(file, responseText) {
            $.toast({
                heading: 'Saved',
                text: 'Successfully Saved Certificate of Employment, Refresh page to apply changes',
                position: 'top-center'
            })
            this.removeFile(file);
        });
      }   
    });
    $("#ipcrFile").dropzone({
      addRemoveLinks: true,
      autoProcessQueue: false,
      maxFiles: 2000,
      parallelUploads: 10000,
      acceptedFiles: ".pdf",
      paramName: "myipcr[]",
      url: "{{secure_url('/save-application-update')}}",
      dictDefaultMessage: 'Click or drop files here. Accepted file: .pdf .Upload file size up to 5mb only',
      init: function() {
        var myDropzone = this;
        // Update selector to match your button
        $(".btn-save-profile").click(function (e) {
            if (myDropzone.getUploadingFiles().length > 0 || myDropzone.getQueuedFiles().length > 0) {
                myDropzone.processQueue();
            }
        });
        this.on('error', function(file, xhr, formData) {
            $.toast({
                heading: 'Invalid File Format',
                text: 'Only PDF File will accept/Upload size too large!',
                position: 'top-center',
                icon: 'error',
                hideAfter: false
            })
            this.removeFile(file);
        });
        this.on('sending', function(file, xhr, formData) {
            // Append all form inputs to the formData Dropzone will POST
            var data = $('#applicant-info-form').serializeArray();
            $.each(data, function(key, el) {
                formData.append(el.name, el.value);
            });
            $.toast({
                heading: 'Uploading',
                text: 'Uploading IPCR/Performace Evaluation',
                position: 'top-center'
            })
        });
        this.on("success", function(file, responseText) {
            $.toast({
                heading: 'Saved',
                text: 'Successfully Saved IPCR/Performace Evaluation, Refresh page to apply changes',
                position: 'top-center'
            })
            this.removeFile(file);
        });
      }   
    });
    $("#pdsFile").dropzone({
      addRemoveLinks: true,
      autoProcessQueue: false,
      maxFiles: 2000,
      parallelUploads: 10000,
      acceptedFiles: ".pdf",
      paramName: "mypds[]",
      url: "{{secure_url('/save-application-update')}}",
      dictDefaultMessage: 'Click or drop files here. Accepted file: .pdf .Upload file size up to 5mb only',
      init: function() {
        var myDropzone = this;
        // Update selector to match your button
        $(".btn-save-profile").click(function (e) {
            if (myDropzone.getUploadingFiles().length > 0 || myDropzone.getQueuedFiles().length > 0) {
                myDropzone.processQueue();
            }
        });
        this.on('error', function(file, xhr, formData) {
            $.toast({
                heading: 'Invalid File Format',
                text: 'Only PDF File will accept/Upload size too large!',
                position: 'top-center',
                icon: 'error',
                hideAfter: false
            })
            this.removeFile(file);
        });
        this.on('sending', function(file, xhr, formData) {
            // Append all form inputs to the formData Dropzone will POST
            var data = $('#applicant-info-form').serializeArray();
            $.each(data, function(key, el) {
                formData.append(el.name, el.value);
            });
            $.toast({
                heading: 'Uploading',
                text: 'Uploading Personal Data Sheet',
                position: 'top-center'
            })
        });
        this.on("success", function(file, responseText) {
            $.toast({
                heading: 'Saved',
                text: 'Successfully Saved Personal Data Sheet, Refresh page to apply changes',
                position: 'top-center'
            })
            this.removeFile(file);
        });
      }   
    });
    $("#torFile").dropzone({
      addRemoveLinks: true,
      autoProcessQueue: false,
      maxFiles: 2000,
      parallelUploads: 10000,
      acceptedFiles: ".pdf",
      url: "{{secure_url('/save-application-update')}}",
      dictDefaultMessage: 'Click or drop files here. Accepted file: .pdf .Upload file size up to 5mb only',
      paramName: "mytor[]",
      init: function() {
        var myDropzone = this;
        // Update selector to match your button
        $(".btn-save-profile").click(function (e) {
            if (myDropzone.getUploadingFiles().length > 0 || myDropzone.getQueuedFiles().length > 0) {
                myDropzone.processQueue();
            }
        });
        this.on('error', function(file, xhr, formData) {
            $.toast({
                heading: 'Invalid File Format',
                text: 'Only PDF File will accept/Upload size too large!',
                position: 'top-center',
                icon: 'error',
                hideAfter: false
            })
            this.removeFile(file);
        });
        this.on('sending', function(file, xhr, formData) {
            // Append all form inputs to the formData Dropzone will POST
            var data = $('#applicant-info-form').serializeArray();
            $.each(data, function(key, el) {
                formData.append(el.name, el.value);
            });
            $.toast({
                heading: 'Uploading',
                text: 'Uploading Transcript of Records',
                position: 'top-center'
            })
        });
        this.on("success", function(file, responseText) {
            $.toast({
                heading: 'Saved',
                text: 'Successfully Saved Transcript of Records, Refresh page to apply changes',
                position: 'top-center'
            })
            this.removeFile(file);
        });
      }   
    });
    $("#eligFile").dropzone({
      addRemoveLinks: true,
      autoProcessQueue: false,
      maxFiles: 2000,
      parallelUploads: 10000,
      acceptedFiles: ".pdf",
      url: "{{secure_url('/save-application-update')}}",
      dictDefaultMessage: 'Click or drop files here. Accepted file: .pdf .Upload file size up to 5mb only',
      paramName: "myelig[]",
      init: function() {
        var myDropzone = this;
        // Update selector to match your button
        $(".btn-save-profile").click(function (e) {
            if (myDropzone.getUploadingFiles().length > 0 || myDropzone.getQueuedFiles().length > 0) {
                myDropzone.processQueue();
            }
        });
        this.on('error', function(file, xhr, formData) {
            $.toast({
                heading: 'Invalid File Format',
                text: 'Only PDF File will accept/Upload size too large!',
                position: 'top-center',
                icon: 'error',
                hideAfter: false
            })
            this.removeFile(file);
        });
        this.on('sending', function(file, xhr, formData) {
            // Append all form inputs to the formData Dropzone will POST
            var data = $('#applicant-info-form').serializeArray();
            $.each(data, function(key, el) {
                formData.append(el.name, el.value);
            });
            $.toast({
                heading: 'Uploading',
                text: 'Uploading Eligibility File',
                position: 'top-center'
            })
        });
        this.on("success", function(file, responseText) {
            $.toast({
                heading: 'Saved',
                text: 'Successfully Saved Eligibility File, Refresh page to apply changes',
                position: 'top-center'
            })
            this.removeFile(file);
        });
      }   
    });
    $("#otherFile").dropzone({
      addRemoveLinks: true,
      autoProcessQueue: false,
      maxFiles: 2000,
      parallelUploads: 10000,
      acceptedFiles: ".pdf",
      url: "{{secure_url('/save-application-update')}}",
      dictDefaultMessage: 'Click or drop files here. Accepted file: .pdf .Upload file size up to 5mb only',
      paramName: "myother[]",
      init: function() {
        var myDropzone = this;
        // Update selector to match your button
        $(".btn-save-profile").click(function (e) {
            if (myDropzone.getUploadingFiles().length > 0 || myDropzone.getQueuedFiles().length > 0) {
                myDropzone.processQueue();
            }
        });
        this.on('error', function(file, xhr, formData) {
            $.toast({
                heading: 'Invalid File Format',
                text: 'Only PDF File will accept/Upload size too large!',
                position: 'top-center',
                icon: 'error',
                hideAfter: false
            })
            this.removeFile(file);
        });
        this.on('sending', function(file, xhr, formData) {
            // Append all form inputs to the formData Dropzone will POST
            var data = $('#applicant-info-form').serializeArray();
            $.each(data, function(key, el) {
                formData.append(el.name, el.value);
            });
            $.toast({
                heading: 'Uploading',
                text: 'Uploading Other Supporting Documents',
                position: 'top-center'
            })
        });
        this.on("success", function(file, responseText) {
            $.toast({
                heading: 'Saved',
                text: 'Successfully Saved Other Supporting Documents, Refresh page to apply changes',
                position: 'top-center'
            })
            this.removeFile(file);
        });
      }   
    });
    $("#upProfile").change(function () {
        const file = this.files[0];
        var fileExtension = ['jpeg','jpg','png','img'];
        if (file) {
            if(this.files[0].size > 5000000) {
                $.toast({
                    heading: 'Required',
                    text: 'Upload Limit: 5mb',
                    position: 'top-center'
                })
                $(this).val('');
            } else if($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
                $.toast({
                    heading: 'Invalid File Format',
                    text: 'Only image File will accept! eg. jpeg, jpg, png, img',
                    position: 'top-center',
                    icon: 'error',
                    hideAfter: false
                })
                $(this).val('');
            }else {
                let reader = new FileReader();
                reader.onload = function (event) {
                    $(".profile-picture")
                      .attr("src", event.target.result);
                };
                reader.readAsDataURL(file);
            }
        }
    });
    $('#applicant-info-form').on('submit',function(e){
        var url = "{{ secure_url('save-application-update') }}";
        e.preventDefault();
        $(".loading").show();
        $('#applicant-info-form').ajaxSubmit({
            url:  url,
            type: "post",
            success: function(data){
            if(data == 'email') {
                $(".loading").hide();
                $.toast({
                    heading: 'Error',
                    text: 'Email already exist',
                    showHideTransition: 'fade',
                    position: 'top-center',
                    icon: 'error'
                })
            } else {
                $.toast({
                    heading: 'Info',
                    text: 'Successfully update profile',
                    showHideTransition: 'fade',
                    position: 'top-center',
                    icon: 'error'
                })
                $(".loading").hide();
                $('.btn-save-profile').addClass('d-none')
                $('.btn-edit-profile').removeClass('d-none')
                $("#applicant-info-form").css({ 'pointer-events' : 'none'});
            }
            },
            error: function (data) {
                $(".loading").hide();
                $.toast({
                    heading: 'Error',
                    text: 'Something went wrong, Please finish profiling',
                    showHideTransition: 'fade',
                    icon: 'error'
                })
            },
        });
    });
    var dobs = $('#dob').val();
    function age(dob) {
        if(dob) {
            dob = new Date(dob);
            var today = new Date();
            var age = Math.floor((today-dob) / (365.25 * 24 * 60 * 60 * 1000));
            $('#age').val(age+' year(s) old');
        }
    }
    $(document).ready(function () {
        var gender = "{!!$profile->gender!!}";
        var religion = "{!!$profile->religion!!}";
        var civilstat = "{!!$profile->civilstat!!}";
        $('.gender option[value="'+gender+'"]').attr("selected", "selected");
        $('.religion option[value="'+religion+'"]').attr("selected", "selected");
        $('.civilstat option[value="'+civilstat+'"]').attr("selected", "selected");
        age(dobs)
    });
    $('#dob').change(function(){
         age($(this).val())
    });
    function stat(x){
    if (x == 0) document.getElementById("status").style.display = "block";
    else document.getElementById("status").style.display ="none";
    return;
    }
    function solo(s){
    if (s == 0) document.getElementById("solopar").style.display = "block";
    else document.getElementById("solopar").style.display ="none";
    return;
    }
    $( ".btn-edit-profile" ).on( "click", function() {
        $('.btn-save-profile').removeClass('d-none')
        $('.dropzone').removeClass('d-none')
        $("#applicant-info-form").css({ 'pointer-events' : ''});
    } );
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


