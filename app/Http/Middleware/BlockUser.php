<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\BlockedUser;
use Illuminate\Http\Request;
use App\Http\Traits\jsonTrait;
use Symfony\Component\HttpFoundation\Response;

class BlockUser
{ use jsonTrait;
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
     $blocked=BlockedUser::pluck('id')->toArray();
     $userId=auth()->user()->id;
        if(in_array($userId,$blocked))
        return jsonTrait::jsonResponse(401,'you is blocked ,you can not do it');

        return $next($request);
    }
}
