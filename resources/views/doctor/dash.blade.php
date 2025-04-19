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
                <li><a href="#posts"><b>Posts</b></a></li>
                <li><a href="#doctors"><b>Doctors</b></a></li>
                <li><a href="#services"><b>Services</b></a></li>
                <li><a href="#contact"><b>Contact Us</b></a></li>
            </ul>
        </nav>
    </header>
    <div class="row mt-4">
        <div class="col-md-3">
            <!-- Sidebar -->
            <div class="sidebar text-dark p-4" style="height: 88vh; background-color: rgba(127, 132, 122, 0.5);">
                <h3 class="text-center mb-4" style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif">Doctor Dashboard</h3>
                <nav class="nav flex-column">
                    <a class="nav-link  text-dark hover-bg mb-4" href="{{ route('admin.dashboard') }}"><b>Home</b></a>
                    <h5 class="text-center mb-4" style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif">Mangement Proccess</h5>

                    <a class="nav-link text-dark " href=""><b> My Patients</b></a>
                    <a class="nav-link text-dark hover-bg" href=""><b> My Bills</b></a>
                    <a class="nav-link text-dark hover-bg" href=""><b> Plans</b></a>
                    <a class="nav-link text-dark hover-bg" href=""><b> Order Plans</b></a>
                    <a class="nav-link text-dark hover-bg" href=""><b> My Posts</b></a>
                    <a class="nav-link text-dark hover-bg" href=""><b> My Reports</b></a>
                    <a class="nav-link text-dark hover-bg" href=""><b> Settings</b></a>
                   {{-- <a class="nav-link text-dark hover-bg mt-4" href="{{ route('logout') }}"><b>LogOut</b></a> --}}
                   <form action="{{ route('logout') }}" method="POST" class="mt-4">
                    @csrf
                    <button type="submit" class="button text-dark hover-bg mt-4" style="background: none; border: none; padding: 0;">
                        <b>LogOut</b>
                    </button>
                </form>
                </nav>
            </div>
        </div>
            {{-- </div> --}}
        {{-- </div> --}}
{{--
        <div class="col-md-9">
            <!-- Main Content -->
            <h2 class="my-4 text-center">Dashboard Overview</h2>
            <div class="row">
                <div class="col-md-4">
                    <div class="card mb-4 ">
                        <div class="card-body">
                            <h5 class="card-title">Total Patients</h5>
                            <p class="card-text display-4">0</p> <!-- Placeholder for total doctors -->
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card mb-4 ">
                        <div class="card-body">
                            <h5 class="card-title">Total Bills</h5>
                            <p class="card-text display-4">0</p> <!-- Placeholder for total patients -->
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card mb-4 ">
                        <div class="card-body">
                            <h5 class="card-title">Total plans</h5>
                            <p class="card-text display-4">0</p> <!-- Placeholder for total bills -->
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-md-12 mb-4">
                <canvas id="participationChart" style="height: 400px; width: 600px;"></canvas>
            </div>

        </div>
    </div>
</div> --}}
{{-- <script>
    document.addEventListener('DOMContentLoaded', function () {
        var ctx = document.getElementById('participationChart').getContext('2d');
        var participationChart = new Chart(ctx, {
            type: 'line', // You can change this to 'bar', 'pie', etc., as needed
            data: {
                labels: ['2020', '2021', '2022', '2023', '2024', '2025'], // Years
                datasets: [{
                    label: 'Participation Percentage',
                    data: [20, 35, 50, 70, 85], // Example data for each year
                    backgroundColor: 'rgba(255, 165, 0, 0.5)', // Optional
                    borderColor: 'rgba(255, 165, 0, 1)', // Line color
                    borderWidth: 4,
                    fill: false // Set true if you want filled area under the line
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            color: 'black', // Change tick color to black
                            callback: function (value) {
                                return value + '%'; // Append '%' sign to y-axis labels
                            },
                            font: {
                                size: 16 // Increase font size for y-axis ticks
                            }
                        },
                        title: {
                            display: true,
                            text: 'Participation Percentage',
                            color: 'black',
                            font: {
                                size: 20 // Increase font size for y-axis title
                            }
                        }
                    },
                    x: {
                        title: {
                            display: true,
                            text: 'Year',
                            color: 'black',
                            font: {
                                size: 20 // Increase font size for x-axis title
                            }
                        },
                        ticks: {
                            color: 'black', // Change tick color to black
                            font: {
                                size: 16 // Increase font size for x-axis ticks
                            }
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: true,
                        labels: {
                            font: {
                                size: 16, // Increase legend font size
                                color: 'black' // Change legend text color to black
                            }
                        }
                    },
                    title: {
                        display: true,
                        text: 'Percentage of Participants Over the Years',
                        font: {
                            size: 20, // Increase the font size for the chart title
                            color: 'black' // Change chart title color to black
                        }
                    }
                }
            }
        });
    });
</script> --}}


<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>



@endsection
