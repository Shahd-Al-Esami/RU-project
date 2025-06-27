<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>patients List</title>
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
<a href="{{ url('admin/dashboard') }}" class="btn btn-secondary go-back-btn mt-3 mx-3">Go Back</a>


<div class="container table-container">
    <h1 class="text-center">Patients List</h1>
    <table class="table table-bordered table-hover">
      <thead>
        <tr>
          <th>Image</th>
          <th>Name</th>
          <th>Email</th>
          <th>is Blocked</th>
          <th>is Deleted</th>
          <th>Actions</th>
          <th>Go To Profile</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($patients as $patient)
        <tr>
          <td>
            <img src="{{ asset('storage/' . $patient->image) }}" alt="Image" />
          </td>
          <td>{{ $patient->name }}</td>
          <td>{{ $patient->email }}</td>
          <td>{{ $patient->blocked==1? 'Yes':'No' }}</td>
          <td>{{ $patient->deleted_at?'Yes':'No' }}</td>

          <td>


            <form action="{{ route($patient->deleted_at ? 'user.restore' : 'user.softDelete', $patient->id) }}" method="POST" style="display:inline;">
                @csrf
                <button type="submit"
                    class="btn btn-primary btn-sm"
                    style="
                        background-color: {{ $patient->deleted_at ? '#20a4f0' : '#fa4d5e' }};
                        border: {{ $patient->deleted_at ? 'none' : 'none' }};
                        padding: 6px 12px;
                        border-radius: 4px;
                        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
                        color: {{ $patient->deleted_at ? 'white' : 'white' }};">
                    {{ $patient->deleted_at ? 'Restore' : 'Soft Delete' }}
                </button>
            </form>

            <form action="{{ route($patient->blocked ? 'disblockUser' : 'blockUser', $patient->id) }}" method="POST" style="display:inline;">
                @csrf
                <button type="submit"
                    class="btn btn-primary btn-sm"
                    style="
                        background-color: {{ $patient->blocked ? '#20a4f0' : '#fa4d5e' }};
                        border: {{ $patient->blocked ? 'none' : 'none' }};
                        padding: 6px 12px;
                        border-radius: 4px;
                        box-shadow: 0 2px 4px rgba(0,0,0,0.1)
                       ;">
                    {{ $patient->blocked ? 'DisBlock' : 'Block' }}
                </button>
            </form>
    </td>
       <td>
            <form method="GET" action="{{ route('patient.myProfile', ['idd' => $patient->id]) }}" style="display:inline;">
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
