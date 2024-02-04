<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MyCourseViewController extends Controller
{
    //
    public function index(){
        $user = Auth::user();
        return view('vendor.voyager.my-courses-view.browse', compact('user'));
    }
}
