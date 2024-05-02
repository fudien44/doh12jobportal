<div class="timeline">
@if(count($apps->msg) > 0)              <!-- timeline time label -->
  @foreach($apps->msg as $msg)
  <div class="time-label">
    <span class="bg-green">{{date('F d,Y', strtotime($msg->created_at))}}</span>
  </div>
  <!-- /.timeline-label -->
  <!-- timeline item -->
  <div>
    <i class="fas fa-envelope bg-blue"></i>
    <div class="timeline-item">
      <span class="time"><i class="fas fa-clock"></i> {{\Carbon\Carbon::parse($msg->created_at)->diffForHumans()}}</span>
      <h3 class="timeline-header text-success font-weight-bold">{{$msg->subject}}</h3>

      <div class="timeline-body">
       {!! $msg->message !!}
      </div>
    </div>
  </div>
  @endforeach
  @else
  <div class="alert alert-danger" role="alert">
      In review
  </div>
  @endif
  <!-- END timeline item -->
</div>