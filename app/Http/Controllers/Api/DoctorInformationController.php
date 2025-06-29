<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\DoctorInformation;
use App\Http\Controllers\Controller;
use App\Services\DoctorInformationService;

class DoctorInformationController extends Controller
{
    public  function myProfile()
    {
        $doctor = DoctorInformationService::myProfile();

return view('doctor.profile',['doctor'=>$doctor])  ;
  }

  public  function adminProfile()
  {
      $admin = DoctorInformationService::adminProfile();

return view('admin.profile',['admin'=>$admin])  ;
}
    public  function editProfile($id)
  {
      $doctor = DoctorInformationService::editProfile($id);

return view('doctor.updateProfile',['doctor'=>$doctor])  ;
}
    public  function updateProfile(Request $request)
    {
        if(auth()->user()->role ==='doctor')
        {
        $result = DoctorInformationService::updateProfile($request);

        return redirect()->route('doctor.myProfile');
    }
    else{
        $result = DoctorInformationService::updateProfile($request);
        return redirect()->route('admin.myProfile');

    }
    }

    public  function storeProfile(Request $request)
    {
        $result = DoctorInformationService::storeProfile( $request);

        return redirect()->route('myProfile');
    }

    public  function doctorProfile($id)
    {
        $doctor = DoctorInformationService::doctorProfile($id);

        return view('doctor.profile',['doctor'=>$doctor]);
    }
}
