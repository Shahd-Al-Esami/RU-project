@extends('layouts.app')

@section('content')
<style>

    body{
       background: linear-gradient(135deg, #fff7f0, #ffe4b5);

    }
    .container {
    padding: 20px;
    background: #fffdf7;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(255, 145, 0, 0.15);
    font-family: 'Segoe UI', sans-serif;
}

h2 {
    color: #f57c00;
    margin-bottom: 20px;
}

.table th {
    background-color: #ff9f43;
    color: white;
}

.table td, .table th {
    padding: 12px 15px;
    border: 1px solid #ffdba3;
}

.table tbody tr:nth-child(even) {
    background-color: #fff3e6;
}

.table tbody tr:hover {
    background-color: #ffeecc;
}






        /* Style for nested table */
        .nested-table {
            width: 100%;
            border-collapse: collapse;
        }

        .nested-table th, .nested-table td {
            padding: 8px;
            border: 1px solid #ddd; /* Add borders to the nested table */
        }

        /* Style for hidden rows */
        .details-row {
            display: none;
            background-color: #fff3e0; /* Light orange background */
        }

        /* Responsive font size on small screens */


        .follow-btn {
            margin-top: 10px;
            background-color: #f3b457; /* Light orange for follow button */
            border: none;
            padding: 10px 20px;
            color: #222121;
            font-size: 1rem;
            border-radius: 25px;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.2s;
            text-decoration: none; /* Remove underline */
        }

        .follow-btn:hover {
            background-color: #df9f51;
            transform: scale(1.05);
        }
        .done {
    background-color: #ade9eb; /* red for uncompleting */
}

.undone {
    background-color: #ee8065; /* green for completing */
}


.star-rating {
    direction: rtl;
    font-size: 24px;
    display: inline-flex;
    gap: 5px;
}

.star-rating input {
    display: none;
}

.star-rating label {
    color: #ccc;
    cursor: pointer;
    transition: color 0.2s;
}

.star-rating input:checked ~ label,
.star-rating label:hover,
.star-rating label:hover ~ label {
    color: gold;
}

.previous-review {
    margin-top: 10px;
    background-color: #f3f3f3;
    padding: 10px;
    border-radius: 5px;
}

</style>

<a href="{{ url('admin/dashboard') }}" class="follow-btn mx-3">Go Back</a>


<div class="container mt-5">

    <h2>Reports</h2>
                    <!-- حقل البحث -->
                    <div class="container mb-4">
                        <form method="GET" action="">
                            <div class="input-group">
                                {{-- <label for="search">Search by Date:</label> --}}
                                <input type="text" id="search" name="search" value="{{ request('search') }}" placeholder="Search by Patient Name">
                                 <div class="input-group-append">
                                    <button class="btn btn-primary mx-5" type="submit">Search</button>
                                </div>
                            </div>
                        </form>
                    </div>

    @if($reports->count())
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>created By Doctor </th>
                    <th>patient Name</th>
                    <th>patient Email</th>

                    <th>Report Title</th>
                    <th>Report Description</th>
                    <th>Date</th>
                    <th>recommended</th>
                    <th>The Rate</th>

                </tr>
            </thead>
            <tbody>
                @foreach($reports as $report)
                <tr>
                    <td>{{ $loop->iteration }}</td>

                    <td>{{ App\Models\User::where('id',$report->doctor_id)->first()->name?? '' }}</td>
                    <td>{{ App\Models\User::where('id',$report->patient_id)->first()->name?? '' }}</td>
                    <td>{{ App\Models\User::where('id',$report->patient_id)->first()->email??'' }}</td>

                    <td>{{ $report->title }}</td>
                    <td>{{ $report->description }}</td>
                    <td>{{ $report->date }}</td>
                    <td>{{ $report->recommended }}</td>
                    <td>
                      {{-- @if(!App\Models\Review::where('reviewable_type','App\Models\User')->where('reviewable_id',$report->patient_id)->first()) --}}
{{--
                        <form action="{{ route('addPatientReview', $report->patient_id) }}" method="POST" onsubmit="hideRateInput(this)">
                            @csrf

                            <!-- Toggle Button -->
                            <button class="btn btn-secondary btn-sm m-2" type="button" onclick="toggleRateInput(this)">+ Add Rate for patient</button>

                            <!-- Hidden Input Section -->
                            <div class="rate-input" style="display: none; margin-top: 10px;">
                                <!-- Star Rating -->
                                <div class="star-rating">
                                    @for ($i = 5; $i >= 1; $i--)
                                        <input type="radio" id="star{{ $i }}_{{ $report->patient_id }}" name="rate" value="{{ $i }}">
                                        <label for="star{{ $i }}_{{$report->patient_id }}">&#9733;</label>
                                    @endfor
                                </div>
                                <input type="text" name="comment" placeholder="Enter your comment..." required>

                                <!-- Submit button -->
                                <button class="btn" type="submit">Save</button>

                                <!-- Display existing review -->

                            </div>
                        </form>
                        @else --}}
                               <div class="previous-review">
                            <p><strong>Rated: {{ App\Models\Review::where('reviewable_type','App\Models\User')->where('reviewable_id',$report->patient_id)->first()->rate??'' }}</strong> /5 ★</p>
                            <p><strong>Comment:  {{ App\Models\Review::where('reviewable_type','App\Models\User')->where('reviewable_id',$report->patient_id)->first()->comment??''}}</strong> </p>
                        </div>
                    {{-- @endif --}}
                            </td>

                </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>No reports available.</p>
    @endif
</div>
@endsection

<script>

    function toggleRateInput(button) {
        const section = button.closest('form').querySelector('.rate-input');
        section.style.display = section.style.display === 'none' ? 'block' : 'none';
    }

    function hideRateInput(form) {
        const section = form.querySelector('.rate-input');
        section.style.display = 'none';
    }
</script>

