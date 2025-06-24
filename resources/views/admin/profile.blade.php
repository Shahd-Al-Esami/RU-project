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
        .admin-header {
            text-align: center;
            margin-bottom: 30px;
        }
        .admin-header h1 {
            font-size: 2.5rem;
            margin-bottom: 10px;
            color: #151514;
        }
        .admin-header h3 {
            font-size: 1.5rem;
            color: #272625;
        }

        /* Card styles */
        .admin-card {
            background: #ffffff;
            border-radius: 15px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
            padding: 30px;
            margin-bottom: 30px;
            transition: transform 0.3s, box-shadow 0.3s;
        }
        .admin-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.2);
        }

        /* Headings inside cards */
        .admin-card h4 {
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
{{-- {{dd($admin)
}} --}}
<a href="{{ url('admin/dashboard') }}" class="btn btn-secondary go-back-btn">Go Back</a>

@if($admin->id  === auth()->user()->id)
<div class="d-flex justify-content-end mx-4">
    <a style="align-items: left;" href="{{ route('editProfile',auth()->user()->id) }}" class="btn btn-primary">Edit Profile</a>
</div>
@endif
    <div class="container">
       <!-- Doctor Header -->
        <div class="admin-header">
            <img src="{{ asset('storage/' . $admin->image) }}" alt="image" />
            <div style="font-family: 'Arial, sans-serif'; line-height: 1.6; color: #333;">
                <h1 style="font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; font-size: 2em; color: #2c3e50; text-decoration: underline;">Hello, I am {{ $admin->name }}</h1>
                <p style="margin: 8px 0;"> I am From: {{ $admin->country }}</p>
                <p style="margin: 8px 0; ">I have : {{ $admin->age }} Years Old</p>
                <p style="margin: 8px 0;">My Email is: <a href="mailto:{{ $admin->email }}" style="color: #2980b9; text-decoration: underline;">{{ $admin->email }}</a></p>
                <p style="margin: 8px 0;"> The Phone Number: {{ $admin->phone_number }}</p>
            </div>

        <!-- About Me Section -->



    </div>
    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
