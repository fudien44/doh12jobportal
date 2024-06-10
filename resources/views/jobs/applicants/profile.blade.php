<div class="card-body">
    <div class="row">
        <div class="col-md-12 text-center">
            @if($users->profile && $users->profile->picture_link)
            <img src="{{ asset('storage/app/public')}}/{{$users->id}}/{{$users->profile->picture_link}}" alt="photo will appear here" class="rounded-circle profile-picture" width="160" />
            @else
            <img src="{{ asset('public/img/profile.png') }}" alt="user" class="rounded-circle profile-picture" width="160">
            @endif
        </div>
        <div class="col-md-12 text-center">
             <h2 class="text-primary">{{$users->fname}} {{$users->mname}} {{$users->lname}}</h2>
        </div>
        <div class="col-md-12">
            <input type="hidden" name="profile_id" value="{{$profile->id}}">
            <table id="applicant-info-table" class="table table-bordered table-hover">
                <h3>Personal Information</h3>
                <hr>
                <div class="row" style="pointer-events: none;">
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
                </div>
                <div class="row" style="pointer-events: none;">
                    <div class="col-md-4">
                        <h6 class="card-subtitle req-field">Age:</h6>
                        <input type="text" class="form-control form-control-border required" disabled id="age" name="age">
                    </div>
                    <div class="col-md-4">
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
                    <div class="col-md-4">
                        <h6 class="card-subtitle req-field">Ethnicity:</h6>
                        <div class="form-group">
                            <input type="text" class="form-control form-control-border required" name="ethnicity" value="{{$profile->ethnicity}}">
                        </div>
                    </div>
                </div>
                <div class="row" style="pointer-events: none;">
                    <div class="col-md-4">
                        <h6 class="card-subtitle req-field">Religion:</h6>
                          <select class="form-control form-control-border religion" name="religion">
                            <option selected value="">Select Religion</option>
                            <option value="AGLIP">AGLIPAY</option><option value="ALLY">ALLIANCE OF BIBLE CHRISTIAN COMMUNITIES</option><option value="ANGLI">ANGLICAN</option><option value="BAPTI">BAPTIST</option><option value="BRNAG">BORN AGAIN CHRISTIAN</option><option value="BUDDH">BUDDHISM</option><option value="CATHO">CATHOLIC</option><option value="XTIAN">CHRISTIAN</option><option value="CHOG">CHURCH OF GOD</option><option value="EVANG">EVANGELICAL</option><option value="IGNIK">IGLESIA NI CRISTO</option><option value="MUSLI">ISLAM</option><option value="JEWIT">JEHOVAHS WITNESS</option><option value="MORMO">LDS-MORMONS</option><option value="LRCM">LIFE RENEWAL CHRISTIAN MINISTRY</option><option value="LUTHR">LUTHERAN</option><option value="METOD">METHODIST</option><option value="PENTE">PENTECOSTAL</option><option value="PROTE">PROTESTANT</option><option value="SVDAY">SEVENTH DAY ADVENTIST</option><option value="UCCP">UCCP</option><option value="UNKNO">UNKNOWN</option><option value="WESLY">WESLEYAN</option>
                          </select>
                    </div>
                    <div class="col-sm-4">
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
                <br>
                <h3>Contact</h3>
                <hr>
                <div class="row" style="pointer-events: none;">
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
                <div class="row" style="pointer-events: none;">
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
                <div class="row" style="pointer-events: none;">
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
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <h5>Personal Data Sheet(CS Form No. 212, Revised 2017)</h5>
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
                        <hr>
                     </div>
                     <div class="col-sm-12">
                        <h5>CSC Work Experience Sheet</h5>
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
                        <hr>
                     </div>
                     <div class="col-sm-12">
                        <h5>Training Certificates</h5>
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
                        <hr>
                     </div>
                     <div class="col-sm-12">
                        <h5>Diploma & Transcript of Record</h5>
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
                        <hr>
                     </div>
                     <div class="col-sm-12">
                        <h5>Certificate of Employment</h5>
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
                        <hr>
                     </div>
                     <div class="col-sm-12">
                        <h5>Eligibility/PRC/Board Rating</h5>
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
                        <hr>
                     </div>
                     <div class="col-sm-12">
                        <h5>IPCR/Performance Evaluation</h5>
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
                        <hr>
                     </div>
                     <div class="col-sm-12">
                        <h5>Other Supporting Documents</h5> 
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
                        <hr>
                     </div>
                </div>
            </table>
        </div>
    </div>
</div>
<script>
    function age(dob) {
        dob = new Date(dob);
        var today = new Date();
        var age = Math.floor((today-dob) / (365.25 * 24 * 60 * 60 * 1000));
        $('#age').val(age+' year(s) old');
    }
    $('.summernote').summernote('disable')
    var dobs = $('#dob').val();
    $(function() {
        var gender = "{!!$profile->gender!!}";
        var religion = "{!!$profile->religion!!}";
        var civilstat = "{!!$profile->civilstat!!}";
        $('.gender option[value="'+gender+'"]').attr("selected", "selected");
        $('.religion option[value="'+religion+'"]').attr("selected", "selected");
        $('.civilstat option[value="'+civilstat+'"]').attr("selected", "selected");
        age(dobs)
    });
</script>