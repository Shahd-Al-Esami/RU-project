<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<meta http-equiv="X-UA-Compatible" content="ie=edge"/>
<title>Create Plan</title>
<style>
  body {
    font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
    background: linear-gradient(135deg, #ffe5b4, #fff8f0);
    display: flex;
    min-height: 100vh;
    margin: 0;
  }
  form {
    margin: 25px;
    background-color: #ffffffd9;
    padding: 40px 30px;
    border-radius: 15px;
    box-shadow: 0 8px 20px rgba(0,0,0,0.15);
    max-width: 450px;
    width: 100%;
  }
  h2 {
    text-align: center;
    margin-bottom: 25px;
    font-family: 'Pacifico', cursive;
    font-size: 28px;
    color: #e67e22;
    text-shadow: 1px 1px 2px rgba(0,0,0,0.2);
  }
  div {
    margin-bottom: 18px;
  }
  label {
    display: block;
    margin-bottom: 6px;
    font-weight: 600;
    color: #555;
  }
  input[type="text"],
  input[type="number"],
  textarea,
  select {
    width: 100%;
    padding: 10px 14px;
    border: 2px solid #f39c12;
    border-radius: 8px;
    font-size: 14px;
    transition: border-color 0.3s, box-shadow 0.3s;
    box-sizing: border-box;
  }
  input[type="text"]:focus,
  input[type="number"]:focus,
  textarea:focus,
  select:focus {
    border-color: #e67e22;
    box-shadow: 0 0 8px rgba(230, 126, 34, 0.3);
    outline: none;
  }
  textarea {
    resize: vertical;
  }
  button.btn {
    width: 100%;
    padding: 14px;
    background: linear-gradient(135deg, #f39c12, #e67e22);
    color: #fff;
    border: none;
    border-radius: 10px;
    font-size: 16px;
    font-weight: 700;
    cursor: pointer;
    box-shadow: 0 4px 8px rgba(0,0,0,0.2);
    transition: background 0.3s, transform 0.2s;
  }
  button.btn:hover {
    background: linear-gradient(135deg, #e67e22, #f39c12);
    transform: translateY(-2px);
  }
  input::placeholder,
  textarea::placeholder {
    color: #d35400;
    opacity: 0.8;
  }
  .container {
    padding: 60px;
    font-family: cursive;
    font-size: 20px;
  }

</style>

</head>
<body>

<div class="container">
    <h3>Description About Plan . . </h3>
    <p>Please fill out the appropriate information and choose the doctor to put a plan for you and
     follow up with you and then pay the cost to receive the plan within 48 hours.</p>
    <p>- The duration of the plan is a month.</p>
    <p>Please adhere to the instructions to obtain the best results and evaluation.</p>
    <p>- You can submit your suggestions when receiving the food plan.</p>
    <img style="width: 500px" class="mt-4" src="{{ asset('assets/image11.png') }}" >
</div>

<form method="POST" action="{{ route('storePlanOrder') }}">
  @csrf

  <h2>Order a Plan</h2>

  <!-- Doctor Selection Dropdown -->
  <div>
    <label for="doctor">Select a Doctor you want to supervise the plan</label>
    <select id="doctor" name="doctor_id" required>
        <option value="">-- Select a Doctor --</option>
        @foreach ($doctors as $doctor)
          <option value="{{ $doctor->id }}">{{ $doctor->name }}</option>
        @endforeach
    </select>
  </div>

  <div>
    <label for="goals">Goals :what is the purpose of your request for a plan?</label>
    <select id="goals" name="goals" required>
      <option value="">-- Select Your Goal --</option>
      <option value="gain_weight">Gain Weight</option>
      <option value="lose_weight">Lose Weight</option>
      <option value="maintain_health">Maintain a Healthy Routine</option>
    </select>
  </div>

  <!-- Additional User & Health Info -->
  <div>
    <label for="desirable_foods">Desirable Foods: those you do not love or wish to avoid</label>
    <input type="text" id="desirable_foods" name="desirable_foods" placeholder="e.g., fruits, vegetables" required />
  </div>

  <div>
    <label for="height">Height (cm): How tall are you?</label>
    <input type="number" id="height" name="height" min="30" max="300" step="0.1" required placeholder="Your height in cm" />
  </div>

  <div>
    <label for="weight">Weight (kg): How much do you weigh?</label>
    <input type="number" id="weight" name="weight" min="5" max="500" step="0.1" required placeholder="Your weight in kg" />
  </div>

  <div>
    <label for="financial_state">Financial State</label>
    <select id="financial_state" name="financial_state" required>
      <option value="">Select your financial state</option>
      <option value="finanically comfortable">Financially Comfortable</option>
      <option value="medium">Medium</option>
      <option value="poor">Poor</option>
    </select>
  </div>

  <div>
    <label for="health_state">Health State: Do you suffer from diseases or take any medications?</label>
    <textarea id="health_state" name="health_state" rows="3" placeholder="Describe your health condition..." required></textarea>
  </div>

  <div>
    <label for="answers">Expected results of the plan and any suggestions?</label>
    <textarea id="answers" name="answers" rows="4" placeholder="Your answer" required></textarea>
  </div>



  <button type="submit" class="btn">Create Order</button>
</form>

</body>
</html>
