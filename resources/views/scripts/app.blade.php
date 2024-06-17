<script>
	$(function () {
      document.addEventListener('contextmenu', function(e) {
      e.preventDefault();
    });
      document.onkeydown = (e) => {
        if (e.key == 123) {
            e.preventDefault();
        }
        if (e.ctrlKey && e.shiftKey && e.key == 'I') {
            e.preventDefault();
        }
        if (e.ctrlKey && e.shiftKey && e.key == 'C') {
            e.preventDefault();
        }
        if (e.ctrlKey && e.shiftKey && e.key == 'J') {
            e.preventDefault();
        }
        if (e.ctrlKey && e.key == 'U') {
            e.preventDefault();
        }
    };
	});
	@if(Session::get('action_made'))
    $.toast({
        heading: 'Save',
        text: "<?php echo Session::get("action_made");?>",
        position: 'top-center',
    })
    <?php
        Session::put("action_made",false);
    ?>
    @endif
  @if(Session::get('is_applied'))
    $.toast({
        heading: 'Information',
        text: "<?php echo Session::get("is_applied");?>",
        position: 'top-center',
    })
    <?php
        Session::put("is_applied",false);
        Session::put("job_id",false);
    ?>
    @endif
    function formatdate(date) {
      var formattedDate = new Date(date);
      var d = formattedDate.getDate();
      var m =  formattedDate.getMonth();
      m += 1;  // JavaScript months are 0-11
      var y = formattedDate.getFullYear();
      var res = m+"/"+d+"/"+y;
      return res;
    }
    function toggleParticleColor() {
	$('#particles-js').addClass('toggle-color');
 	const newColor = '#B6B6B4';
	$.each(pJSDom[0].pJS.particles.array, function(i,p){
		pJSDom[0].pJS.particles.array[i].color.value = newColor;
		pJSDom[0].pJS.particles.array[i].color.rgb = hexToRgb(newColor);
		pJSDom[0].pJS.particles.line_linked.color_rgb_line = hexToRgb(newColor);
	});
}
var count_particles, stats, update;
stats = new Stats; stats.setMode(0);
stats.domElement.style.position = 'fixed';
stats.domElement.style.left = '0px';
stats.domElement.style.top = '0px';
document.body.appendChild(stats.domElement);
count_particles = document.querySelector('.js-count-particles');
update = function() { stats.begin(); stats.end();
if (window.pJSDom[0].pJS.particles && window.pJSDom[0].pJS.particles.array) {
} requestAnimationFrame(update); }; requestAnimationFrame(update);;
@guest
@else
@if(!Auth::user()->profile && !Request::is('my-profile') && !Request::is('email/verify') && Auth::user()->level == 0)
  $('#modal-profile').modal('show');
@endif
@endguest
</script>