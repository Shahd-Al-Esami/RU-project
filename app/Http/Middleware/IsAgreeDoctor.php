<?php

namespace App\Http\Middleware;

use App\Http\Traits\jsonTrait;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsAgreeDoctor
{
    use jsonTrait;
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $doctor=auth()->user()->isAgreeDoctorRegistration;
        // dd($doctor);
       if($doctor ==='agree'){
       return $next($request);}
       return jsonTrait::jsonResponse(401,'you can not do it,dont agree with you ',);


    }
}
