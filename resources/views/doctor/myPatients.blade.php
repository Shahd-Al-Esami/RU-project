<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Doctors List</title>
    <style>
        body {
    background: linear-gradient(135deg, #fff7f0, #ffe4b5);
        }

        <style>
    /* Custom CSS for styling the patients grid */
    .patients-container {
        padding: 40px 20px;
        background-color: #f8f9fa; /* Light background for contrast */
        border-radius: 10px;
    }

    .patients-container h1 {
        font-family: 'Arial', sans-serif;
        font-size: 2.5rem;
        color: #343a40;
        margin-bottom: 30px;
        text-shadow: 1px 1px #ddd;
    }

    .row {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
    }

    .patient-card {
        background-color: #ffffff;
        border-radius: 15px;
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        margin: 15px;
        padding: 20px;
        width: 250px;
        transition: transform 0.2s, box-shadow 0.2s;
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .patient-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 16px rgba(0,0,0,0.2);
    }

    .patient-card h5 {
        font-family: 'Arial', sans-serif;
        font-size: 1.25rem;
        color: #007bff;
        margin-bottom: 15px;
        text-align: center;
    }

    /* Style the button with hover effect */
    .follow-btn {
        background-color: #dc3545; /* Bootstrap danger color */
        border: none;
        padding: 10px 20px;
        color: #fff;
        font-size: 1rem;
        border-radius: 25px;
        cursor: pointer;
        transition: background-color 0.3s, transform 0.2s;
    }

    .follow-btn:hover {
        background-color: #b02a37;
        transform: scale(1.05);
    }
</style>
    </style>
</head>
<body style="background-color: rgb(238, 192, 104)">
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@elseif(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif
<a href="{{ url()->previous() }}" class="btn btn-secondary go-back-btn mt-3 mx-3">Go Back</a>


<div class="container patients-container mt-5">
    <h1 class="text-center mb-4">My Patients</h1>
    <div class="row justify-content-center">
        @foreach ($patients as $id => $name)
        <div class="patient-card col-md-4">
            <h5>{{ $name }}</h5>
            <form method="GET" action="{{ route('patient.myProfile', ['idd' => $id]) }}">
                <button type="submit" class="btn follow-btn">Visit Profile</button>
            </form>
        </div>
        @endforeach
    </div>
</div>

<script>


</script>

</body>
</html>
