<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Member;
use App\Project;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $projects = Auth::user()->projects;
        $requests = Member::where('user_id',Auth::id())->where('is_join',NULL)->get();
        $tasks = Auth::user()->tasks;

        return view('home', ['projects'=>$projects, 'requests'=>$requests, 'tasks'=>$tasks]);
    }
}
