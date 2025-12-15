
<h5>Application Letters</h5>
@if(count($apps->letters) > 0)
@foreach($apps->letters as $a)
<div class="card card-primary card-outline">
    <a class="d-block w-100" data-toggle="collapse" href="#collapse{{$a->id}}">
        <div class="card-header">
            <h4 class="card-title w-100">
                {{$a->file_name }} 
            </h4>
            <br>
            Uploaded: {{\Carbon\Carbon::parse($a->created_at)->format('F d, Y h:i A')}}
        </div>
    </a>
    <div id="collapse{{$a->id}}" class="collapse" data-parent="#application-viewer">
        <div class="card-body">
            <embed src="{{ asset('storage/app/public') }}/{{$apps->user_id}}/{{$a->file_upload}}" frameborder="0" width="100%" height="800px"></embed>
        </div>
    </div>
</div>
@endforeach
@else
<b>No Application Found</b>
@endif
<h5>Status</h5>
@if(count($apps->msg) > 0)
@foreach($apps->msg as $msg)
<div class="card card-primary card-outline">
    <a class="d-block w-100" data-toggle="collapse" href="#collapsemsg{{$msg->id}}">
        <div class="card-header">
            <h4 class="card-title w-100">
                {{$msg->subject}}
            </h4>
            <br>
            Date Sent: {{\Carbon\Carbon::parse($msg->created_at)->format('F d, Y h:i A')}}
        </div>
    </a>
    <div id="collapsemsg{{$msg->id}}" class="collapse" data-parent="#application-viewer">
        <div class="card-body">
            {!! $msg->message !!}
        </div>
         @if($msg->attch->count() > 0)
                    <div class="card-body">
                        <b>Attachments:</b><br/>
                        @foreach($msg->attch as $attachment)
                        <a href="{{ asset('public/storage/attach/'.$attachment->file_name) }}" target="_blank">
                            {{ $attachment->file_name }}
                        </a><br/>
                        @endforeach
                    </div>
                @else
                    <div class="card-body">
                        <b>No Attachments</b>
                    </div>
                @endif
        <div class="modal-footer">
            <button type="button" class="btn btn-danger btn-delete-msg" data-id="{{$msg->id}}">Delete</button>
        </div>
    </div>
</div>
@endforeach
@else
<b>No Message Found</b>
@endif
</div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    <button type="button" class="btn btn-success btn-accept" data-id="{{$apps->id}}">Message</button>
</div>
</div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<div class="modal fade" id="modal-accept-app" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title job-title-modal">Message</h4>
      </div>
      <div class="modal-body">
        <form id="message_accept_form" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="app_id" value="{{$apps->id}}">
        <input type="hidden" name="to_name" value="{{$apps->applicant->fname}} {{mb_substr($apps->applicant->mname, 0, 1)}}. {{$apps->applicant->lname}}">
        <label class="text-success">To: {{$apps->applicant->fname}} {{mb_substr($apps->applicant->mname, 0, 1)}}. {{$apps->applicant->lname}}</label>
        <br>
        <label>Position: {{$apps->job->job_title}}({{$apps->job->sg->salary_grade}})</label><br>
        <label>Item No: {{$apps->job->item_no}}</label><br>
        <div class="form-group">
          <label>Type of Message</label>
          <select class="form-control-lg select2 type_message" name="type_message" required>
            <option selected value="">Select Type of message</option>
            <option value="5">Missing Requirements</option>
            <option value="0">Not Qualified (Based on minimum QS)</option>
            <option value="1">Qualified for Written Examination</option>
            <option value="6">Not Qualified for Interview</option>
            <option value="2">Not Accepted</option>
            <option value="3">For Panel Interview</option>
            <option value="4">Accepted</option>
          </select>
        </div>
        <div class="form-group">
          <label>Subject</label>
          <input type="text" class="form-control form-control-border" name="subject" placeholder="Subject" required>
        </div>
        <div class="form-group">
          <label>Message</label>
          <textarea class="summernote message" name="message" required>
          </textarea>
        </div>
        <div class="form-group">
            <label>Attachments</label><br>
            <input type="file" name="fileupload[]" id="attach-input" multiple accept=".pdf,.docx,.jpeg,.jpg,.png,.xlsx">
        </div>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-success btn-send"><i class="fas fa-paper-plane"></i> Send</button>
        </form>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<script>
    $(function () {
        $('.select2').select2()
    });
    $('.summernote').summernote({
        stylewithSpan: true,
        height: 300,
        codemirror: {
          theme: 'paper'
        },
        toolbar: [
            ['style', ['bold','italic','underline']],
            ['fontsize', ['fontsize']],
        ],
        fontsize: ['8','10','12','14','16','18','24','36'],
        callbacks: {
            onInit: function() {
                $('.summernote').summernote('formatPara',{
                    fontSize: 12
                });
            }

        }
    })
    $( ".btn-accept" ).on( "click", function() {
        $('#modal-accept-app').modal('show')
    });
    $( ".btn-disqualify" ).on( "click", function() {
        $('#modal-decline-app').modal('show')
    });
    $('.btn-delete-msg').on('click', function(e) {
        var id = $(this).data('id');
        var url = "{{ secure_url('/delete-message') }}";
        
        // Show confirmation dialog before proceeding with AJAX
        var confirmation = confirm('Are you sure you want to delete this message?');
        if (!confirmation) {
            return; // Exit if user cancels
        }
        
        e.preventDefault();
        
        $.ajax({
            url: url,
            method: 'POST',
            data: {
                id: id,
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                $(".loading").hide();
                if (response.success) {
                    $.toast({
                        heading: 'Success',
                        text: response.message,
                        showHideTransition: 'fade',
                        position: 'top-center',
                        icon: 'success'
                    });
                    setTimeout(function(){
                        window.location.reload(false);
                    }, 2000);
                } else {
                    $.toast({
                        heading: 'Error',
                        text: response.message || 'Something went wrong, Please contact administrator',
                        showHideTransition: 'fade',
                        position: 'top-center',
                        icon: 'error'
                    });
                }
            },
        });
    });

    $('#message_accept_form').on('submit',function(e){
      var url = "{{ secure_url('/message-applicant') }}";
      e.preventDefault();
      $(".loading").show();
      $('#message_accept_form').ajaxSubmit({
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
</script>