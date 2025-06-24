@extends('layouts.app')

@section('content')
<style>

.container {
    padding: 20px;
    background: #fff8f0;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(255, 153, 0, 0.2);
    font-family: 'Segoe UI', sans-serif;
}
body{
    background: linear-gradient(135deg, #fff7f0, #ffe4b5);

}
h2 {
    color: #ff7a00;
    margin-bottom: 20px;
}

.table {
    width: 100%;
    border-collapse: collapse;
    background: white;
}

.table th, .table td {
    padding: 12px 15px;
    border: 1px solid #ffd6a0;
    text-align: left;
}

.table thead {
    background-color: #ffb347;
    color: white;
}

.table tbody tr:nth-child(even) {
    background-color: #fff1e0;
}

.table tbody tr:hover {
    background-color: #ffe5cc;
}

.text-success {
    color: #28a745;
    font-weight: bold;
}

.text-danger {
    color: #dc3545;
    font-weight: bold;
}

</style>
<a href="{{ url('doctor/dashboard') }}" class="btn btn-secondary go-back-btn mt-3 mx-3">Go Back</a>

<div class="container">
    <h2 style="text-align: center">My Bills</h2>
    <h4 >the total is :{{  App\Models\PlanOrder::where('doctor_id',auth()->user()->id)->where('isPaid',1)->count() * $bills->first()->price }}/{{ App\Models\PlanOrder::count() * $bills->first()->price }} $</h4>
    @if($bills->count())
        <table class="table table-bordered mt-5">
            <thead>
                <tr>
                    <th>#</th>
                    <th>patien name</th>
                    <th>patien email</th>
                    <th>patien phone number</th>
                    <th>planOrder id</th>
                    <th> about planOrder </th>
                    <th>Date </th>

                    <th>price </th>
                    <th>is paid</th>
                </tr>
            </thead>
            <tbody>
                @foreach($bills as $bill)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ App\Models\User::where('id',$bill->patient_id)->first()->name }}</td>
                    <td>{{ App\Models\User::where('id',$bill->patient_id)->first()->email }}</td>
                    <td>{{ App\Models\User::where('id',$bill->patient_id)->first()->phone_number }}</td>
                    <td>{{ $bill->id }}</td>
                    <td>{{ $bill->goals }}</td>
                    <td>{{ $bill->created_at}}</td>

                    <td>{{ $bill->price }}</td>
                    <td style="background-color: #ffd6a0">{{ $bill->isPaid? 'Yes':'No' }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>No bills to display.</p>
    @endif
</div>
@endsection
