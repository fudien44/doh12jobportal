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
    <div class="container">
        <div class="row">
           <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                <h4>Applicant Profile</h4>
                    <hr> 
                    <div class="row">
	        <div class="col-md-4">
            @if($users->profile->picture_link)
            <img src="{{ asset('storage/app/public') }}/{{$users->profile->picture_link}}" alt="photo will appear here" class="rounded-circle" width="160" />
            @else
            <img src="{{ asset('public/img/profile.png') }}" alt="user" class="rounded-circle" width="160">
            @endif
            <div class="col-md-8">
		  <h2 class="text-primary">{{$users->fname}} {{$users->mname}} {{$users->lname}}</h2>
	     </div>
         <div class="col-md-8">
            <input type="file" name="picture_link" class="form-control"> <br>
                <img src="{{ asset('storage/app/public' .Auth::user()->picture_link) }}" class="w-60" alt=""> 
            </div> 
            <div class="col-md-3">
            <button type="edit" class="btn btn-primary btn-block">Edit</button><br>
            </div>
        </div>
            <br>
<div class="row">
	<div class="col-md-12">
		<form id="applicant-info-form" method="POST">
		{{csrf_field()}}
		    <div class="card-body">
            <input type="hidden" name="profile_id" value="{{$profile_id}}">
            <table id="applicant-info-table" class="table table-bordered table-hover">
            <tr>
					<th colspan="5">APPLICANT PROFILE</th>
				</tr>
				<tr>
        <td colspan="2">	
			<div class="col-md-10">
				<h6 class="card-subtitle req-field">Extension:</h6>
				    <div class="form-group">
				        <input type="text" class="form-control required" name="extension" required>
				    </div>
                </div>
        	<div class="col-md-10">
				<h6 class="card-subtitle req-field">Date of Birth:</h6>
				    <div class="form-group">
				        <input type="date" class="form-control required" name="dob" required>
				    </div>
				</div>
            </td>
            <td colspan="2">
            <div class="col-md-10">
				<h6 class="card-subtitle req-field">Age:</h6>
				    <div class="form-group">
                              <input type="text" class="form-control required" name="age" required>
				          </div>
				     </div>
            <div class="col-md-10">
				<h6 class="card-subtitle req-field">Gender:</h6>
              <select class="form-control-lg select2 gender" name="gender" required>
                <option selected value="">Select Gender</option>
                <option value="0">Male</option>
                <option value="1">Famale</option>
                <option value="2">Transgender</option>
                <option value="3">Prefer not to say</option>
              </select>
            </div>
          </div>
              </td>
        <td colspan="2">
            <div class="col-md-10">
                    <div class="form-group">
                            <h6>Sex:</h6>
						        <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="sex" value="1">
                                        <label class="form-check-label">Male</label>
                                </div>
                            </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="sex" value="0">
                            <label class="form-check-label">Female</label>
						</div>
                    </div>
                </td>
            <tr>
                </tr> 
            <td colspan="2">
            <div class="col-md-10">
				<h6 class="card-subtitle req-field">Ethnicity:</h6>
				    <div class="form-group">
				        <input type="text" class="form-control required" name="ethnicity" required>
				    </div>
				</div>
            <div class="col-md-10">
				<h6 class="card-subtitle req-field">Religion:</h6>
              <select class="form-control-lg select2 religion" name="religion" required>
                <option selected value="">Select Religion</option>
                <option value="0">Roman Catholic</option>
                <option value="1">Islam</option>
                <option value="2">Protestants</option>
              </select>
            </div>
          </div>
        </td>
        <td colspan="2">	
			<div class="col-md-10">
				<h6 class="card-subtitle req-field">Address:</h6>
				    <div class="form-group">
				        <input type="text" class="form-control required" name="address" required>
				    </div>
                </div>
        	<div class="col-md-10">
				<h6 class="card-subtitle req-field">Contact Number:</h6>
				    <div class="form-group">
				        <input type="text" class="form-control required" name="contacnum" required>
				    </div>
				</div>
            </td>
        <td colspan="2">	
			<div class="col-md-10">
				<h6 class="card-subtitle req-field">Email Address:</h6>
				    <div class="form-group">
				        <input type="text" class="form-control required" name="email" required>
				    </div>
                </div>
        	<div class="col-md-10">
				<h6 class="card-subtitle req-field">Course Title:</h6>
				    <div class="form-group">
				        <input type="text" class="form-control required" name="course" required>
				    </div>
				</div>
            </td>
            <tr>
            </tr>
        <td colspan="2">	
			<div class="col-md-10">
				<h6 class="card-subtitle req-field">Name Of School/University:</h6>
				    <div class="form-group">
				        <input type="text" class="form-control required" name="school" required>
				    </div>
                </div>
        	<div class="col-md-10">
				<h6 class="card-subtitle req-field">Eligibility/License/Honor Graduate (If Applicable):</h6>
				    <div class="form-group">
				        <input type="text" class="form-control required" name="eligibility" required>
				    </div>
				</div>
            </td>
            <td colspan="2">
            <div class="col-md-10">
				<h6 class="card-subtitle req-field">Civil Status:</h6>
              <select class="form-control-lg select2 civilstat" name="civilstat" required>
                <option selected value="">Select Status</option>
                <option value="0">Single</option>
                <option value="1">Married</option>
                <option value="2">Separated</option>
                <option value="3">Widowed</option>
              </select>
            </div>
          </div>
        </td>
        <td colspan="2">
			<div class="col-md-10">
				<h6 class="card-subtitle req-field">PWD (If Applicable Please Specify I.D. No.):</h6>
				    <div class="form-group">
				    </div>
						<div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="pwd"value="1">
                            <label class="form-check-label">No</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="pwd"value="0">
                            <label class="form-check-label">Yes</label>
                        </div>
                        <div class="form-group">
				        <input type="text" class="form-control required" name="pwd" required>
				    </div>
                    </div>
                    <div class="col-md-10">
				<h6 class="card-subtitle req-field">Solo Parent (If Applicable Please Specify I.D. No.):</h6>
				    <div class="form-group">
				    </div>
						<div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="soloparent"value="1">
                            <label class="form-check-label">No</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="soloparent"value="0">
                            <label class="form-check-label">Yes</label>
                        </div>
                        <div class="form-group">
				        <input type="text" class="form-control required" name="soloparent" required>
				    </div>
                    </div>
                <tr>
                </tr>      
                </table>
            </tr>
        	    <div class="col-md-15">
				    <h6 class="card-subtitle req-field">Work Experience:</h6>
				        <div class="form-group">
                                 <textarea class="summernote workexp" name="work_experience">
                                </textarea>
                            </div>
                        </div>
        	    <div class="col-md-15">
				    <h6 class="card-subtitle req-field">Training:</h6>
				        <div class="form-group">
                             <textarea class="summernote training" name="training">
                         </textarea>
                        </div>
                    </div>
                    <div class="col-md-2">
                            <div>
                                <button type="submit" class="btn btn-primary btn-block">Update</button>
                            </div>
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
      $('.summernote').summernote({
        height: 100,
        codemirror: {
          theme: 'paper'
        }
      })
      $('.datemask').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
      $('.select2').select2()
        $("#applicant-info-table").DataTable({
          "responsive": true, "lengthChange": false, "autoWidth": false,
          "buttons": ["csv", "excel", "pdf", "print"]
        }).buttons().container().appendTo('#applicant-info-table .col-md-6:eq(0)');
    });
    $('#applicant-info-form').on('submit',function(e){
        var url = "{{ secure_url('save-application-update') }}";
        e.preventDefault();
        $(".loading").show();
        $('#applicant-info-form').ajaxSubmit({
            url:  url,
            type: "post",
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
    $(document).ready(() => {
		$('input[type=radio][name=sex]').change(function() {
		    var id = this.value;
	        var url = "{{ secure_url('save-application-update') }}";
	        $.ajax({
	            async: true,
	            url: url,
	            type: 'post',
	            data: {
	                id: id
	            },
	            success : function(data){
	                $('.select-position').empty();
	                var val = JSON.parse(data);
                    $(".select-position").append('<option value="">Choose...</option>').change();
                    $.each(val,function(key,value){
                    	var item = value.item_no ? '(ITEMNO: '+value.item_no+')': '';
                        $('.select-position').append($("<option/>", {
                           value: value.id,
                           text: value.position+item
                        }));
                    });
	            }
				
	        });
		});
    });
    $( ".gender" ).change(function() {
        var id = $(this).val();
        var url = "{{ secure_url('/select-section') }}";
        $.ajax({
            async: true,
            url: url,
            type: 'GET',
            data: {
                id: id
            },
            success : function(data){
                $('.section_id').empty();
                var val = JSON.parse(data);
                if(val.length > 0) {
                    $(".section_id").append('<option value="">Select section</option>').change();
                    $.each(val,function(key,value){
                        $('.section_id').append($("<option/>", {
                           value: value.id,
                           text: value.station
                        }));
                    });
                } else {
                    $.toast({
                        heading: 'Error',
                        text: 'No section found',
                        showHideTransition: 'fade',
                        position: 'top-center',
                        icon: 'error'
                    })
                }
            }
        });
    });
    function stat(x){
	if (x == 0) document.getElementById("pwd").style.display = "block";
	else document.getElementById("pwd").style.display ="none";
	return;
	}
    function stat(x){
	if (x == 0) document.getElementById("soloparent").style.display = "block";
	else document.getElementById("soloparent").style.display ="none";
	return;
	}
    $(document).ready(function() {
        var age = "";
        $('#dob').datepicker({
            onSelect: function(value, ui) {
                var today = new Date();
                age = today.getFullYear() - ui.selectedYear;
                $('#age').val(age);
            },
            changeMonth: true,
            changeYear: true
        })
    })
</script>
  @endsection


