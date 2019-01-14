<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller; 

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
       
    }

    /**
     * Show the application Login Page.
     *
     * @return \Illuminate\Http\Response
     */
    public function userLogin()
    {
        return view('users/login');
    }
	
	/**
     * Show the application Dashboard Page.
     *
     * @return \Illuminate\Http\Response
     */
    public function userDashboard()
    {
        return view('users/dashboard');
    }
}
