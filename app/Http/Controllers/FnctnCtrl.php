<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Section;
use App\User;
class FnctnCtrl extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function selectSection(Request $req) {
        $sec = Section::where('office',$req->id)->get();
        return json_encode($sec);
    }
    public function storeUser(Request $req) {
        $user = array(
            'fname' => $req->fname,
            'lname' => $req->lname,
            'mname' => $req->mname,
            'level' => $req->level,
            'email' => $req->email,
            'password' => \Hash::make($req->password),
            'email_verified_at' => date('Y-m-d'),
            'contactno' => '09515359406',
            'void' => true,
        );
        if($req->user_id) {
            $us = User::find($req->user_id);
            $us->update($user);
            Session::put('action_made','Successfully updated user.');
        } else {
            $us = User::create($user);
            Session::put('action_made','Successfully added user.');
        }
    }
    public function editUser(Request $req,$id) {
        $us = User::find($id);
        if($us) {
            return json_encode($us);
        } else {
            return 'none';
        }
    }
}
