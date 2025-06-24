<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />

    <title>Plans Listing</title>
    <style>
          label {
    margin-right: 15px;
    font-weight: bold;
  }

  input[type="radio"] {
    margin-right: 5px;
  }
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
</head>
<body>

@extends('layouts.app')

@section('content')
<a href="{{ url('myOrdersPlans') }}" class="btn btn-secondary go-back-btn">Go Back</a>

<h1>Diet Plans</h1>

{{-- {{ dd($plan) }} --}}
    <table>
        <thead>
        <tr>
            <th>State</th>
            <th>Title</th>
            <th>Start Date</th>
            <th>End Date</th>
            <th style="text-align:center;">Details</th>
            <th style="text-align:center;"> Add Suggestions</th>
            <th style="text-align:center;">Add Rate</th>
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
            <td>
                <form action="{{ route('storeSuggest', $plan->id) }}" method="POST">
                @csrf

                <!-- Toggle Button -->
                <button class="follow-btn"  type="button" onclick="toggleSuggestionInput(this)">+ Add Suggest</button>

                <!-- Hidden Input Form -->
                <div class="suggestion-input" style="display: none;">
                    <input type="text" name="suggest" placeholder="Enter your suggestion..." required>
                    <button class="btn" type="submit">Submit</button>

                    @if($plan->suggests && $plan->suggests->count())
                    <div class="previous-suggestions">
                        <h4>Previous Suggestions:</h4>
                        <ul>
                            @foreach($plan->suggests as $suggestion)
                                <li>{{ $suggestion->suggest }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                </div>
            </form>
            </td>
            <td>
                @if(!$plan->review)
                <form action="{{ route('addPlanReview', $plan->id) }}" method="POST" onsubmit="hideRateInput(this)">
                    @csrf

                    <!-- Toggle Button -->
                    <button class="follow-btn" type="button" onclick="toggleRateInput(this)">+ Add Rate</button>

                    <!-- Hidden Input Section -->
                    <div class="rate-input" style="display: none; margin-top: 10px;">
                        <!-- Star Rating -->
                        <div class="star-rating">
                            @for ($i = 5; $i >= 1; $i--)
                                <input type="radio" id="star{{ $i }}_{{ $plan->id }}" name="rate" value="{{ $i }}">
                                <label for="star{{ $i }}_{{ $plan->id }}">&#9733;</label>
                            @endfor
                        </div>

                        <!-- Comment box -->
                        <input type="text" name="comment" placeholder="Enter your comment..." required>

                        <!-- Submit button -->
                        <button class="btn" type="submit">Save</button>

                        <!-- Display existing review -->

                    </div>
                </form>

@else                <div class="previous-review">
                    <p><strong>Rated:</strong> {{ $plan->review->rate }} ★</p>
                    <p><strong>Comment:</strong> {{ $plan->review->comment }}</p>
                </div>
            @endif

            </td>





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

                    </tr>
                    </thead>
                    <tbody>

                        @foreach($plan->descriptionPlans as $descriptionPlan)

                     <tr id="row_{{ $descriptionPlan->id }}">
    <td>{{ $descriptionPlan->week }} </td>
    <td>{{ $descriptionPlan->day }} </td>
    <td>{{ $descriptionPlan->meal }} </td>
    <td>{{ App\Models\Food::where('id',$descriptionPlan->food_id)->first()->name }} </td>
    <td>
<form action="{{ route('DescriptionPlan.isDone', $descriptionPlan->id)  }}" method="POST">
    @csrf

    <button class="follow-btn {{ $descriptionPlan->isDone ? 'done' : 'undone' }}" type="submit">
        {{ $descriptionPlan->isDone ? 'Done' : 'isDone?' }}
    </button>
</form>

    </td>


</tr>

                    @endforeach

                    </tbody>
                </table>
            </td>
        </tr>


        </tbody>
    </table>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>

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


    document.querySelectorAll(`input[name="isDone_{{ $descriptionPlan->id }}"]`).forEach((input) => {
    input.addEventListener('change', function() {
      // Implement any necessary actions when the radio button changes
      console.log(`Task ${this.name}: ${this.value === '1' ? 'Completed' : 'Not Completed'}`);
      // You can also add AJAX calls here to update the status if needed
    });
  });

  function toggleSuggestSection(button) {
        const section = button.closest('form').querySelector('.suggestion-section');
        section.style.display = section.style.display === 'none' ? 'block' : 'none';
    }
    function toggleSuggestionInput(button) {
        const form = button.closest('form');
        const inputDiv = form.querySelector('.suggestion-input');
        inputDiv.style.display = inputDiv.style.display === 'none' ? 'block' : 'none';
    }


    function toggleRateInput(button) {
        const section = button.closest('form').querySelector('.rate-input');
        section.style.display = section.style.display === 'none' ? 'block' : 'none';
    }

    function hideRateInput(form) {
        const section = form.querySelector('.rate-input');
        section.style.display = 'none';
    }

</script>
@endsection

</body>
</html>
