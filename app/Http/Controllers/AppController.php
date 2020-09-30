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
}
