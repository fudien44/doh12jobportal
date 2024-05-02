<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Section;
class FnctnCtrl extends Controller
{
    public function selectSection(Request $req) {
        $sec = Section::where('office',$req->id)->get();
        return json_encode($sec);
    }
}
