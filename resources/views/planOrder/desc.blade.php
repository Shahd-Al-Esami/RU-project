<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

<title>Cards Example</title>
<style>
  /* Basic reset and body styles */
  body {
    font-family: 'Open Sans', Arial, sans-serif;
    background: linear-gradient(135deg, #fff7f0, #ffe4b5);
    margin: 0;
    padding: 20px;
    display: flex;
    flex-direction: column;
    align-items: center;
  }

  /* Container for all cards */
  .cards-container {
    display: flex;
    gap: 20px;
    flex-wrap: wrap;
    max-width: 1400px;
    justify-content: center;
  }

  /* Individual card styles */
  .card {
    background-color: #fff;
    border-radius: 12px;
    box-shadow: 0 8px 16px rgba(0,0,0,0.2);
    width: 300px;
    padding: 20px;
    animation: slideIn 1s ease-out;
    display: flex;
    flex-direction: column;
    height: auto;
  }

  /* Card header */
  .card h3 {
    margin-top: 0;
    margin-bottom: 15px;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    font-weight: 700;
    text-align: center;
  }

  /* Card content text or form */
  .card p, .card form {
    margin: 0;
  }

  /* Styles for forms within cards */
  form {
    display: flex;
    flex-direction: column;
  }

  label {
    margin-bottom: 6px;
    font-weight: 600;
    color: #555;
  }

  input[type="text"], input[type="date"], input[type="number"] {
    padding: 12px 15px;
    margin-bottom: 16px;
    border-radius: 8px;
    border: 1px solid #ccc;
    font-size: 1rem;
    transition: border-color 0.3s, box-shadow 0.3s;
  }

  input[type="text"]:focus, input[type="date"]:focus, input[type="number"]:focus {
    border-color: #ab7810;
    box-shadow: 0 0 8px rgba(106, 65, 255, 0.2);
    outline: none;
  }

  /* Button styles for create order button */
  .btn {
    background-color: #b17823;
    color: #fff;
    padding: 14px;
    border-radius: 8px;
    border: none;
    font-size: 1.1rem;
    font-weight: 600;
    cursor: pointer;
    transition: background-color 0.3s, transform 0.2s;
  }

  .btn:hover {
    background-color: #e0af32;
    transform: translateY(-2px);
  }

  /* Success message style */
  .alert-success {
    margin-top: 20px;
    padding: 14px;
    background-color: #d4edda;
    border: 1px solid #c3e6cb;
    border-radius: 8px;
    color: #155724;
    font-weight: 600;
    text-align: center;
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    animation: fadeIn 1s ease-in-out;
  }

  /* Animations */
  @keyframes slideIn {
    from { transform: translateY(-50px); opacity: 0; }
    to { transform: translateY(0); opacity: 1; }
  }

  @keyframes fadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
  }

  /* Responsive adjustments */
  @media(max-width: 1000px) {
    .cards-container {
      flex-direction: column;
      align-items: center;
    }
  }
</style>
</head>
<body>
    <h3 style="font-family: initial"><b>Why do you need a plan ? </b></h3>

<!-- Container for all 3 cards -->
<div class="cards-container mt-2">

  <!-- Card 1: Form to create plan order -->

    <!-- Example success message, you can toggle it based on logic -->
    <!-- <div class="alert-success">Order created successfully!</div> -->
    {{-- <form method="POST" action="">
      @csrf --}}

      {{-- <label for="plan_name">Plan Name</label>
      <input type="text" name="plan_name" id="plan_name" required>

      <label for="description">Description</label>
      <input type="date" name="description" id="description" required>

      <label for="goals">Goals</label>
      <input type="date" name="goals" id="goals" required>

      <label for="price">Price ($)</label>
      <input type="number" name="price" id="price" step="0.01" min="0" required>

      <button type="submit" class="btn">Create Order</button>
    </form> --}}
  {{-- </div> --}}

  <div class="card">
    <h3>Keep A Healthy Routine</h3>
    <p style="font-family: cursive">A healthy routine includes eating nutritious foods, staying active regularly, getting enough sleep, and taking time to relax. It also means drinking plenty of water, avoiding stress, and maintaining good hygiene. Consistency is key to making healthy habits part of your daily life.</p>
<br>
<p style="font-family: cursive;color: #ae7d29">Better physical and mental health
    More energy and focus
    Improved mood and reduced stress
    Stronger immune system
    Feeling happier and more balanced</p>
</div>
  <!-- Card 2: Info / Placeholder for additional info -->
  <div class="card">
    <h3>Weight Loss Plan</h3>
    <p style="font-family: cursive">Weight Loss Plan:
        A weight loss plan typically involves a healthy diet, regular exercise, and lifestyle changes. It may include eating more fruits, vegetables, lean proteins, and whole grains while reducing sugar, processed foods, and unhealthy fats. Staying active through activities like walking, running, or fitness classes is also important. Consistency and patience are key to seeing results.</p>
<br>
     <p style="color: #ae7d29;font-family: cursive"> **Benefits of Losing Weight**

    Improved overall health
    Increased energy levels
    Better sleep
    Reduced risk of chronic diseases such as diabetes, heart disease, and high blood pressure
    Enhanced mood and self-confidence .</p>

    </div>

  <!-- Card 3: Another info or support card -->
  <div class="card">
    <h3>Gain Weight Plan </h3>
    <p style="font-family: cursive">A weight gain plan involves eating more calories than you burn, focusing on nutritious, calorie-dense foods. It includes eating frequent meals with healthy fats, proteins, and carbs like nuts, seeds, dairy, lean meats, and whole grains. Strength training exercises can help build muscle mass and improve overall weight gain.</p>
<br>
<p  style="color: #ae7d29;font-family: cursive">**Benefits of Gaining Weight**

    Increased muscle strength and size
    Improved energy levels
    Better overall health and body function
    Enhanced immune system
    Improved confidence and body image</p>


</div>
<a href="{{ route('createPlan') }}" style="align-self: center;width:300px;" class="btn">Go To Order</a>

</div>

</body>
</html>
