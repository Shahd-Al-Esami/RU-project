<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />

    <title>Food listing</title>
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
<a href="{{ url('/doctor/dashboard') }}" class="btn btn-secondary">Go Back</a>

<div class="container">
    <h2 class="text-center text-orange mb-4">🍽️ Food Listing</h2>


  <!-- Foods Table -->
    <div class="table-responsive mt-4">
        <table class="table table-striped table-bordered align-middle text-center">
            <thead class="thead-dark">
                <tr>
                    <th>Food</th>
                    <th>Calories</th>
                    <th>Ingredient 1</th>
                    <th>Ingredient 2</th>
                    <th>Ingredient 3</th>
                    <th>Ingredient 4</th>
                    <th>Ingredient 5</th>

                </tr>
            </thead>
            <tbody>
                @foreach($foods as $food)
                <tr class="table-warning">

                        <td> Food Name :<p>{{ $food->name }}</p> </td>
                        <td> Calories :<p>{{ $food->calories }}</p> </td>
                @foreach($food->ingredients as $ingredient)

                        <td> The Ingredient Name :<p>{{$ingredient->name }}</p>
                       The Ingredient Calories :<p>{{ $ingredient->calories }}</p> </td>
                        @endforeach



                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>




@endsection




</body>
</html>
