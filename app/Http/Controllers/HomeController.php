<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Auth;
use Carbon\Carbon;
use App\Jobs;
use App\Division;
use App\User;
use App\Profile;
use App\Application;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
   
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */


    public function index(Request $req)
    {
        $jobs = Jobs::where('status','0');
        if($req->jobs_title) {
            $job_title = $req->jobs_title;
            $jobs = $jobs->where(function($q) use($job_title) {
                $q->where('job_title', 'like', '%' .$job_title. '%');
            });
            Session::put('sjob',$job_title);
        } else {
            Session::forget('sjob');
        }
        $jobs = $jobs->orderBy('date_posted','ASC')->get();
        $jobsposted = Jobs::all();
        $apps = Application::all();
        $users = User::where('level','!=','2')->get();
        $ct = Carbon::now();
        foreach ($jobsposted as $key => $val) {
            $j = Jobs::where('id',$val->id)->where('status','0')->whereDate('date_closed', '=', $ct)->first();
            if($j && $ct->format('H') == 17) {
                $j->update(['status' => '1']);
            }
        }
        return view('home', [
            'jobs' => $jobs,
            'jobsposted' => $jobsposted,
            'users' => $users,
            'apps' => $apps,
        ]);
        // if (Auth::user() && !Auth::user()->email_verified_at) {
        //     return redirect()->route('otp');
        // }
        // else if(Auth::guest()) {
        //     return view('home', [
        //         'divisions' => $divisions,
        //         'jobs' => $jobs,
        //         'jobsposted' => $jobsposted,
        //         'users' => $users
        //     ]);
        // }
        // else if(Auth::user()->void==0) {
        //     // return redirect()->route('otp');
        //     return view('home', [
        //         'divisions' => $divisions,
        //         'jobs' => $jobs,
        //         'jobsposted' => $jobsposted,
        //         'users' => $users
        //     ]);
        // } else {
        //     return view('home', [
        //         'divisions' => $divisions,
        //         'jobs' => $jobs,
        //         'jobsposted' => $jobsposted,
        //         'users' => $users
        //     ]);
        // }
   
    }
        
    public function otp()
    {
        $otp = rand(100000,999999);
        Session::put("session_otp_login",$otp);
        Session::put("session_otp_valid",Carbon::now());
        $to_name = Auth::user()->fname;
        $to_email = Auth::user()->email;
        $em = array(
            'to_name'=> $to_name,
            'otp' => $otp

        );
        Mail::send('emails.otp', $em, function($message) use ($to_name, $to_email) {
        $message->to($to_email, $to_name)
        ->subject('DOH XII JOB PORTAL OTP');
        $message->from('aronjbra20@gmail.com','DOH XII JOB PORTAL');
        });
        return view('auth.otp');
    }
    public function jobs(Request $req) {
        $div = base64_decode($req->division);
        $division = Division::find($div);
        $status = base64_decode($req->status);
        $jobs = Jobs::where('division_id',$div);
        Session::put('division_id',$div);
        if($status != 'none') {
            $jobs = $jobs->where(function($q) use($status) {
                $q->where('status', $status);
            });
        }
        $jobs = $jobs->orderBy('date_posted','asc')->get();
        return view('jobs.jobs', [
            'division' => $division,
            'section' => $division->section
        ]);
    }
    public function fetchjobs(Request $req) {
        $div = Session::get('division_id');
        $jobs = Jobs::where('division_id',$div);
        if($req->section) {
            $section=$req->section;
            $jobs = $jobs->where(function($q) use($section) {
                $q->where('section_id', $section);
            });
        }
        if($req->typejob) {
            $type = $req->typejob;
            $jobs = $jobs->where(function($q) use($type) {
                $q->where('type_job', $type);
            });
        }
        if($req->term) {
            $term = $req->term;
            $jobs = $jobs->where(function($q) use($term) {
                $q->where('term_emp', $term);
            });
        }
        if($req->status) {
            $status = $req->status;
                $jobs = $jobs->where(function($q) use($status) {
                    $q->where('status', $status);
                });
        }
        if($req->job) {
            $job_title = $req->job;
            $jobs = $jobs->where(function($q) use($job_title) {
                $q->where('job_title', 'like', '%' .$job_title. '%');
            });
        }
        $jobs = $jobs->orderBy('date_posted','ASC')->get();
        return view('jobs.jobsbody', [
            'jobs' => $jobs
        ]);
    }
    public function jobsdescription(Request $req) {
        $job = Jobs::find(base64_decode($req->job));
        Session::put('job_id',base64_decode($req->job));
        return view('jobs.jobdesc',[
            'job' => $job
        ]);
    }
   
}
