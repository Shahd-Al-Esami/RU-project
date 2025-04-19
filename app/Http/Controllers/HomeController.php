<?php

namespace App\Http\Controllers;

use App\Services\PlanService;

class HomeController extends Controller
{
    public function index()
    {
        return view('home'); // Return a view named 'home'
    }
    public function doctorDash()
    {
        return view('doctor.dash'); 
    }
    public function adminDash()
    {
        return view('admin.dash');
    }
}
