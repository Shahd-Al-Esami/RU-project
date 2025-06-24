<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Plan Orders</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #fff7f0, #ffe4b5);
            margin: 20px;
            color: #333;
        }

        h1 {
            color: #ff6600; /* Bright orange header */
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            background-color: #fff3e0;
        }

        thead {
            background-color: #ffcc80; /* Light orange for header background */
        }

        th {
            padding: 12px;
            text-align: left;
            color: #fff;
            font-weight: bold;
        }

        td {
            padding: 12px;
            border-bottom: 1px solid #f0f0f0;
        }

        tr:hover {
            background-color: #ffe0b2; /* Slight hover effect for rows */
        }

        p {
            text-align: center;
            font-size: 1.2em;
            color: #cc3300; /* Darker orange for no records message */
        }

        .follow-btn {
        background-color: #ffcc80; /* Bootstrap danger color */
        border: none;
        padding: 10px 20px;
        color: #222121;
        font-size: 1rem;
        border-radius: 25px;
        cursor: pointer;
        transition: background-color 0.3s, transform 0.2s;
    }

    .follow-btn:hover {
        background-color: #df9f51;
        transform: scale(1.05);
    }
    </style>
</head>
<body>
<a href="{{ url('doctor/dashboard') }}" class="btn btn-secondary go-back-btn">Go Back</a>

<div class="d-flex justify-content-end">

<form action="{{ route('addPrice') }}" method="POST">
    @csrf

    <!-- Toggle Button -->
    <button class="follow-btn"  type="button" onclick="togglePriceInput(this)">add new price</button>

    <!-- Hidden Input Form -->
    <div class="price-input" style="display: none;">
        <input type="number" name="price" placeholder="Enter the new price..." required>
        <button class="btn" type="submit">Submit</button>

    </div>
</form>
</div>


    <h1>Plan Orders</h1>
    @if($planOrders->isEmpty())
        <p>No plan orders.</p>
    @else
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Patient</th>
                <th>Goals</th>
                <th>Paid</th>
                <th>Price</th>
                <th>Created At</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($planOrders as $order)
                <tr>
                    <td>{{ $order->id }}</td>
                    <td>{{ App\Models\User::where('id', $order->patient_id)->firstOrFail()->name ?? 'N/A' }}</td>
                    <td>{{ $order->goals }}</td>
                    <td>{{ $order->isPaid ? 'Yes' : 'No' }}</td>
                    <td>${{ number_format($order->price, 2) }}</td>
                    <td>{{ $order->created_at }}</td>
                    <td>
                        <!-- Buttons -->
                        <a href="{{ route('patient.myProfile', ['idd'=>$order->patient_id]) }}" class="btn follow-btn">Go to Profile</a>
                        {{-- <a href="" class="btn follow-btn">Make Plan</a> --}}
                        <a href="{{ route('showPlan',['plan_order_id'=>$order->id]) }}" class="btn follow-btn">Display the Plan</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @endif

<script>
      function togglePriceSection(button) {
        const section = button.closest('form').querySelector('.price-section');
        section.style.display = section.style.display === 'none' ? 'block' : 'none';
    }
    function togglePriceInput(button) {
        const form = button.closest('form');
        const inputDiv = form.querySelector('.price-input');
        inputDiv.style.display = inputDiv.style.display === 'none' ? 'block' : 'none';
    }
</script>

</body>
</html>
