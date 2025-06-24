@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

<style>
    /* Overall page styling */
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background-color: #fff8f0; /* Light warm background */
        color: #333;
    }

    /* Container styling */
    .container {
        max-width: 900px;
        /* margin: 20px; */
        padding: 20px;
        background-color: #fff;
        border-radius: 15px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        border: 1px solid #f0ad4e; /* Light orange border */
    }

    /* Headings styling */
    h1, h2 {
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
        /* padding: 10px 10px; */
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

    .form-select, .form-control {
        border-radius: 8px;
        border: 1px solid #f0ad4e;
        box-shadow: inset 0 1px 3px rgba(0,0,0,0.1);
        transition: border-color 0.3s;
    }

    .form-select:focus, .form-control:focus {
        border-color: #ff7f50;
        outline: none;
        box-shadow: 0 0 8px rgba(255,127,80,0.3);
    }

    /* Button styling */
    .btn-primary {
        background-color: #ff7f50;
        border-color: #ff7f50;
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
        .list-group-item {
            padding: 12px 16px;
        }
    }
</style>
<a href="{{ url('doctor/dashboard') }}" class="btn btn-secondary go-back-btn mt-3 mx-3">Go Back</a>

<div class="container mt-5">
    <h1>Appointment Management</h1>
    <div class="appointments-list mt-4">
        <h2>My Appointments</h2>
                    <!-- حقل البحث -->
<div class="container mb-4">
    <form method="GET" action="">
        <div class="input-group">
            {{-- <label for="search">Search by Date:</label> --}}
            <input type="date" id="search" name="search" value="{{ request('search') }}" placeholder="Select a date">
             <div class="input-group-append">
                <button class="btn btn-primary mx-5" type="submit">Search</button>
            </div>
        </div>
    </form>
</div>
        <ul class="list-group">
            @if($appointments->isEmpty())
                <li class="list-group-item">No appointments booked.</li>
            @else


                @foreach($appointments as $appointment)
                    <li class="list-group-item mt-3">

                        <strong>Patient :</strong> {{ App\Models\User::where('id',$appointment->patient_id)->pluck('name') }},
                        <strong>Date :</strong> {{ $appointment->date }},
                        <strong>Time :</strong> {{ $appointment->time }},
                        <strong>Description :</strong> {{ $appointment->description }},
                        <strong>Status:</strong> {{ $appointment->status }}

                        <!-- Buttons for changing status -->
                        @if($appointment->status !='done' && $appointment->status !='cancel')

                        <div class="mt-2">
                            <!-- Cancel Button -->
                            <form action="{{ route('appointments.cancelStatus',$appointment->id) }}" method="POST" style="display: inline-block;">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="status" value="cancel">
                                <button type="submit" class="btn btn-danger btn-sm">Cancel</button>
                            </form>

                            <!-- Done Button -->
                  <form action="{{ route('appointments.doneStatus',$appointment->id) }}" method="POST" style="display: inline-block;">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="status" value="done">
                                <button type="submit" class="btn btn-success btn-sm">Done</button>
                            </form>
                        </div>
                        @endif
                    </li>
                @endforeach
            @endif
        </ul>
    </div>
</div>
@endsection

{{-- @if(session('message'))
<script>
    alert('{{ session('message') }}');
</script> --}}
{{-- @endif --}}
