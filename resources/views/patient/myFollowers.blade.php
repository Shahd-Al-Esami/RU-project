<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <title>Follower List</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #fff7f0, #ffe4b5);
            color: #333;
            margin: 0;
            padding: 20px;
        }
        h1 {
            text-align: center;
            color: #bd930c;
            margin-bottom: 20px;
        }
        .follower-list {
            max-width: 600px;
            margin: 0 auto;
            padding: 10px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .follower {
            background: #e9ecef;
            padding: 10px;
            margin: 8px 0;
            border-radius: 4px;
            transition: background 0.3s;
        }
        .follower:hover {
            background: #d1d1d1;
        }
    </style>
</head>
<body>
    <a href="{{ url('home') }}" class="btn btn-secondary">Go Back</a>

    <h1>Doctors I Follow</h1>
    <div class="follower-list">
        {{-- {{ dd($followers) }} --}}
        @foreach ($followers as $follower)
            <p class="follower">{{ $follower }}</p>
        @endforeach
    </div>
</body>
</html>
