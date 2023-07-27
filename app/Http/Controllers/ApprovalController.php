<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApprovalController extends Controller
{
    public function home()
    {
        return view('approval.home');
    }
    public function post()
    {
        return view('approval.post');
    }
}
