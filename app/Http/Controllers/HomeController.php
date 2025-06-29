<?php

namespace App\Http\Controllers;

use App\Services\PlanService;
use App\Services\UserService;
use App\Services\PlanOrderService;

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
       $planOrders = PlanOrderService::countPlanOrderss();
       $plans = PlanService::countPlan();
       $patients = UserService::countPatients();
       $doctors = UserService::countDoctors();

        return view('admin.dash',compact('plans','patients','doctors','planOrders'));
    }

    // protected function authenticated($request, $user)
    // {
    //     if ($user->role === 'admin') {
    //         return redirect()->route('admin.dashboard'); // وجهة الأدمن
    //     } elseif ($user->role === 'doctor') {
    //         return redirect()->route('doctor.dashboard'); // وجهة الطبيب
    //     } else {
    //         return redirect()->route('home'); // Patient dashboard route
    //     }
    // }
}
