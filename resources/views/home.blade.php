<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <title>HealthBite</title>
    <link rel="stylesheet" href="styles.css">
</head>
<style>
body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: rgba(255, 165, 0, 0.1); /* Light orange background */
}

header {
    color: rgb(11, 11, 11);
    padding: 10px 20px;
}

.nav-links {
    list-style: none;
    padding: 0;
    display: flex;
    justify-content: flex-end;
}

/* Basic Reset */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

/* Navigation Bar Styles */
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
    font-size: 20px;
    text-decoration: none; /* Remove underline from links */
    color: rgb(14, 14, 14); /* Link text color */
    padding: 8px 16px; /* Padding around links */
    border-radius: 4px; /* Rounded corner for links */
    transition: background-color 0.3s; /* Smooth color change */
}

.nav-links a:hover {
    background-color: rgba(255, 165, 0, 0.5);}

main {
    padding: 20px;
}

section {
    margin-bottom: 40px;
    padding: 20px;
    border-radius: 5px;
    /* Section background with opacity */
}

footer {
    text-align: center;
    padding: 20px;
    background-color: rgba(255, 165, 0, 0.8); /* Footer background with opacity */
    color: white;
}
.nav-link:hover {
    background-color: rgba(255, 165, 0, 0.5); /* Footer background with opacity */
    }


        /* Add some basic styles for the chat icon */
        .chat-icon {
            position: fixed; /* Keep it fixed during scrolling */
            bottom: 500px; /* Position it from the bottom of the viewport */
            right: 20px; /* Position it from the right */
            background-color: rgba(255, 165, 0, 0.8); /* A nice blue color */
            color: white; /* White text */
            padding: 10px 15px; /* Some padding around the text */
            border-radius: 25px; /* Rounded corners */
            cursor: pointer; /* Change cursor on hover */
            display: flex; /* Flexbox to align items */
            align-items: center; /* Center items vertically */
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2); /* Shadow for depth */
        }

        .chat-icon:hover {
            background-color: rgba(255, 165, 0, 0.5); /* Darker blue on hover */
        }

        /* Optional: Add styling for the bubble icon */
        .bubble {
            margin-right: 8px; /* Space between icon and text */
        }         /* Add some basic styles for the chat icon */
.button{
    font-size: 20px;
   background-color: none;


}
.button:hover{
   background-color: rgba(255, 165, 0, 0.5);

}


</style>
@extends('layouts.app')

@section('content')
<body  class="container-fluid" style="background: url(../assets/img/curved9.jpg); backface-visibility: hidden;
background-size: cover;
background-position-x: center;
height: 100vh;
width: 100%;
background-repeat: no-repeat;
z-index: -1;">
    <header style="background-color: rgba(255, 165, 0, 0.5);">
        <nav>
            <div class="logo">
                <h1  style="font-family: cursive; font-size: 25px; margin-left: 20px;"><b>HealthBite</b></h1>
            </div>
            <ul class="nav-links">
                <li><a href="{{ route('homePosts') }}"><b>Posts</b></a></li>
                <li><a href="{{ route('getAllDoctors') }}"><b>Doctors</b></a></li>
                <li><a href="{{ route('services') }}"><b>Services</b></a></li>
                <li><a href="{{ route('contact') }}"><b>Contact Us</b></a></li>
            </ul>
        </nav>
    </header>
    <main>
    <div class="row mt-5 ">
        <div class="col-md-1"></div>
        <div class="col-md-3 ">
            <!-- Sidebar -->
            <div class="sidebar text-dark p-4" style="height: 80vh;">
                <nav class="nav flex-column mt-5">

                    <a class="nav-link  text-dark hover-bg mt-5" href="{{ route('patient.myProfile',['idd'=>auth()->user()->id]) }}"><h5><b>My Profile</b></h5></a>
                    <a class="nav-link text-dark hover-bg mt-3" href="{{ route('myFollowers') }}"><h5><b>Doctors I Follow</b></h5></a>
                    <a class="nav-link text-dark mt-3 " href="{{ route('descPlan') }}"><h5><b>Request a Plan ?</b></h5></a>
                    <a class="nav-link text-dark hover-bg mt-3" href="{{ route('myOrdersPlans') }}"><h5><b>My Plans</b></h5></a>
                    <a class="nav-link text-dark hover-bg mt-3" href="{{ route('myReports') }}"><h5><b>Doctor Notes</b></h5></a>

                    {{-- <a class="nav-link text-dark mt-3 " href=""><h5><b>My Bills</b></h5></a> --}}
                    <a class="nav-link text-dark mt-3 " href="{{ route('appointments') }}"><h5><b>My Appointments</b></h5></a>

                    <form action="{{ route('logout') }}" method="POST" class="mt-4">
                        @csrf
                        <button type="submit" class="button text-dark  mt-4" style="background:none; border: none; padding: 0;">
                            <b>LogOut</b>
                        </button>
                    </form>


                </nav>
            </div>
        </div>



    </div>
</main>

{{-- <div class="chat-icon" onclick="startConversation()">
    <span class="bubble">&#x1F4AC;</span> <!-- Chat bubble emoji -->
    <span> Chat with a Doctor</span>
</div>

<script>
    function startConversation() {
        // Code to start the conversation (e.g., open a chat window)
        alert("Starting a conversation with a doctor...");
    }
</script> --}}

@if(session('message'))
<script>
    alert('{{ session('message') }}');
</script>
@endif
</body>
</html>
