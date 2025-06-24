<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Traits\jsonTrait;
use App\Models\DoctorInformation;
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
    protected $redirectTo = ''; // Set a default redirect path

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
            'bio' => ['nullable', 'string'],
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
        $path = uploadImage('image', $data['role'] == 'doctor' ? 'doctors' : ($data['role'] == 'patient' ? 'patients' : 'admins'), 'public');


    // Create the user
    $userData = [
        'name'         => $data['name'],
        'email'        => $data['email'],
        'country'      => $data['country'],
        'age'          => $data['age'],
        'gender'       => $data['gender'],
        'phone_number' => $data['phone_number'],
        'role'         => $data['role'],
        'image'        => $path,
        'password'     => Hash::make($data['password']),
    ];

    if ($data['role'] === 'doctor' && isset($data['bio'])) {
        // Add bio to user if needed
        $userData['bio'] = $data['bio'];
    }

    $user = User::create($userData);

    // Create DoctorInformation only if role is doctor
    $info = null;
    if ($data['role'] === 'doctor' && isset($data['bio'])) {
        $info = DoctorInformation::create([
            'bio' => $data['bio'],
            'doctor_id' => $user->id, // use newly created user's id
        ]);
    }

    return ['user' => $user, 'info' => $info];
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
        $result = $this->create($request->all());
        $user = $result['user'];


        Auth::login($user);
        // dd($request->all());

        // Redirect based on user role
        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard'); // Admin dashboard route

        } elseif ($user->role === 'doctor'&& $user->isAgreeDoctorRegistration=='agree') {
            return redirect()->route('doctor.dashboard'); // Doctor dashboard route
        } elseif ($user->role === 'doctor'&& $user->isAgreeDoctorRegistration  !=  'agree') {
            session()->flash('message', 'You must wait to be accepted .');
            return redirect()->route('firstPage',); // Doctor dashboard route

        }
        else {
            return redirect()->route('home'); // Patient dashboard route
        }
    }
}
