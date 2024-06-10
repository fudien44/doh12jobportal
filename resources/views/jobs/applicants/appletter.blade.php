
<h5>Application Letters</h5>
@if(count($apps->letters) > 0)
@foreach($apps->letters as $a)
<div class="card card-primary card-outline">
    <a class="d-block w-100" data-toggle="collapse" href="#collapse{{$a->id}}">
        <div class="card-header">
            <h4 class="card-title w-100">
                {{$a->file_name}}
            </h4>
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
        </div>
    </a>
    <div id="collapsemsg{{$msg->id}}" class="collapse" data-parent="#application-viewer">
        <div class="card-body">
            {!! $msg->message !!}
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
        <form id="message_accept_form" method="POST">
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
            <option value="1">Qualified for exam</option>
            <option value="2">Not Accepted</option>
            <option value="3">For Interview</option>
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
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-success"><i class="fas fa-paper-plane"></i> Send</button>
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
        height: 300,
        codemirror: {
          theme: 'paper'
        }
    })
    $( ".btn-accept" ).on( "click", function() {
        $('#modal-accept-app').modal('show')
    });
    $( ".btn-disqualify" ).on( "click", function() {
        $('#modal-decline-app').modal('show')
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