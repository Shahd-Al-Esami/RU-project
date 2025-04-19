<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Traits\jsonTrait;
use App\Http\Requests\LoginRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\RegisterRequest;

class AuthController extends Controller
{   use jsonTrait;
    public function register(RegisterRequest $request)
    {
            //for upload image
            $image = uploadImage('image', $request->role == 'doctor' ? 'doctors' : ($request->role == 'patient' ? 'patients' : 'admins'), 'public');
            $user = User::create([
            'name' =>$request->name,
            'email' => $request->email,
            'country' =>  $request->country,
            'age' =>  $request->age,
            'gender' =>  $request->gender,
            'phone_number' => $request->phone_number,
            'role' => $request->role,
            'image' =>$image,
            'password' => Hash::make( $request->password),
        ]);
        $token = $user->createToken('YourAppName')->plainTextToken;

        // Determine the view to return based on user role
        if ($user->role == 'admin') {
            return view('admin.dash'); // Return admin dashboard view
        } elseif ($user->role == 'patient') {
            return view('home'); // Return patient home view
        } else {
            return view('doctor.dash'); // Return doctor dashboard view
        }
    }

    /**
     * Login user and create a token.
     */
    public function login(LoginRequest $request)
    {
        $user = User::withTrashed()->where('email', $request->email)->first();

        // Check if user exists
        if (!$user) {
            return $this->jsonResponse(404, 'User not found');
        }
 // Restore the user if they are soft-deleted
 if ($user->trashed()) {
    $user->restore();
}
        if (Hash::check($request->password, $user->password)) {
            // Create and return token with user information
            $token = $user->createToken('YourAppName')->plainTextToken;

            return $this->jsonResponse(200, 'success', ['token' => $token, 'user' => $user]);
        }

        return $this->jsonResponse(401, 'Unauthorized');
    }

    /**
     * Logout user and revoke the token.
     */
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        // Redirect to the first page after logout
        return redirect()->route('firstpage'); // Update 'firstpage' to your actual route name
    }

}
