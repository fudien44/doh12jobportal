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
  	<div class="col-sm-3">
  		<div class="card card-success card-outline">
          <div class="card-body box-profile">
            <div class="text-center">
              @if($users->profile && $users->profile->picture_link)
                <img class="img-circle profile-picture" src="{{ asset('storage/app/public')}}/{{$users->id}}/{{$users->profile->picture_link}}" alt="User Avatar" width="120">
                @else
                <img class="img-circle" src="{{ asset('public/img/profile.png') }}" alt="User Avatar" width="120">
                @endif
            </div>

            <h3 class="profile-username text-center">{{$users->fname}} {{$users->lname}}</h3>

            <p class="text-muted text-center">Applicant</p>

            <ul class="list-group list-group-unbordered mb-3">
              <li class="list-group-item">
                <b>Email</b> <a class="float-right">{!! $users->email ?? '<small class="badge badge-danger" style="cursor: pointer;"><i class="fas fa-exclamation"></i></small>' !!}</a>
              </li>
              <li class="list-group-item">
                <b>Contact No</b> <a class="float-right">{!! $users->contactno ?? '<small class="badge badge-danger" style="cursor: pointer;"><i class="fas fa-exclamation"></i></small>' !!}</a>
              </li>
            </ul>
          </div>
          <!-- /.card-body -->
        </div>
  	</div>
    <div class="col-sm-9">
      <div class="card card-outline card-success">
        <div class="card-header">
          <h3 class="card-title text-gray text-xl font-weight-bold">Attachment Review</h3>
          <div class="card-tools">
            <a href="{{ url()->previous() }}" class="btn btn-danger"><i class="fas fa-arrow-left"></i> BACK
            </a>
            @if($job->status=='0' || $job->status=='2')
            @if(Auth::user() && Auth::user()->level == 0)
            <a href="{{asset('/jobs/apply')}}?job={{base64_encode($job->id)}}" class="btn btn-success">CONFIRM APPLY
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
          <p>Please review your attachments: Personal Data Sheet(CS Form No. 212 Revised 2017), CSC Work Experience Sheet, Training Certificates, Diploma & Transcript of Record, Certificate of Employment, Eligibility/PRC/Board Rating, IPCR/Performance Evaluation, Other Documents</p>
          <code>Note: If an attachment is missing, kindly update it through your </code><a href="{{asset('/my-profile')}}">Profile <i class="fas fa-external-link-alt"></i></a>
          @if($users->pds->count() == 0)
          <br>
          <small class="badge badge-danger" style="cursor: pointer;"><i class="fas fa-exclamation-circle"></i> Missing: Personal Data Sheet(CS Form No. 212 Revised 2017)</small>
          @endif
          @if($users->wes->count() == 0)
          <br>
          <small class="badge badge-danger" style="cursor: pointer;"><i class="fas fa-exclamation-circle"></i> Missing: CSC Work Experience Sheet(Optional)</small>
          @endif
          @if($users->tc->count() == 0)
          <br>
          <small class="badge badge-danger" style="cursor: pointer;"><i class="fas fa-exclamation-circle"></i> Missing: Training Certificates(Optional)</small>
          @endif
          @if($users->tor->count() == 0)
          <br>
          <small class="badge badge-danger" style="cursor: pointer;"><i class="fas fa-exclamation-circle"></i> Missing: Diploma & Transcript of Record(Optional)</small>
          @endif
          @if($users->coe->count() == 0)
          <br>
          <small class="badge badge-danger" style="cursor: pointer;"><i class="fas fa-exclamation-circle"></i> Missing: Certificate of Employment(Optional)</small>
          @endif
          @if($users->elig->count() == 0)
          <br>
          <small class="badge badge-danger" style="cursor: pointer;"><i class="fas fa-exclamation-circle"></i> Missing: Eligibility/PRC/Board Rating(Optional)</small>
          @endif
          @if($users->ipcr->count() == 0)
          <br>
          <small class="badge badge-danger" style="cursor: pointer;"><i class="fas fa-exclamation-circle"></i> Missing: IPCR/Performance Evaluation(Optional)</small>
          @endif
          @if($users->odoc->count() == 0)
          <br>
          <small class="badge badge-danger" style="cursor: pointer;"><i class="fas fa-exclamation-circle"></i> Missing: Other Supporting Documents(Optional)</small>
          @endif
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
        </div>
        <!-- /.card-body -->
      </div>
    </div>
  </div>
</div>
@endsection
@section('js')
@endsection