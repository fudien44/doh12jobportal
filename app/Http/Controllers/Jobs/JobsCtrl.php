<?php

namespace App\Http\Controllers\Jobs;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\File;
use App\Message;
use App\Jobs;
use App\Division;
use App\Section;
use App\SalGrade;
use App\Application;
use App\AppLetter;
use Auth;
use Storage;
use App\User;
use App\Profile;
use PDF;
use Carbon\Carbon;
class JobsCtrl extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }

    public function jobposting(Request $req) {
    	$jobs = Jobs::orderBy('date_posted','desc')->get();
    	$salary = SalGrade::all();
        $us = User::where('level', 1)->get();
    	return view('jobs.jobspost',[
    		'jobs' => $jobs,
    		'salary' => $salary,
            'us' => $us,
    	]);
    }
    public function aeJobPost(Request $req) {
        $drp = $req->drp != null ? implode(',', $req->drp) : '';
    	$jobs = array(
    		"division_id" => $req->division_id,
    		"section_id" => $req->section_id,
    		"job_title" => $req->job_title,
            "area_ass" => $req->area_ass,
            "item_no" => $req->item_no,
    		"job_description" => $req->job_description,
    		"salary_grade" => $req->salary_grade,
    		"monthly_salary" => $req->monthly_salary,
    		"type_job" => $req->type_job,
    		"term_emp" => $req->term_emp,
    		"eligibility" => $req->eligibility,
    		"highest_education" => $req->highest_education,
    		"education" => $req->education,
    		"training" => $req->training,
    		"experience" => $req->experience,
    		"date_posted" => date('Y-m-d',strtotime($req->date_posted)),
    		"date_closed" => date('Y-m-d',strtotime($req->date_closed)),
    		"status" => $req->status,
    		"instruction" => $req->instruction,
            "add_req" => $req->add_req,
            'drp' => $drp,
    	);
    	if($req->post_id) {
    		$job = Jobs::find($req->post_id);
    		$job->update($jobs);
    		Session::put('action_made','Successfully updated job.');
    	} else {
    		$job = Jobs::create($jobs);
    		Session::put('action_made','Successfully added job.');
    	}
        $piclink = $req->file('attach');
        if($req->hasfile('attach'))
        {
            $filename = 'job'.str_random(8).'.'.$piclink->getClientOriginalExtension();
            $path = "public/jobs/".$filename;
            Storage::disk('local')->put($path, file_get_contents($piclink));
            $job->update([
                'attach' => $filename
            ]);
        }
    }
    public function jobsEdit($id) {
    	$jobs = Jobs::find($id);
    	if($jobs) {
    		return json_encode($jobs);
    	} else {
    		return 'none';
    	}
    }
    public function jobsapply(Request $req) {
        $jobid = base64_decode($req->job);
        $ct = date('Y-m-d');
        $user = Auth::user();
        $j = Jobs::find($jobid);
        if($user) {
            if(!$user->profile) {
                Session::put('is_applied', 'Please Finish your profile');
            } else if(!$user->pds) {
                Session::put('is_applied', 'Please provide Personal Data Sheet');
            } else if(!$user->tor) {
                Session::put('is_applied', 'Please provide Transcript of Record');
            } else if($j) {
                if($ct > $j->date_closed) {
                    $j->update(['status' => '1']);
                    Session::put('is_applied', 'This position has already been filled. Thank you for your application.');
                } else {
                    $data = array(
                        'user_id' => $user->id,
                        'job_id' => $jobid,
                    );
                    $app = Application::where('job_id',$jobid)->where('user_id', $user->id)->first();
                    if($app) {
                        Session::put('is_applied', 'You already applied to this job.');
                    } else if($jobid) {
                        $jobs = Application::create($data);
                        Session::put('is_applied', 'Successfully applied to this job.');
                    }
                }
            } else {
                $data = array(
                    'user_id' => $user->id,
                    'job_id' => $jobid,
                );
                $app = Application::where('job_id',$jobid)->where('user_id', $user->id)->first();
                if($app) {
                    Session::put('is_applied', 'You already applied to this job.');
                } else if($jobid) {
                    $jobs = Application::create($data);
                    Session::put('is_applied', 'Successfully applied to this job.');
                }
            }
            return view('jobs.jobsapply', [
               'user' => $user
            ]);
        } else {
            echo 'AUTHORIZATION FAILED';
        }
    }
    public function appLetter(Request $req) {
        $user = Auth::user();
        if($req->hasfile('app_letter_name')) {
            if($req->file('app_letter_name')->getClientMimeType() === 'application/pdf') {
                $app_letter = $req->file('app_letter_name');
                $filename = $user->id.$user->lname.str_random(5).'.'.$app_letter->getClientOriginalExtension();
                $path = "public/".$user->id.'/'.$filename;
                $app = Application::find($req->app_id);
                if($app) {
                    Storage::disk('local')->put($path, file_get_contents($app_letter));
                    $data = array(
                        'app_id' => $app->id,
                        'file_name' => $req->file_name,
                        'file_upload' => $filename,
                    );
                    AppLetter::create($data);
                    Session::put('action_made', 'Successfully added application letter.');
                }
            } else {
                Session::put('action_made', 'Something went wrong.');
            }
        }
    }
    public function applicants(Request $req) {
        $apps = User::where('level', '!=', '2')->orderBy('lname','asc')->get();
        return view('jobs.applicants',[
            'apps' => $apps
        ]);
    }
    public function getAppLetter(Request $req) {
        $apps = Application::find($req->id);
        return view('jobs.applicants.appletter',[
            'apps' => $apps
        ]);
    }
    public function message(Request $req) {
        $app = Application::find($req->app_id);
        if($app) {
            $name = $req->to_name;
            $data = array(
                "app_id" => $app->id,
                "subject" => $req->subject,
                "message" => $req->message,
                "type_message" => $req->type_message,
            );
            $app->update([
                'status' => $req->type_message,
            ]);
            Message::create($data);
            $message = $req->message;
            $em = array(
                'name'=> $name,
                'msg' => $message,
            );
            $email = $app->applicant->email;
            $subject = $req->subject;
            Mail::send('emails.message', $em, function($message) use ($name, $email,$subject) {
            $message->to($email, $name)
            ->subject($subject);
            $message->from('doh12personnel@gmail.com','DOH XII JOB PORTAL');
            });
            Session::put('action_made', 'Successfully send message to applicant email.');
        }
    }
    public function trackMessage($id) {
        $app = Application::find($id);
        $user = Auth::user();
        if($app) {
            if($app->user_id == $user->id) {
                return view('jobs.applicants.track', [
                    'apps' => $app
                ]);
            }
        }
    }
    public function listApps(Request $req) {
        $appid = base64_decode($req->job);
        $app = Jobs::find($appid);
        if($app) {
            Session::put('job', $app);
            return view('jobs.applicants.applicant', [
                'apps' => $app,
                'appid' => $appid
            ]);
        }
    }
    public function getAppProfile(Request $req) {
        $user = User::find($req->id);
        if($user) {
            if($user->profile) {
                return view('jobs.applicants.profile', [
                    'users' => $user,
                    'profile' => $user->profile
                ]);
            } else {
                return '<b>No profile found.</b>';
            }
        } else {
            return '<b>No profile found.</b>';
        }
    }
    public function attendance(Request $req) {
        $filename = 'attendance'.date('mdYHis');
        $pdf = PDF::loadView('print.attendance');
        $pdf->setPaper('a4', 'landscape');
        return $pdf->stream($filename.'.pdf');
    }
    public function attInter(Request $req) {
        $filename = 'attendance'.date('mdYHis');
        $pdf = PDF::loadView('print.attinter');
        $pdf->setPaper('a4', 'landscape');
        return $pdf->stream($filename.'.pdf');
    }
    public function AppProfilev2(Request $req) {
        $user = User::find(base64_decode($req->uid));
        if($user) {
            if($user->profile) {
                return view('jobs.applicants.profilev2', [
                    'users' => $user,
                    'profile' => $user->profile
                ]);
            } else {
                return '<b>No profile found.</b>';
            }
        } else {
            return '<b>No profile found.</b>';
        }
    }

}
