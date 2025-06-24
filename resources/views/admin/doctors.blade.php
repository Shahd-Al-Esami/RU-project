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
<a href="{{ url('admin/dashboard') }}" class="btn btn-secondary go-back-btn mt-4 mx-3">Go Back</a>


    <div class="row">

<div class="container mt-5">
    <h1 class="text-center">Doctors List</h1>
<!-- حقل البحث -->
<div class="container mb-4">
    <form method="GET" action="">
                <button class="btn btn-primary" type="submit">get pending request</button>
            </div>
        </div>
    </form>
</div>


{{dd($doctors)
}}
    @foreach ($doctors as $doctor)
    <div class="col-md-4">
        <div class="card doctor-card">
            <div class="card-body">
         <img src="{{ asset('storage/' . $doctor->image) }}" alt="image" />

                <h5 class="card-title">{{ $doctor->name }}</h5>
                <p class="card-text">{{ $doctor->email }} </p>
                <p class="card-text">{{ $doctor->isAgreeDoctorRegistration }} </p>
<form action="{{ route('isAgreeDoctor',$doctor->id) }}" method="POST">

    <button type="submit">Agree</button>
</form>

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
