<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AppController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index( $id = 1 )
    {
        return view('app_home', ['app_id'=> $id]);
    }

    public function create()
    {
        return view('app_create');
    }

    public function screen( $id = 1 )
    {
        return view('task_screen', ['app_id'=> $id]);
    }

    public function detail( $id = 1 )
    {
        return view('task_detail', ['app_id'=> $id]);
    }

    public function design( $id = 1 )
    {
        return view('design', ['app_id'=> $id]);
    }
}
