<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\User;
use App\Profile;
use Storage;
use App\EligFile;
use App\OtherFile;
use App\TorFile;
use App\PdsFile;
use App\Coe;
use App\Ipcr;
use App\Tc;
use App\Wes;
class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function myprofile()
    {
        $user = Auth::user();
        if(!$user->profile) {
            $data = array(
              'user_id' => $user->id,  
            );
            $profile = Profile::create($data);
        } else {
            $profile = $user->profile;
        }
        return view('profiledashboard.applicant', [
            'users' => $user,
            'profile' => $profile
        ]);
    }
    public function applicationupdate(Request $request)
    {
        $profile_id = $request->profile_id;
        $user_id = Auth::user()->id;
        $user = Profile::findOrFail($profile_id);
        $u = Auth::user();
        $users = User::where('id','!=', $user_id)->get();
        foreach ($users as $key => $value) {
           if($value->email == $request->email) {
            return 'email';
           }
        }   
        if($u) {
            $data = array(
                'fname' => $request->fname,
                'mname' => $request->mname,
                'lname' => $request->lname,
                'email' => $request->email,
                'contactno' => $request->contactno,
                'email_verified_at' => null,
            );
            $u->update($data);
        } 
        if($user) {
            $user->user_id = $user_id;
            $user->extension = $request->Input('extension');
            $user->dob = $request->Input('dob');
            $user->gender = $request->Input('gender');
            $user->religion = $request->Input('religion');
            $user->civilstat = $request->Input('civilstat');
            $user->ethnicity = $request->Input('ethnicity');
            $user->address = $request->Input('address');
            $user->course = $request->Input('course');
            $user->school = $request->Input('school');
            $user->highest_education = $request->Input('highest_education');
            $user->is_pwd = $request->Input('is_pwd');
            $user->is_solpar = $request->Input('is_solpar');
            $user->pwd_no = $request->Input('pwd_no');
            $user->soloparent_no = $request->Input('soloparent_no');
            $user->eligibility= $request->Input('eligibility',);
            $user->work_experience = $request->Input('work_experience');
            $user->training = $request->Input('training');
        }
        $us = $user->update();
        $piclink = $request->file('picture_link');
        if($request->hasfile('picture_link'))
        {
            $filename = 'Profile'.$user_id.$u->lname.str_random(5).'.'.$piclink->getClientOriginalExtension();
            $path = "public/".$user_id.'/'.$filename;
            Storage::disk('local')->put($path, file_get_contents($piclink));
            $user->update([
                'picture_link' => $filename
            ]);
        }
        $pds = $request->file('mypds');
        $tor = $request->file('mytor');
        $elig = $request->file('myelig');
        $other = $request->file('myother');
        $wes = $request->file('mywes');
        $tc = $request->file('mytc');
        $coe = $request->file('mycoe');
        $ipcr = $request->file('myipcr');
        if($request->hasFile('mywes')) {
            foreach ($wes as $key => $val) {
                if($val->getClientMimeType() === 'application/pdf') {
                    $filename = 'wes'.$user_id.$u->lname.str_random(5).'.'.$val->getClientOriginalExtension();
                    $path = "public/".$user_id.'/'.$filename;
                    Storage::disk('local')->put($path, file_get_contents($val));
                    Wes::create([
                        'user_id' => $user_id,
                        'filename' => $filename
                    ]);
                }
            }
        }if($request->hasFile('mytc')) {
            foreach ($tc as $key => $val) {
                if($val->getClientMimeType() === 'application/pdf') {
                    $filename = 'tc'.$user_id.$u->lname.str_random(5).'.'.$val->getClientOriginalExtension();
                    $path = "public/".$user_id.'/'.$filename;
                    Storage::disk('local')->put($path, file_get_contents($val));
                    Tc::create([
                        'user_id' => $user_id,
                        'filename' => $filename
                    ]);
                }
            }
        }if($request->hasFile('mycoe')) {
            foreach ($coe as $key => $val) {
                if($val->getClientMimeType() === 'application/pdf') {
                    $filename = 'mycoe'.$user_id.$u->lname.str_random(5).'.'.$val->getClientOriginalExtension();
                    $path = "public/".$user_id.'/'.$filename;
                    Storage::disk('local')->put($path, file_get_contents($val));
                    Coe::create([
                        'user_id' => $user_id,
                        'filename' => $filename
                    ]);
                }
            }
        }if($request->hasFile('myipcr')) {
            foreach ($ipcr as $key => $val) {
                if($val->getClientMimeType() === 'application/pdf') {
                    $filename = 'mypds'.$user_id.$u->lname.str_random(5).'.'.$val->getClientOriginalExtension();
                    $path = "public/".$user_id.'/'.$filename;
                    Storage::disk('local')->put($path, file_get_contents($val));
                    Ipcr::create([
                        'user_id' => $user_id,
                        'filename' => $filename
                    ]);
                }
            }
        }if($request->hasFile('mypds')) {
            foreach ($pds as $key => $val) {
                if($val->getClientMimeType() === 'application/pdf') {
                    $filename = 'mypds'.$user_id.$u->lname.str_random(5).'.'.$val->getClientOriginalExtension();
                    $path = "public/".$user_id.'/'.$filename;
                    Storage::disk('local')->put($path, file_get_contents($val));
                    PdsFile::create([
                        'user_id' => $user_id,
                        'filename' => $filename
                    ]);
                }
            }
        } if($request->hasFile('mytor')) {
            foreach ($tor as $key => $value) {
                if($value->getClientMimeType() === 'application/pdf') {
                    $filename = 'mytor'.$user_id.$u->lname.str_random(5).'.'.$value->getClientOriginalExtension();
                    $path = "public/".$user_id.'/'.$filename;
                    Storage::disk('local')->put($path, file_get_contents($value));
                    TorFile::create([
                        'user_id' => $user_id,
                        'filename' => $filename
                    ]);
                }
            }
        } if($request->hasFile('myelig')) {
            foreach ($elig as $key => $value) {
                if($value->getClientMimeType() === 'application/pdf') {
                    $filename = 'myelig'.$user_id.$u->lname.str_random(5).'.'.$value->getClientOriginalExtension();
                    $path = "public/".$user_id.'/'.$filename;
                    Storage::disk('local')->put($path, file_get_contents($value));
                    EligFile::create([
                        'user_id' => $user_id,
                        'filename' => $filename
                    ]);
                }
            }
        } if($request->hasFile('myother')) {
            foreach ($other as $key => $value) {
                if($value->getClientMimeType() === 'application/pdf') {
                    $filename = 'myother'.$user_id.$u->lname.str_random(5).'.'.$value->getClientOriginalExtension();
                    $path = "public/".$user_id.'/'.$filename;
                    Storage::disk('local')->put($path, file_get_contents($value));
                    OtherFile::create([
                        'user_id' => $user_id,
                        'filename' => $filename
                    ]);
                }
            }
        }
    }
    public function deletePds(Request $req) {
        $pds = PdsFile::find($req->id);
        if($pds) {
            $pds->delete();
        }
    }
    public function deleteTor(Request $req) {
        $pds = TorFile::find($req->id);
        if($pds) {
            $pds->delete();
        }
    }
    public function deleteElig(Request $req) {
        $pds = EligFile::find($req->id);
        if($pds) {
            $pds->delete();
        }
    }
    public function deleteDoc(Request $req) {
        $pds = OtherFile::find($req->id);
        if($pds) {
            $pds->delete();
        }
    }
}

