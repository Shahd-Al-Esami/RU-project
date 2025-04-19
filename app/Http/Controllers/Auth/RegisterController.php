<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request; // Updated to use \Illuminate\Http\Request
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home'; // Set a default redirect path

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'country' => ['string', 'max:255'],
            'age' => ['numeric', 'required'],
            'phone_number' => ['required', 'numeric', 'regex:/^09[0-9]{8}$/'],
            'role' => ['required', 'in:patient,doctor,admin'],
            'gender' => ['required', 'in:male,female'],
            'image' => ['nullable', 'mimes:jpg,jpeg,png', 'max:2048'],
            'password' => ['required', 'string', 'min:8'], // Added confirmed rule
        ], [
            'phone_number.regex' => 'Phone number must start with 09 and contain 10 digits.',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $path = uploadImage(request()->file('image'), $data['role'] == 'doctor' ? 'doctors' : ($data['role'] == 'patient' ? 'patients' : 'admins'), 'public');

        // Create the user
        return User::create([
            'name'         => $data['name'],
            'email'        => $data['email'],
            'country'      => $data['country'],
            'age'          => $data['age'],
            'gender'       => $data['gender'],
            'phone_number' => $data['phone_number'],
            'role'         => $data['role'],
            'image'        => $path,
            'password'     => Hash::make($data['password']),
        ]);
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        // Create the user and log them in
        $user = $this->create($request->all());
        Auth::login($user);

        // Redirect based on user role
        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard'); // Admin dashboard route
        } elseif ($user->role === 'doctor') {
            return redirect()->route('doctor.dashboard'); // Doctor dashboard route
        } else {
            return redirect()->route('home'); // Patient dashboard route
        }
    }
}
