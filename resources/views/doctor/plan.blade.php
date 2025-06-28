<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />

    <title>Plans Listing</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(135deg, #fff7f0, #ffe4b5);
            margin: 0;
            padding: 20px;
        }

        h1 {
            color: #ff6f30; /* Orange color for headings */
            text-align: center;
            margin-bottom: 20px;
        }

        /* Style the main table */
        table {
            width: 100%;
            border-collapse: collapse;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            overflow: hidden;
            margin-bottom: 30px;
        }

        th, td {
            padding: 10px 10px;
        }

        thead {
            background-color: #ffcc80; /* Header background color */
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        /* Style for the buttons */
        .btn {
            padding: 8px 16px;
            background-color: #ff6f30; /* Button background color */
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .btn:hover {
            background-color: #ff5722; /* Darker shade on hover */
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
        @media(max-width: 600px) {
            body {
                font-size: 14px;
            }
            th, td {
                padding: 8px 8px;
            }
        }

        .follow-btn {
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
    </style>
</head>
<body>

@extends('layouts.app')

@section('content')
<a href="{{ url('getPlanOrders') }}" class="btn btn-secondary go-back-btn">Go Back</a>

<h1>Diet Plans</h1>

@if(!$plan)
    <p style="text-align:center; font-size: 1.2em; color: #666;">No plan available.</p>

    <h4 class="text-center mb-3">
        <a href="{{ route('addPlan',['plan_order_id'=>$plan_order_id]) }}" class="follow-btn">Add New Plan</a>
    </h4>
@else
@if(auth()->user()->role =='doctor')
    <div class="d-flex justify-content-end mb-4">
        <a href="{{ route('editPlan',$plan->plan_order_id) }}" class="follow-btn">Edit Plan</a>
    </div>
@endif
    <table>
        <thead>
        <tr>
            <th>State</th>
            <th>Title</th>
            <th>Start Date</th>
            <th>End Date</th>
            <th style="text-align:center;">Details</th>
            <th style="text-align:center;">Suggestions</th>
            <th style="text-align:center;">Rate</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>{{ ucfirst($plan->state) }}</td>
            <td>{{ $plan->title }}</td>
            <td>{{ $plan->start_date }}</td>
            <td>{{ $plan->end_date }}</td>
            <td style="text-align:center;">
                <button class="follow-btn toggle-details" data-id="details-{{ $plan->id }}">Show Details</button>
            </td>

         
             @if(auth()->user()->role ==='doctor')

             <td style="text-align:center;">

                <button class="follow-btn toggle-details2" data-id="details2-{{ $plan->id }}">display suggestions </button>
                <div id="details2-{{ $plan->id }}" class="suggestion-input" style="display:none; margin-top: 10px;">
                   @foreach($plan->suggests as $suggest)

                   <p>{{ $suggest->suggest }}</p>
                    @endforeach
                </div>


                </td>
                <td style="text-align:center;">
                    <button class="follow-btn toggle-details3" data-id="details3-{{ $plan->id }}">show patient review </button>
                    <div id="details3-{{ $plan->id }}" class="suggestion-input" style="display:none; margin-top: 10px;">

                        @if($plan->review)
                        <p><strong>Comment:</strong> {{ $plan->review->comment }}</p>
                        <p><strong>Rating:</strong> {{ $plan->review->rate }} /5</p>
                        {{-- <p><strong>Reviewed by User:</strong> {{ $plan->review->user_id }}</p> --}}
                    @else
                        <p>No review for this plan.</p>
                    @endif
                    </div>
                </td>
             @endif

        </tr>
        <!-- Details row, hidden by default -->
        <tr id="details-{{ $plan->id }}" class="details-row">
            <td colspan="5">
                <h3 style="margin: 10px 0; color: #333;">Schedule Details</h3>
                <table class="nested-table">
                    <thead>
                    <tr style="background-color:#ffcc80;">
                        <th>Week</th>
                        <th>Day</th>
                        <th>Meal</th>
                        <th>Food</th>
                        <th>is Done</th>
                        <th>Action</th>

                        <th>
                            @if(auth()->user()->role =='doctor')

                        <form method="POST" id="planForm" action="{{ route('storeDescriptionPlan',$plan->id) }}">
                            @csrf
                        <td>
                         <input type="number" name="week" required placeholder="Enter week" class="form-control" >
                     </td>
                        <td>
                         <input type="date" name="day" required placeholder="Enter day" class="form-control" >
                     </td>
                     <td>
                         <input type="text" name="meal" required placeholder="Enter meal" class="form-control" >
                     </td>
                     <td>

                         <select name="food_id" class="form-select" id="food_id">
                            <option value="" selected >choice food</option>

                             @foreach(App\Models\Food::all() as $food)
                             <option value="{{ $food->id }}" >{{ $food->name }}</option>
                             @endforeach
                         </select>
                     </td>


                     <td>
                         <button type="submit" class="btn btn-success">Add </button>
                     </td>
                 </form>
                      @endif


                        </th>

                    </tr>
                    </thead>
                    <tbody>

                        @foreach($plan->descriptionPlans as $descriptionPlan)


                        <form method="POST" id="form_{{ $descriptionPlan->id }}" action="{{ route('updateDescriptionPlan', [$plan->id,$descriptionPlan->id]) }}">
                               @csrf
                            <tr id="row_{{ $descriptionPlan->id }}">
    <td><input type="number" name="week_{{ $descriptionPlan->id }}" value="{{ $descriptionPlan->week }}" class="form-control" readonly></td>
    <td><input type="date" name="day_{{ $descriptionPlan->id }}" value="{{ $descriptionPlan->day }}" class="form-control" readonly></td>
    <td><input type="text" name="meal_{{ $descriptionPlan->id }}" value="{{ $descriptionPlan->meal }}" class="form-control" readonly></td>
    <td>
        <select name="food_id_{{ $descriptionPlan->id }}" id="food_id_{{ $descriptionPlan->id }}" class="form-select" disabled >
            <option value="">اختر الطعام</option>
            @foreach(App\Models\Food::all() as $food)
                <option value="{{ $food->id }}" {{ $food->id == $descriptionPlan->food_id ? 'selected' : '' }}>
                    {{ $food->name }}
                </option>
            @endforeach
        </select>
    </td>
    <td>
        <label>
            <input type="radio" name="isDone_{{ $descriptionPlan->id }}" value="1" {{ $descriptionPlan->isDone ? 'checked' : '' }} disabled> Yes
        </label>
        <label>
            <input type="radio" name="isDone_{{ $descriptionPlan->id }}" value="0" {{ !$descriptionPlan->isDone ? 'checked' : '' }} disabled> No
        </label>
    </td>
    <td>
        <button class="btn" type="button" onclick="enableEdit({{ $descriptionPlan->id }})">تعديل</button>
        <button class="btn" type="submit" id="saveButton_{{ $descriptionPlan->id }}" disabled>حفظ</button>
    </td>

</tr>

                        </form>
                    @endforeach

                    </tbody>
                </table>
            </td>
        </tr>


        </tbody>
    </table>
@endif
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
$(document).ready(function() {
    $('.toggle-details2').click(function() {
        var detailsId = $(this).data('id');
        $('#' + detailsId).toggle(); // Toggle the visibility of the input field
    });

    $('.btn-submit-suggestion').click(function() {
        var suggestion = $(this).siblings('input').val();
        // Handle the suggestion submission logic here (e.g., AJAX call)
        alert("Your suggestion: " + suggestion); // Placeholder alert for demonstration
    });
});

    document.querySelectorAll('.toggle-details').forEach(btn => {
        btn.addEventListener('click', () => {
            const id = btn.getAttribute('data-id');
            const row = document.getElementById(id);
            if (row.style.display === 'none' || row.style.display === '') {
                row.style.display = 'table-row';
            } else {
                row.style.display = 'none';
            }
        });
    });

    function enableEdit(id) {
    const row = document.getElementById(`row_${id}`);
    const inputs = row.querySelectorAll('input, select');
    inputs.forEach(input => {
        input.removeAttribute('readonly');
        input.removeAttribute('disabled');
    });
    document.getElementById(`saveButton_${id}`).disabled = false;
}



document.addEventListener('DOMContentLoaded', function() {
        // للجميع الأزرار ذات الصنف toggle-details3
        document.querySelectorAll('.toggle-details3').forEach(function(button) {
            button.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                const contentDiv = document.getElementById(id);
                if (contentDiv.style.display === 'none') {
                    contentDiv.style.display = 'block';
                } else {
                    contentDiv.style.display = 'none';
                }
            });
        });
    });
</script>
@endsection

</body>
</html>
