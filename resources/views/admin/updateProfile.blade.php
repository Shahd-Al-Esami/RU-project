@extends('layouts.app')

@section('content')
<style>
    /* Overall page styling */
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background: linear-gradient(135deg, #fff7f0, #ffe4b5);
        color: #333;
        margin: 0;
        padding: 0;
    }

    /* Container styling */
    .container {
        max-width: 900px;
        margin: auto;
        padding: 30px;
        background-color: #fff;
        border-radius: 15px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        border: 1px solid #f0ad4e; /* Light orange border */
        margin-top: 40px;
    }

    /* Headings styling */
    h1, h2, h4, h3 {
        color: #ff7f50; /* Bright orange for headings */
        margin-bottom: 20px;
        text-align: center;
    }

    /* List styling for appointments */
    .appointments-list ul {
        padding: 0;
        list-style: none;
    }

    .list-group-item {
        padding: 15px 20px;
        margin-bottom: 10px;
        background-color: #fff3e0; /* Light orange background */
        border-left: 6px solid #ff7f50; /* Orange accent border */
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        transition: all 0.3s ease;
    }

    .list-group-item:hover {
        background-color: #ffe0b2; /* Slightly darker hover color */
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    }

    /* Form section styling */
    .new-appointment {
        margin-top: 40px;
        padding: 25px;
        background-color: #fff0e0; /* Soft orange background */
        border-radius: 15px;
        border: 1px solid #f0ad4e;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }

    .new-appointment h2 {
        margin-bottom: 20px;
        color: #ff7f50;
    }

    /* Labels and inputs */
    label {
        font-weight: bold;
        display: block;
        margin-bottom: 8px;
        color: #d35400; /* Darker orange for labels */
    }

    .form-select, .form-control, input[type="text"], input[type="email"], input[type="password"], input[type="number"], textarea {
        width: 100%;
        padding: 10px 15px;
        margin-bottom: 15px;
        border-radius: 8px;
        border: 1px solid #f0ad4e;
        box-shadow: inset 0 1px 3px rgba(0,0,0,0.1);
        transition: border-color 0.3s, box-shadow 0.3s;
    }

    .form-select:focus, .form-control:focus, input[type="text"]:focus, input[type="email"]:focus, input[type="password"]:focus, input[type="number"]:focus, textarea:focus {
        border-color: #ff7f50;
        outline: none;
        box-shadow: 0 0 8px rgba(255,127,80,0.3);
    }

    /* Button styling */
    .btn-primary {
        background-color: #ff7f50;
        border-color: #ff7f50;
        padding: 10px 20px;
        border-radius: 8px;
        color: #fff;
        font-weight: bold;
        transition: background-color 0.3s, box-shadow 0.3s;
    }

    .btn-primary:hover {
        background-color: #ff6f3f;
        box-shadow: 0 4px 8px rgba(0,0,0,0.2);
    }

    /* Responsive design for small screens */
    @media (max-width: 768px) {
        .container {
            padding: 20px;
        }
    }

    /* Go back button styling */
    .go-back-btn {
        margin-bottom: 20px;
    }

    /* Follow button styling - if needed elsewhere */
    .follow-btn {
        background-color: #ffcc80; /* Custom color */
        border: none;
        padding: 10px 20px;
        color: #222121;
        font-size: 1rem;
        border-radius: 25px;
        cursor: pointer;
        transition: background-color 0.3s, transform 0.2s;
    }

    .follow-btn:hover {
        background-color: #df9f51;
        transform: scale(1.05);
    }
</style>

<a href="{{ url('admin/myProfile') }}" class="btn btn-secondary go-back-btn mt-4 mx-4">Go Back</a>

<div class="container">
    <!-- Styled and Decorated Create/Edit admin Section -->
    <form action="{{ route('updateProfile') }}" method="POST" enctype="multipart/form-data" style="position: relative;">
        @csrf
        <h3>Personal Information</h3>
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required value="{{ old('name', $admin->name ?? '') }}">

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required value="{{ old('email', $admin->email ?? '') }}">

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required placeholder="Enter new password">

        <label for="country">Country:</label>
        <input type="text" id="country" name="country" required value="{{ old('country', $admin->country ?? '') }}">

        <label for="age">Age:</label>
        <input type="number" id="age" name="age" required value="{{ old('age', $admin->age ?? '') }}">

        <label for="gender">Gender:</label>
        <select id="gender" name="gender" required>
            <option value="male" {{ (old('gender', $admin->gender ?? '') == 'male') ? 'selected' : '' }}>Male</option>
            <option value="female" {{ (old('gender', $admin->gender ?? '') == 'female') ? 'selected' : '' }}>Female</option>
        </select>

        <label for="phone_number">Phone Number:</label>
        <input type="text" id="phone_number" name="phone_number" required value="{{ old('phone_number', $admin->phone_number ?? '') }}">

            <input id="image" type="file" class="form-control @error('image') is-invalid @enderror" name="image" value="{{ old('image') }}"  autocomplete="image">
            @error('image')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror






        <button type="submit" class="btn btn-primary">Update Profile</button>
    </form>
</div>

@endsection

@if(session('message'))
<script>
    alert('{{ session('message') }}');
</script>
@endif
