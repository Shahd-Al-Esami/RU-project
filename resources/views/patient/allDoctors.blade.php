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
        .doctor-card {
            margin-bottom: 20px;
        }
        .follow-btn {
            margin-top: 10px;
        }
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
<a href="{{ url()->previous() }}" class="btn btn-secondary go-back-btn mt-4 mx-3">Go Back</a>


    <div class="row">

<div class="container mt-5">
    <h1 class="text-center">Doctors List</h1>
<!-- حقل البحث -->
<div class="container mb-4">
    <form method="GET" action="">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Search about doctors..." value="{{ request('search') }}" />
            <div class="input-group-append">
                <button class="btn btn-primary" type="submit">Search</button>
            </div>
        </div>
    </form>
</div>




    @foreach ($doctors as $doctor)
    <div class="col-md-4">
        <div class="card doctor-card">
            <div class="card-body">
         <img src="{{ asset('storage/' . $doctor->image) }}" alt="image" />

                <h5 class="card-title">{{ $doctor->name }}</h5>
                <p class="card-text">{{ $doctor->age }} years old</p>

                @php
                    $isFollowing = auth()->user()->doctors()->where('doctor_id', $doctor->id)->exists();
                @endphp

                @if($isFollowing)
                    <form method="POST" action="{{ route('disfollowDoctor', ['doctor_id' => $doctor->id]) }}">
                        @csrf <!-- Include CSRF token for security -->
                        <button type="submit" class="btn btn-danger follow-btn">
                            Unfollow
                        </button>
                    </form>
                @else
                    <form method="POST" action="{{ route('followDoctor', ['doctor_id' => $doctor->id]) }}">
                        @csrf <!-- Include CSRF token for security -->
                        <button type="submit" class="btn btn-primary follow-btn">
                            Follow
                        </button>
                    </form>
                @endif
                <form method="GET" action="{{ route('doctorProfile', ['id' => $doctor->id]) }}">
                    @csrf <!-- Include CSRF token for security -->
                    <button type="submit" class="btn btn-danger follow-btn">
                        visit profile
                    </button>
                </form>
            </div>
        </div>
    </div>
@endforeach

    </div>
</div>

<script>


</script>

</body>
</html>
