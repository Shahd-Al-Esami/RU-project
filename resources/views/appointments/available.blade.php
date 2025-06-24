<!DOCTYPE html>
<html lang="ar">
<head>
<meta charset="UTF-8" />
<title>Available Appointments</title>
<!-- Bootstrap CDN for styling -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
    body {
        background: linear-gradient(135deg, #fff7f0, #ffe4b5);
        padding: 20px;
        font-family: Arial, sans-serif;
    }
    h1 {
        color: #ff7f50; /* coral-orange color for header */
        margin-bottom: 20px;
        text-align: center;
    }
    .container {
        max-width: 700px;
        margin: 0 auto;
        background: #fff;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        border-top: 5px solid #ff7f50; /* orange border for emphasis */
    }
    table {
        padding:30px;
        width: 100%;
        margin-top: 20px;
        border-collapse: collapse;
    }
    table th, table td {
        text-align: center;
    }
    thead {
        background-color: #ff7f50;
        color: #fff;
    }
    button {
        width: 100%;
        margin-top: 20px;
    }
    /* style for description input */
    #description {
        width: 100%;
        min-height: 100px;
        margin-top: 15px;
        padding: 10px;
        border-radius: 8px;
        border: 1px solid #ccc;
        font-family: Arial, sans-serif;
    }
</style>
</head>
<body>
    <a href="{{ url('/appointments') }}" class="btn btn-secondary">Go Back</a>

<div class="container">
<h1>Available Appointments for Doctor : {{ $doctor->name}} on date : {{ $date }}</h1>


@if(!$availableTimes || count($availableTimes) == 0)
    <div class="alert alert-info text-center" role="alert">
        No available appointments for this date.
    </div>
@else
    <form method="POST" action="{{ route('bookAppointment') }}">
        @csrf
        <input type="hidden" name="doctor_id" value="{{ $doctor_id }}">
        <input type="hidden" name="date" value="{{ $date }}">

<div class="mb-3">
    <label for="description" class="form-label">Appointment Description / Notes</label>
    <textarea id="description" name="description" placeholder="Add any additional notes or description here..." class="form-control"></textarea>
</div>

        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Select Time</th>
                    <th>Time Slot</th>
                </tr>
            </thead>
            <tbody>
                @foreach($availableTimes as $slot)
                    <tr>
                        <td class="text-center">
                            <input type="radio" name="time" value="{{ $slot }}" required>
                        </td>
                        <td>{{ $slot }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <button type="submit" class="btn btn-warning btn-lg text-white" style="background-color: #ff7f50;">Book Appointment</button>
    </form>
@endif
</div>
@if (session('message'))
    <div class="alert alert-warning">
        {{ session('message') }}
    </div>
@endif
</body>
</html>
