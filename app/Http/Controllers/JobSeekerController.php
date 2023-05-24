<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class JobSeekerController extends Controller
{
    public function index(): View
    {
        return view('job-seeker.index');
    }
}
