<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    // dashboard page
    public function dashboardPage(){
        return view('admin.main.dashboard');
    }

}
