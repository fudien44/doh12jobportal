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
use App\SalGrade;

use Illuminate\Support\Facades\DB;




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
        $sjobtype = null;
        if(\Auth::user() && \Auth::user()->level == 1) {
            $jobs = Jobs::whereRaw('FIND_IN_SET(?, drp)', \Auth::user()->id)->orderBy('created_at','desc')->get();
            $salary = SalGrade::all();
            $us = User::where('level', 1)->get();
            return view('jobs.jobspost',[
                'jobs' => $jobs,
                'salary' => $salary,
                'us' => $us,
            ]);
        } else {
            $jobs = Jobs::where('status','0');
            $jobs2type = Jobs::where('status','0')->where('term_emp', '2')->count();
            $jobs0type = Jobs::where('status','0')->where('term_emp', '0')->count();
            $jobs1type = Jobs::where('status','0')->where('term_emp', '1')->count();
            if($req->jobs_title) {
                $job_title = $req->jobs_title;
                $jobs = $jobs->where(function($q) use($job_title) {
                    $q->where('job_title', 'like', '%' .$job_title. '%');
                });
                Session::put('sjob',$job_title);
            } else {
                Session::forget('sjob');
            }
            if($req->type) {
                $job_type = base64_decode($req->type);
                $jobs = $jobs->where(function($q) use($job_type) {
                    $q->where('term_emp', $job_type);
                });
                $sjobtype = $job_type;
            }
            $jobsposted = Jobs::all();
            $apps = Application::all();
            $users = User::where('level','!=','2')->get();
            $ct = date('Y-m-d');
            foreach ($jobsposted as $key => $val) {
                $j = Jobs::where('id',$val->id)->first();
                if($j) {
                    if($ct > $j->date_closed) {
                        $j->update(['status' => '1']);
                    }
                }
            }
            $jobs = $jobs->orderBy('date_posted','ASC')->get();



        // Gender Distribution (numeric)
        $maleCount = Profile::where('gender', 0)->count();
        $femaleCount = Profile::where('gender', 1)->count();
        $transgenderCount = Profile::where('gender', 2)->count();
        $twoSpiritCount = Profile::where('gender', 3)->count();
        $cisgenderCount = Profile::where('gender', 4)->count();
        $nonBinaryCount = Profile::where('gender', 5)->count();
        $genderqueerCount = Profile::where('gender', 6)->count();
        $genderExpressionCount = Profile::where('gender', 7)->count();
        $genderFluidCount = Profile::where('gender', 8)->count();
        $genderNeutralCount = Profile::where('gender', 9)->count();
        $preferNotSayCount = Profile::where('gender', 10)->count();

        // Age Distribution
        $today = Carbon::today();
        $age1824 = Profile::whereBetween('dob', [$today->copy()->subYears(24), $today->copy()->subYears(18)])->count();
        $age2529 = Profile::whereBetween('dob', [$today->copy()->subYears(29), $today->copy()->subYears(25)])->count();
        $age3034 = Profile::whereBetween('dob', [$today->copy()->subYears(34), $today->copy()->subYears(30)])->count();
        $age3539 = Profile::whereBetween('dob', [$today->copy()->subYears(39), $today->copy()->subYears(35)])->count();
        $age40plus = Profile::where('dob', '<=', $today->copy()->subYears(40))->count();

        // Education Level Distibution
        $eduNA = Profile::where('highest_education', '0')->count();
        $eduVocational = Profile::where('highest_education', '1')->count();
        $eduCollege = Profile::where('highest_education', '2')->count();
        $eduGraduate = Profile::where('highest_education', '3')->count();


        // Ethinicity To 5
        $topEthnicities = Profile::select('ethnicity', DB::raw('count(*) as total'))
            ->groupBy('ethnicity')
            ->orderByDesc('total')
            ->limit(5)
            ->pluck('total', 'ethnicity'); // ['Filipino' => 25, 'Tagalog' => 10, ...]

        $ethLabels = $topEthnicities->keys()->toArray();
        $ethData = $topEthnicities->values()->toArray();

        // PWD status 
        $pwdCount = Profile::where('is_pwd', 0)->count(); // 1 = PWD
        $nonPwdCount = Profile::where('is_pwd', 1)->count();

        // Solo Parent  
        $soloYes = Profile::where('is_solpar', 0)->count();
        $soloNo = Profile::where('is_solpar', 1)->count();

        // Religion
        $topReligions = Profile::select('religion', DB::raw('count(*) as total'))
            ->groupBy('religion')
            ->orderByDesc('total')
            ->limit(5)
            ->pluck('total', 'religion'); // ['CATHO' => 50, 'AGLIP' => 20, ...]

        $relLabels = $topReligions->keys()->toArray();
        $relData = $topReligions->values()->toArray();


            return view('home', [
                'jobs' => $jobs,
                'jobsposted' => $jobsposted,
                'users' => $users,
                'apps' => $apps,
                'jobs2type' => $jobs2type,
                'jobs0type' => $jobs0type,
                'jobs1type' => $jobs1type,
                'sjobtype' => $sjobtype,
                'maleCount' => $maleCount, // gender
                'femaleCount' => $femaleCount,
                'transgenderCount' => $transgenderCount,
                'twoSpiritCount' => $twoSpiritCount,
                'cisgenderCount' => $cisgenderCount,
                'nonBinaryCount' => $nonBinaryCount,
                'genderqueerCount' => $genderqueerCount,
                'genderExpressionCount' => $genderExpressionCount,
                'genderFluidCount' => $genderFluidCount,
                'genderNeutralCount' => $genderNeutralCount,
                'preferNotSayCount' => $preferNotSayCount,
                'age1824' => $age1824, // age
                'age2529' => $age2529,
                'age3034' => $age3034,
                'age3539' => $age3539,
                'age40plus' => $age40plus,
                'eduNA' => $eduNA, // education
                'eduVocational' => $eduVocational,
                'eduCollege' => $eduCollege,
                'eduGraduate' => $eduGraduate,
                'ethLabels' => $ethLabels, //ethnicity
                'ethData' => $ethData,
                'pwdCount' => $pwdCount, // pwd
                'nonPwdCount' => $nonPwdCount,
                'soloYes' => $soloYes, //solo parent
                'soloNo' => $soloNo,
                'relLabels' => $relLabels, //religion
                'relData' => $relData,
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
