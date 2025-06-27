<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<style>

nav {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 10px 20px;
}

.logo h1 {
    color: rgb(10, 10, 10); /* Logo text color */
    font-size: 1.8rem; /* Font size for the logo */
}

.nav-links {
    list-style: none; /* No bullets for the list */
    display: flex; /* Display list items in a row */
}

.nav-links li {
    margin-left: 20px; /* Space between each link */
}

.nav-links a {
    text-decoration: none; /* Remove underline from links */
    color: rgb(14, 14, 14); /* Link text color */
    padding: 8px 16px; /* Padding around links */
    border-radius: 4px; /* Rounded corner for links */
    transition: background-color 0.3s; /* Smooth color change */
}

.nav-links a:hover {
    background-color: rgba(255, 165, 0, 0.5);}

    .nav-link:hover {
        background-color: rgb(185, 134, 22); /* Change hover background color to white */
    }
    .card {
    border: 0; /* Remove default border */
    border-radius: 15px; /* Rounded corners */
    background-color: rgba(255, 255, 255, 0.5); /* Semi-transparent background */
    transition: transform 0.2s; /* Smooth transformation */
    box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1); /* Shadow effect */
}

.card:hover {
    transform: translateY(-4px); /* Lift effect on hover */
    box-shadow: 0 8px 60px rgba(0, 0, 0, 0.2); /* Increased shadow on hover */
}

.card-title {
    font-weight: bold; /* Bold title */
}

.display-4 {
    font-size: 2.5rem; /* Larger font size for numbers */
    color: #333; /* Darker color for visibility */
}

/* Optional: Styling for text inside the cards */
.card-text {
    color: #555; /* Dark grey text for better readability */
}
</style>
<body>


@extends('layouts.app')

@section('content')

<div class="container-fluid" style="background: url(../assets/img/Backround.jpg); backface-visibility: hidden;
background-size: cover;
background-position-x: center;
height: 100vh;
width: 100%;
background-repeat: no-repeat;
z-index: -1;">
    <header style="background-color: rgba(127, 132, 122, 0.5);">
        <nav>
            <div class="logo">
                <h1  style="font-family: cursive; font-size: 25px; margin-left: 20px;">HealthBite</h1>
            </div>
            <ul class="nav-links">
                <li ><a href="{{ route('firstPage') }}"><b>Home</b></a></li>

                <li><a href="{{ route('homePosts') }}"><b>Posts</b></a></li>
                <li><a href="{{ route('getAllDoctors') }}"><b>Doctors</b></a></li>
                <li><a href="{{ route('services') }}"><b>Services</b></a></li>
                <li><a href="{{ route('contact') }}"><b>Contact Us</b></a></li>
            </ul>
        </nav>
    </header>
    <div class="row mt-4">
        <div class="col-md-3">
            <!-- Sidebar -->
            <div class="sidebar text-dark p-4" style="height: 88vh; background-color: rgba(127, 132, 122, 0.5);">
                <h3 class="text-center mb-4" style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif">Doctor Dashboard</h3>
                <img    style="width:100px;height:100px;margin-left: 100px" src="{{ asset('storage/' . auth()->user()->image) ?? asset('assets/defaultImage.png') }}" alt="User Image" />
                <h5 class="text-center mb-4 mt-2">{{ auth()->user()->name }}</h5>

                <nav class="nav flex-column">

                    <h5 class="text-center mb-2 mt-1" style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif">Mangement Proccess</h5>
                    <a class="nav-link text-dark " href="{{ route('doctor.myProfile') }}"><b> My Profile</b></a>
                    <a class="nav-link text-dark " href="{{ route('myPatients') }}"><b> My Patients</b></a>
                    <a class="nav-link text-dark hover-bg" href="{{ route('myPosts') }}"><b> My Posts</b></a>
                    <a class="nav-link text-dark hover-bg" href="{{ route('getPlanOrders') }}"><b> Order Plans</b></a>
                    <a class="nav-link text-dark hover-bg" href="{{ route('planBills') }}"><b> My Bills</b></a>

                    <a class="nav-link text-dark hover-bg" href="{{ route('getReports') }}"><b> My Reports</b></a>
                    <a class="nav-link text-dark hover-bg" href="{{ route('getAppointments') }}"><b> My Appointments</b></a>
                    <a class="nav-link text-dark hover-bg" href=""><b> Food Table</b></a>
                   {{-- <a class="nav-link text-dark hover-bg mt-4" href="{{ route('logout') }}"><b>LogOut</b></a> --}}
                   <form action="{{ route('logout') }}" method="POST" class="mt-4">
                    @csrf
                    <button type="submit" class="btn text-dark hover-bg " style=" padding: 0;">
                        <b>LogOut</b>
                    </button>
                </form>
                </nav>
            </div>
        </div>



<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>



@endsection
</body>
</html>
