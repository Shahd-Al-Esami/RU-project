<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@3.6.12/dist/css/splide.min.css">
    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@3.6.12/dist/js/splide.min.js"></script>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <title>HealthBite</title>
    <style>
        body {
            background-color: #f8f9fa;
            background-image: url('path/to/your/background-image.jpg'); /* Add your background image path here */
            background-size: cover;
            background-position: center;
            color: #222325;
            font-family: 'Arial', sans-serif;
            display: flex;
            flex-direction: column;
            min-height: 100vh; /* Ensure body takes full height */
        }
        .navbar {
           /* Orange color for the navbar */
        }
        .navbar-brand, .nav-link {
            color: black ; /* White text for navbar items */
        }
        .navbar-brand:hover, .nav-link:hover {
            color: #0e0f0e ; /* Light color on hover */
        }
        .healthbite-info {
            background-color: rgba(238, 157, 63, 0.8); /* Semi-transparent white background */
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        h2 {
            font-family: 'Arial', sans-serif;
            color: #0f0f0f; /* Custom color for the heading */
        }
        p {
            font-size: 1.1rem; /* Slightly larger text for readability */
        }
        img {
            margin-top: 20px;
        }
        .footer {
            background-color: #333;
            color: white;
            text-align: center;
            padding: 20px 0;
            width: 100%;
            margin-top: auto; /* Push footer to the bottom */
        }
        .footer-content {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }
        .footer p {
            margin: 0;
        }
        .social-links {
            list-style: none;
            padding: 0;
            display: flex;
            justify-content: center;
            margin-top: 10px;
        }
        .social-links li {
            margin: 0 15px;
        }
        .social-links a {
            color: white;
            text-decoration: none;
        }
        .social-links a:hover {
            text-decoration: underline;
        }
        .cards {
            border: 2px gray solid;
            transition: background-color 0.4s ease, border 0.3s ease; /* Added transition for smooth effect */
        }
        .cards:hover {
            background-color: rgb(173, 171, 171);
            border: 2px orange solid;
        }
/* Add this CSS to your main stylesheet or in the <style> tag */
    .photo-scroll-container {
    overflow-x: auto;  /* Enable horizontal scrolling */
    white-space: nowrap; /* Keep items in a single line */
}

.photo-slider {
    display: inline-flex; /* Align items in a row */
}

.photo-item {
    width: 100px; /* Set a fixed width for each photo item */
    height: 220px;
    margin: 10px;     /* Space out the photo items */
}

.photo-item img {
         Ensure images fill their container
    height: auto;     /* Maintain aspect ratio */
    border-radius: 5px; /* Optional: Add some rounding to img corners */
}

/* Custom styles for Splide pagination dots */
.splide__pagination {
    bottom: 10px; /* Adjust position if needed */
}
.splide__pagination li {
    margin: 0 5px ; /* Space between dots */
}
.splide__pagination .splide__pagination__page {
    background-color: orange; /* Change to your desired color */
    opacity: 0.7; /* Slightly transparent */
    border-radius: 50%; /* Make dots circular */
    width: 10px; /* Width of the dots */
    height: 10px; /* Height of the dots */
}
.splide__pagination .is-active .splide__pagination__page {
    background-color: red; /* Color for the active dot */
    opacity: 1; /* Fully opaque for active dot */
}
.splide__slide{
    text:center;
    width: 400px;
    height: 400px;
}
    </style>

</head>
<body>
    <div style="background: url(../assets/img/bg.jpg);
    background-size: cover;
    background-position-x: center;
    height: 100vh;
    width: 100%;
    background-repeat: no-repeat;
    ">

<nav class="navbar navbar-expand-lg navbar-light">
    <h1 class="navbar-brand" style="font-family: cursive; font-size: 25px; margin-left: 20px;"><b>HealthBite</b></h1>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">  <!-- Align links to the right -->
            <li class="nav-item">
                <a class="nav-link" href="{{  url('welcome')}}" style="font-family: cursive; font-size: 20px; margin-left: 20px;">Join Us</a>
            </li>

        </ul>
    </div>
</nav>

<div class="row mx-0">

<div class="col-md-6"></div>
    <div class="container mt-4 col-5">
        <div class="healthbite-info text-center">
            <h2>About HealthBite</h2>
            <p>HealthBite is dedicated to providing you with the best information about health and nutrition. Our goal is to help you make informed choices for a healthier lifestyle.</p>

            <h3 class="mt-4">The Importance of Healthy Food</h3>
            <p>Eating healthy is crucial for overall well-being. A balanced diet rich in fruits, vegetables, lean proteins, and whole grains can help maintain a healthy weight, reduce the risk of chronic diseases, and improve mood and energy levels. Healthy foods provide essential nutrients that support bodily functions, boost immunity, and promote physical and mental health. Incorporating a variety of colors on your plate can ensure you're getting a range of vitamins and minerals.</p>


    </div>
    </div></div>
    </div>


    <div class="row mx-0">
        <div class="col-1"></div>
        <div class="col-md-6">
            <div class="mt-5" style="display: flex;">
                <h5 style="color: gray;">portfolio</h5>
                <div class="mt-3" style="width: 130px; background-color: orange; height: 1px;"></div>
            </div>
            <div data-aos="zoom-out-down">
                <h1><b> OUR Portfolio</b></h1>
            </div>
        </div></div>
    <div class="photo-scroll-container ">
        <div class="splide" id="photo-slider">
            <div class="splide__track">
                <ul class="splide__list">
                    {{-- @foreach ($photos as $photo) --}}
                    <li class="splide__slide  text-center">
                        <img src="{{ asset('../assets/img//team-1.jpg') }}" alt="Photo" />
                    </li>
                    <li class="splide__slide  text-center">
                        <img src="{{ asset('../assets/img//team-2.jpg') }}" alt="Photo" />
                    </li>
                    <li class="splide__slide  text-center">
                        <img src="{{ asset('../assets/img//team-3.jpg') }}" alt="Photo" />
                    </li>
                    <li class="splide__slide  text-center">
                        <img src="{{ asset('../assets/img//team-4.jpg') }}" alt="Photo" />
                    </li>
                    {{-- @endforeach --}}
                </ul>
            </div>
        </div>
    </div>


    <div class="row mx-0">
        <div class="col-1"></div>
        <div class="col-md-6">
            <div class="mt-5" style="display: flex;">
                <h5 style="color: gray;">Services</h5>
                <div class="mt-3" style="width: 130px; background-color: orange; height: 1px;"></div>
            </div>
            <div data-aos="zoom-out-down">
                <h1><b>CHECK OUR SERVICES</b></h1>
            </div>
        </div>
        <div class="row mx-0 mt-5">
            @php
                $services = [
                    ['icon' => 'ac_unit', 'text' => 'Lorem Ipsum', 'description' => 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis'],
                    ['icon' => 'calendar_today', 'text' => 'Dolor Sitima', 'description' => 'Voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi'],
                    ['icon' => 'calendar_today', 'text' => 'Sedare Persatities', 'description' => 'Modi nostrum vel laborum. Porro fugit error sit minus sapiente sit aspernatur'],
                    ['icon' => 'account_box', 'text' => 'Magne Dolores', 'description' => 'Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia'],
                    ['icon' => 'account_balance', 'text' => 'Nemos Enamand', 'description' => 'Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore'],
                    ['icon' => 'adf_scanner', 'text' => 'Dele Cardo', 'description' => 'Quis consequatur saepe eligendi voluptatem consequatur dolor consequuntur'],
                ];
            @endphp

            @foreach($services as $service)
                <div class="col-md-4 mt-5">
                    <div class="cards" data-aos="fade-down" data-aos-easing="linear" data-aos-duration="1500" >
                        <div class="row mx-0 mt-5">
                            <div class="col-3"></div>
                            <div class="col-5 mb-3" style="background-color: #ffc451;text-align:center; border-radius: 5px;">
                                <i class="material-icons" style="font-size: 25px;text-align:center;">{{ $service['icon'] }}</i>
                            </div>
                            <div class="col-5"></div>
                        </div>
                        {{-- <h4 class="text2 text-center">{{ $service['text'] }}</h4> --}}
                        <p class="text-center">{{ $service['description'] }}</p>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="col-1"></div>
    </div>

    <div class="row mx-0">
        <div class="col-1"></div>
        <div class="col-md-6">
            <div class="mt-5" style="display: flex;">
                <h5 style="color: gray;">Team</h5>
                <div class="mt-3" style="width: 130px; background-color: orange; height: 1px;"></div>
            </div>
            <div data-aos="zoom-out-down">
                <h1><b>CHECK OUR Team</b></h1>
            </div>
        </div>
        <div class="row mx-0 mt-5">
            @php
                $teamMembers = [
                    ['img' => asset('../assets/img//team-1.jpg'), 'text' => 'Walter White', 'text1' => 'Chief Executive Officer'],
                    ['img' => asset('../assets/img//team-2.jpg'), 'text' => 'Sarah Johnson', 'text1' => 'Product Manager'],
                    ['img' => asset('../assets/img//team-3.jpg'), 'text' => 'William Anderson', 'text1' => 'CTO'],
                    ['img' => asset('../assets/img//team-4.jpg'), 'text' => 'Amanda Jepson', 'text1' => 'Accountant'],
                ];
            @endphp

            @foreach($teamMembers as $member)
                <div class="col-md-3 d-flex justify-content-center align-items-center">
                    <div>
                        <div class="card-header" style="background-image: url('{{ $member['img'] }}'); width: 250px; height: 40vh; background-size: cover; position: center;">
                            <div class="head d-flex justify-content-center align-items-center" style="width: 250px; height: 40vh;">
                                <div style="margin-top: 180px;">
                                    <a href="#" class="social-icon"><i class="bi bi-facebook"></i></a>
                                    <a href="#" class="social-icon"><i class="bi bi-instagram"></i></a>
                                    <a href="#" class="social-icon"><i class="bi bi-twitter"></i></a>
                                    <a href="#" class="social-icon"><i class="bi bi-linkedin"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer mt-3">
                            <h4 style="text-align: center;">{{ $member['text'] }}</h4>
                            <p style="color: gray; text-align: center;">{{ $member['text1'] }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>





    <footer class="footer mt-5">
        <div class="footer-content">
            <p>&copy; 2025 My Website. All rights reserved.</p>
            <ul class="social-links">
                <li><a href="https://facebook.com" target="_blank">Facebook</a></li>
                <li><a href="https://twitter.com" target="_blank">Twitter</a></li>
                <li><a href="https://linkedin.com" target="_blank">LinkedIn</a></li>
                <li><a href="https://instagram.com" target="_blank">Instagram</a></li>
            </ul>
        </div>
    </footer>
    <script>
        new Splide('#photo-slider', {
            autoplay: true, // Enable autoplay
            interval: 1000, // Move to the next slide every 3 seconds
        }).mount();
    </script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
