<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />
  <title>Doctors List</title>
  <style>
    body {
      background: linear-gradient(135deg, #fff7f0, #ffe4b5);
      font-family: 'Arial', sans-serif;
    }

    .table-container {
      margin-top: 50px;
      padding: 20px;
      background-color: rgba(255, 255, 255, 0.9);
      border-radius: 15px;
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
    }

    h1 {
      margin-bottom: 30px;
      font-weight: bold;
      text-shadow: 1px 1px 2px #ccc;
    }

    /* Style for the table */
    table {
      width: 100%;
      border-collapse: separate;
      border-spacing: 0 10px;
      background-color: #fff;
    }

    thead {
      background-color: #fed354d3; /* Bootstrap warning color for header */
      color: #fff;
    }

    th {
      padding: 15px;
      text-align: center;
      font-weight: 600;
    }

    tbody tr {
      transition: all 0.3s ease;
      border-radius: 10px;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
      margin-bottom: 10px;
    }

    tbody tr:hover {
      background-color: #ffe4b5;
      transform: translateY(-5px);
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    }

    td {
      padding: 15px;
      vertical-align: middle;
      text-align: center;
    }

    /* Style for images */
    td img {
      width: 80px;
      height: auto;
      border-radius: 50%;
      border: 2px solid #fbd037f0;
    }

    /* Buttons styling */
    .btn-sm {
      margin: 5px;
      border-radius: 20px;
      padding: 6px 15px;
      font-weight: 600;
    }

    /* Specific button colors */
    .btn-primary {
      background-color: #20a4f0;
      border-color: #007bff;
    }

    .btn-primary:hover {
      background-color: #0069d9;
      border-color: #0062cc;
    }

    .btn-danger {
      background-color: #fa4d5e;
      border-color: #dc3545;
    }

    .btn-danger:hover {
      background-color: #c82333;
      border-color: #bd2130;
    }

    /* Responsive adjustments */
    @media(max-width: 768px) {
      body {
        font-size: 14px;
      }

      td img {
        width: 60px;
      }
    }
  </style>
</head>
<body>
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

  <div class="container table-container">
    <h1 class="text-center">Doctors List</h1>
    <table class="table table-bordered table-hover">
      <thead>
        <tr>
          <th>Image</th>
          <th>Name</th>
          <th>Email</th>
          <th>Registration Status</th>
          <th>Holiday</th>
          <th>is Blocked</th>
          <th>is Deleted</th>
          <th>Actions</th>
          <th>Go To Profile</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($doctors as $doctor)
        <tr>
          <td>
            <img src="{{ asset('storage/' . $doctor->image) }}" alt="Image" />
          </td>
          <td>{{ $doctor->name }}</td>
          <td>{{ $doctor->email }}</td>
          <td>{{ $doctor->isAgreeDoctorRegistration }}</td>
          <td> {{ $doctor->doctorHoliday()->pluck('day')->join(', ')?? 'no holiday' }}</td>
          <td>{{ $doctor->blocked==1? 'Yes':'No' }}</td>
          <td>{{ $doctor->deleted_at?'Yes':'No' }}</td>

          <td>


            @if($doctor->isAgreeDoctorRegistration ==='agree')
            <form action="{{ route($doctor->deleted_at ? 'user.restore' : 'user.softDelete', $doctor->id) }}" method="POST" style="display:inline;">
                @csrf
                <button type="submit"
                    class="btn btn-primary btn-sm"
                    style="
                        background-color: {{ $doctor->deleted_at ? '#20a4f0' : '#fa4d5e' }};
                        border: {{ $doctor->deleted_at ? 'none' : 'none' }};
                        padding: 6px 12px;
                        border-radius: 4px;
                        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
                        color: {{ $doctor->deleted_at ? 'white' : 'white' }};">
                    {{ $doctor->deleted_at ? 'Restore' : 'Soft Delete' }}
                </button>
            </form>

            <form action="{{ route($doctor->blocked ? 'disblockUser' : 'blockUser', $doctor->id) }}" method="POST" style="display:inline;">
                @csrf
                <button type="submit"
                    class="btn btn-primary btn-sm"
                    style="
                        background-color: {{ $doctor->blocked ? '#20a4f0' : '#fa4d5e' }};
                        border: {{ $doctor->blocked ? 'none' : 'none' }};
                        padding: 6px 12px;
                        border-radius: 4px;
                        box-shadow: 0 2px 4px rgba(0,0,0,0.1)
                       ;">
                    {{ $doctor->blocked ? 'DisBlock' : 'Block' }}
                </button>
            </form>
            @else
            <form method="POST" action="{{ route('isAgreeDoctor', ['id' => $doctor->id]) }}" style="display:inline;">
                @csrf
                <button type="submit" class="btn btn-secondary btn-sm">Agree</button>
              </form>
        @endif
    </td>
       <td>
            <form method="GET" action="{{ route('doctorProfile', ['id' => $doctor->id]) }}" style="display:inline;">
              @csrf
              <button type="submit" class="btn btn-secondary btn-sm">Visit Profile</button>
            </form>
          </td>

        </tr>
        @endforeach
      </tbody>
    </table>
  </div>

<script>
</script>
</body>
</html>
