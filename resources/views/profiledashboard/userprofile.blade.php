@extends('layouts.master')
@section('content')

<section class="py-5">
    <div class="container">
        <div class="row">
           <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h4>Applicant Profile</h4>
                    <hr> 
                    <div class="col-md-6">
                        <input type="file" name="picture_link" class="form-control"> <br>
                            <img src="{{ asset('uploads/profile/' .Auth::user()->picture_link) }}" class="w-75" alt=""> 
                            </div>  
                        </div>
                        <div class="col-md-8">
		                        <h2 class="text-primary">{{$users->fname}} {{$users->mname}} {{$users->lname}}</h2>
	                        </div>
                        </div>
                        <div class="col-md-12">
                        <h5><i class="text-success btn-edit" title="Edit Applicant Info"></i></h5>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-12">
                        <form id="applicant-info-form" method="POST">
                        {{csrf_field()}}
                        <input type="hidden" name="applicant_info_id" value="{{$applicant->id}}">
                            <table class="table table-striped table-bordered no-wrap un-click" id="applicant-info-table">
                    <tr>
					<th colspan="4">APPLICANT PROFILE</th>
				</tr>
				<tr>
                <td colspan="2">
						<div class="row">
							<div class="col-md-6">
				            	<h6 class="card-subtitle req-field">Extension:</h6>
				                <div class="form-group">
				                    <input type="text" class="form-control required" name="extension" required>
				                </div>
				            </div>
                        </td>
                    <h5 class="req-field">Gender: </h5>
					</td>
					<td>
						<div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="sex" value="1" required @if($hr && $hr->sex==1)checked @endif>
                            <label class="form-check-label">Male</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="sex" value="0" @if($hr && $hr->sex==0)checked @endif>
                            <label class="form-check-label">Female</label>
							</div>
						</div>		
                        <td colspan="2">
						<div class="row">
							<div class="col-md-6">
				            	<h6 class="card-subtitle req-field">Religion:</h6>
				                <div class="form-group">
				                    <input type="text" class="form-control required" name="religion" required>
				                </div>
				            </div>
                        </td>
                        <td colspan="2">
						<div class="row">
							<div class="col-md-6">
				            	<h6 class="card-subtitle req-field">Ethnicity:</h6>
				                <div class="form-group">
				                    <input type="text" class="form-control required" name="ethnicity" required>
				                </div>
				            </div>
                        </td>
                        <td colspan="2">
						<div class="row">
							<div class="col-md-6">
				            	<h6 class="card-subtitle req-field">Address:</h6>
				                <div class="form-group">
				                    <input type="text" class="form-control required" name="address" required>
				                </div>
				            </div>
                        </td>
                        <td colspan="2">
						<div class="row">
							<div class="col-md-6">
				            	<h6 class="card-subtitle req-field">Highest Education:</h6>
				                <div class="form-group">
				                    <input type="text" class="form-control required" name="highest_education" required>
				                </div>
				            </div>
                        </td>
                        <td colspan="2">
						<div class="row">
							<div class="col-md-6">
				            	<h6 class="card-subtitle req-field">Eligibility:</h6>
				                <div class="form-group">
				                    <input type="text" name="eligibility" class="form-control" value="{{ Auth::user()->eligibility}}">
				                </div>
				            </div>
                        </td>
                        <div class="form-group">
                          <label >Work Experience: </label>
                             <textarea class="summernote jobdesc" name="work_experience" required>
                         </textarea>
                        </div>
                        <div class="form-group">
                          <label >Training: </label>
                             <textarea class="summernote jobdesc" name="training" required>
                         </textarea>
                        </div>
				        </tr>
			            </table>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Update Profile</button>
                                </div>
                            
                            </form> 
                        
                        </div>                    
                    </div>
            </div>
        </div>
    </div>
</section>
@endsection