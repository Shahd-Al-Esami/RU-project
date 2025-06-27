<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Doctor Profile</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet" />

    <style>
        body {
            background: linear-gradient(135deg, #fff7f0, #ffe4b5);
            font-family: 'Open Sans', sans-serif;
            margin: 0;
            padding: 0;
        }

        /* Button Styling */
        .go-back-btn {
            margin: 20px;
        }

        /* Container styling */
        .container {
            margin-top: 30px;
        }

        /* Header styling */
        .myProfile-header {
            text-align: center;
            margin-bottom: 30px;
        }
        .myProfile-header h1 {
            font-size: 2.5rem;
            margin-bottom: 10px;
            color: #151514;
        }
        .myProfile-header h3 {
            font-size: 1.5rem;
            color: #272625;
        }

        /* Card styles */
        .myProfile-card {
            background: #ffffff;
            border-radius: 15px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
            padding: 30px;
            margin-bottom: 30px;
            transition: transform 0.3s, box-shadow 0.3s;
        }
        .myProfile-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.2);
        }

        /* Headings inside cards */
        .myProfile-card h4 {
            margin-bottom: 20px;
            color: #d79615;
            border-bottom: 2px solid #dee2e6;
            padding-bottom: 8px;
            font-weight: 600;
        }

        /* About Me Paragraph */
        .bio {
            font-size: 1.1rem;
            color: #343a40;
            line-height: 1.6;
        }

        /* Recent Posts Styling */
        .posts {
            list-style: none;
            padding: 0;
        }
        .post-item {
            padding: 15px;
            border-bottom: 1px solid #dee2e6;
        }
        .post-item:last-child {
            border-bottom: none;
        }
        .post-title {
            font-weight: 600;
            font-size: 1.1rem;
            margin-bottom: 8px;
            color: #cdad09;
        }
        .post-content {
            font-size: 0.95rem;
            color: #495057;
        }
        .post-date {
            font-size: 0.8rem;
            color: #6c757d;
        }

        /* Follow/Unfollow Button Styles */
        .follow-btn {
            padding: 10px 20px;
            font-size: 1.1rem;
            border-radius: 50px;
            transition: background-color 0.3s, transform 0.2s;
        }
        .follow-btn:hover {
            transform: scale(1.05);
        }

        /* Specific button colors */
        .btn-follow {
            background-color: #007bff;
            color: #fff;
            border: none;
        }
        .btn-follow:hover {
            background-color: #0069d9;
        }

        .btn-unfollow {
            background-color: #dc3545;
            color: #fff;
            border: none;
        }
        .btn-unfollow:hover {
            background-color: #c82333;
        }
    </style>
</head>
<body>
{{-- {{dd($myProfile)
}} --}}
<a href="{{ url()->previous() }}" class="btn btn-secondary go-back-btn mt-3 mx-3">Go Back</a>

    <div class="container">

        <!-- Doctor Header -->
        <div class="myProfile-header">
         <img src="{{ asset('storage/' . $myProfile->image) }}" alt="image" />
            <h1>Hello I am {{ $myProfile->name }}</h1>
            <h3> {{ $myProfile->gender }}</h3>
            <h3>From : {{ $myProfile->country }}</h3>
            <p>Age : {{ $myProfile->age }}</p>
            <p>Email : {{ $myProfile->email }}</p>
            <p>Phone Number : {{ $myProfile->phone_number }}</p>
        </div>

        <!-- About Me Section -->
        <div class="myProfile-card">
            <h4>About Me</h4>
            <p class="bio">height : {{ $myProfile->patientInformation?->height??'' }}</p>
            <p class="bio">weight : {{ $myProfile->patientInformation?->weight??'' }}</p>
            <p class="bio">desirable_foods : {{ $myProfile->patientInformation?->desirable_foods??'' }}</p>
            <p class="bio">financial_state : {{ $myProfile->patientInformation?->financial_state??'' }}</p>
            <p class="bio">health_state : {{ $myProfile->patientInformation?->health_state??'' }}</p>
            <p class="bio">my Answers : {{ $myProfile->patientInformation?->answers??'' }}</p>
        </div>


    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
