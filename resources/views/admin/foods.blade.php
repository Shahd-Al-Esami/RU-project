<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />

    <title>Food& Ingredients Listing</title>
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
        @media(max-width: 700px) {
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
<a href="{{ url('/admin/dashboard') }}" class="btn btn-secondary">Go Back</a>

<div class="container">
    <h2 class="text-center text-orange mb-4">🍽️ Food & Ingredients Manager</h2>

    <!-- Add New Food Button -->
    <div class="mb-3">
        <button
  id="toggleFoodFormButton"
  class="btn btn-outline-primary"
  type="button">
  ➕ Add Food
 </button>
</div>

<!-- New Food Form -->
<div id="foodForm" style="display: none;">
 <form action="{{ route('storeFood') }}" method="POST" class="mb-4 p-3 bg-light border rounded">
  @csrf
  <div class="form-row">
  <div class="col-md-4 mb-2">
   <label for="foodName" class="form-label">Food Name</label>
   <input type="text" name="name" id="foodName" class="form-control" placeholder="Food Name" required aria-required="true">
  </div>

  <div class="col-md-4 mb-2">
   <label for="calories" class="form-label">Calories</label>
   <input type="number" step="0.01" name="calories" id="calories" class="form-control" placeholder="Calories" required aria-required="true">
  </div>

  <div class="col-md-4 mb-2">
   <label for="ingredients" class="form-label">Select Ingredients</label>
   <select name="ingredient_ids[]" id="ingredients" class="form-control" multiple required aria-required="true">
    @foreach(\App\Models\Ingredient::all() as $ingredient)
    <option value="{{ $ingredient->id }}">
    ingredient : {{ $ingredient->name }} ,calories : {{ $ingredient->calories }}
    </option>
    @endforeach
   </select>

  </div>

  <div class="col-12 text-right">
   <button type="submit" class="btn btn-success">Add Food</button>
  </div>

  </div>
 </form>
</div>


    <!-- Add New Ingredient -->
    <button class="btn btn-outline-warning mb-3" type="button" id="toggleIngredientFormBtn">➕ Add Ingredient</button>

    <!-- New Ingredient Form -->
 <div id="ingredientForm" style="display: none;">

        <form id="form" action="{{ route('storeIngredient') }}" method="POST" class="mt-3 p-3 bg-light border rounded">
            @csrf
            <div class="form-row align-items-end">
                <div class="col-md-6 mb-2">
                    <input type="text" name="name" class="form-control" placeholder="Ingredient Name" required>
                </div>
                <div class="col-md-4 mb-2">
                    <input type="number" step="0.01" name="calories" class="form-control" placeholder="Calories" required>
                </div>
                <div class="col-auto">
                    <button type="submit" class="btn btn-outline-warning">Add Ingredient</button>
                </div>
            </div>

        </form>

        <div class="ingredient-list">
            <h5 class="text-center mb-3" style="color: #495057;">Existing Ingredients</h5>

            @foreach(App\Models\Ingredient::all() as $ingredient)
                <div class="ingredient-item p-2 mb-2 border rounded" style="background-color: #ffffff;">
                    <form action="{{ route('updateingredient' ,$ingredient->id) }}" method="POST" id="form2_{{ $ingredient->id }}">
                       @csrf
                   Name : <input type="text" name="name" value="{{ $ingredient->name }}" class="form-control" id="name_{{ $ingredient->id }}" readonly required>

                   Calories : <input type="number" step="0.01" name="calories" value="{{ $ingredient->calories }}" class="form-control" id="calories_{{ $ingredient->id }}" readonly required>

                        <button type="button" class="btn btn-sm btn-secondary mt-3 mr-2" onclick="enableIngredientEdit({{ $ingredient->id }})" id="editBtn2_{{ $ingredient->id }}">Edit</button>

                        <button type="submit" class="btn btn-sm btn-primary mt-3 mr-2" id="saveBtn2_{{ $ingredient->id }}" style="display: none;">Save</button>

                    </form>
                        <form class="mt-3" action="{{ route('deleteIngredient', $ingredient->id) }}" method="POST" onsubmit="return confirm('Delete this Ingredient?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </div>
            @endforeach
        </div>
    </div>




  <!-- Foods Table -->
    <div class="table-responsive mt-4">
        <table class="table table-striped table-bordered align-middle text-center">
            <thead class="thead-dark">
                <tr>
                    <th>Food</th>
                    <th>Calories</th>
                    <th>Ingredients</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                @foreach($foods as $food)
                <tr id="row_{{ $food->id }}" class="table-warning">
                    <form action="{{ route('updateFood', $food->id) }}" method="POST" id="form_{{ $food->id }}">
                        @csrf
                        <td>
                            <input type="text" name="name" value="{{ $food->name }}" class="form-control" id="name_{{ $food->id }}" readonly required>
                        </td>
                        <td>
                            <input type="number" step="0.01" name="calories" value="{{ $food->calories }}" class="form-control" id="calories_{{ $food->id }}" readonly required>
                        </td>
                        <td>
                            <select id="ingredient_ids_{{ $food->id }}" name="ingredient_ids[]" class="form-control" multiple disabled>
                                @foreach(\App\Models\ingredient::all() as $ingredient)
                                    <option value="{{ $ingredient->id }}" {{ in_array($ingredient->id, $food->ingredients->pluck('id')->toArray()) ? 'selected' : '' }}>
                                        {{ $ingredient->name }},   {{ $ingredient->calories }} cal
                                    </option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <div class="d-flex justify-content-center w-100">
                                <button type="button" class="btn btn-sm btn-secondary mr-2" onclick="enableFoodEdit({{ $food->id }})" id="editBtn_{{ $food->id }}">Edit</button>

                                <button type="submit" class="btn btn-sm btn-primary mr-2" id="saveBtn_{{ $food->id }}" style="display: none;">Save</button>
                            </div>
                        </td>
                    </form>

                    <td>
                        <form action="{{ route('deleteFood', $food->id) }}" method="POST" onsubmit="return confirm('Delete this food?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>




@endsection



<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>

$(document).ready(function() {
   // Toggle the food form visibility
   $('#toggleFoodFormButton').click(function() {
       $('#foodForm').slideToggle();
   });

   // Handle form submission
   $('#foodForm form').on('submit', function(event) {
       event.preventDefault(); // Prevent default form submission

       // Validate form inputs
       let isValid = true;
       const foodName = $('input[name="name"]').val();
       const calories = $('input[name="calories"]').val();
       const ingredients = $('select[name="ingredient_ids[]"]').val();

       if (!foodName || foodName.trim() === "") {
           alert("Food Name is required!");
           isValid = false;
       }

       if (!calories || calories <= 0) {
           alert("Calories must be greater than 0!");
           isValid = false;
       }

       if (!ingredients || ingredients.length === 0) {
           alert("At least one ingredient must be selected!");
           isValid = false;
       }

       // Proceed with AJAX submission if valid
       if (isValid) {
           $.ajax({
               url: $(this).attr('action'),
               method: 'POST',
               data: $(this).serialize(),
               success: function(response) {
                   alert("Food submitted successfully!");
                   // Optionally clear the form inputs
                   $('#foodForm')[0].reset();
                   $('#foodForm').slideUp(); // Hide form after submission
               },
               error: function(xhr) {
                   alert("An error occurred: " + xhr.responseText);
               }
           });
       }
   });

    // Expose enableFoodEdit globally
    window.enableFoodEdit = function(id) {
        $('#name_' + id).removeAttr('readonly');
        $('#calories_' + id).removeAttr('readonly');
        $('#ingredient_ids_' + id).removeAttr('disabled');

        $('#editBtn_' + id).hide();
        $('#saveBtn_' + id).show().focus();
    // $('#form_'+ id).submit();

    };

});






// for ingredient

$(document).ready(function () {
    // Toggle ingredient form visibility
    $('#toggleIngredientFormBtn').on('click', function () {
        $('#ingredientForm').slideToggle().toggleClass('open');
    });

    // Enable editing for specific ingredient fields
    window.enableIngredientEdit = function(id) {
        $('#name_' + id + ', #calories_' + id).prop('readonly', false);

        $('#editBtn2_' + id).hide();
        $('#saveBtn2_' + id).show().focus();

        $('#ingredientRow_' + id).addClass('editing'); // Optional: highlight row in edit mode
    };

    // Save changes and disable inputs again
    window.saveIngredient = function(id) {
        const nameField = $('#name_' + id);
        const caloriesField = $('#calories_' + id);

        // Basic validation
        if (nameField.val().trim() === '') {
            alert('Ingredient name is required.');
            nameField.focus();
            return;
        }

        // Reset fields to readonly
        nameField.prop('readonly', true);
        caloriesField.prop('readonly', true);

        // Toggle buttons
        $('#saveBtn2_' + id).hide();
        $('#editBtn2_' + id).show();

        // Remove editing highlight
        $('#ingredientRow_' + id).removeClass('editing');

        // Optional: submit form if needed
        // $('#form_' + id).submit();
    };
});













</script>

</body>
</html>
