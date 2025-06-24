<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

<title>Healthy Diet & Food Advice</title>
<style>
  body {
    font-family: 'Arial', sans-serif;
    margin: 0;
    background: linear-gradient(135deg, #fff7f0, #ffe4b5);
    color: #333;
  }

  header {
    background: linear-gradient(135deg, #c9881f, #f39c12); /* Orange gradient */
    padding: 40px 20px;
    text-align: center;
    color: white;
  }

  header h1 {
    font-size: 3em;
    margin: 0;
  }

  section {
    padding: 60px 20px;
    max-width: 1200px;
    margin: 0 auto;
  }

  section h2 {
    text-align: center;
    margin-bottom: 40px;
    font-size: 2em;
    color: #333;
  }

  /* Decorative line for sections in gray */
  .decor {
    width: 100%;
    height: 8px;
    background: linear-gradient(90deg, #d3d3d3, #a9a9a9); /* Gray gradient */
    margin-bottom: 40px;
    border-radius: 4px;
  }

  /* Image and content layout for services */
  .service-item {
    display: flex;
    align-items: center;
    margin-bottom: 40px;
    gap: 20px;
    flex-wrap: wrap;
  }

  .service-item img {
    width: 300px;
    height: auto;
    border-radius: 10px;
    box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    flex-shrink: 0;
  }

  .service-text {
    flex: 1;
  }

  /* Cards for tips and advice with orange borders and accents */
  .tips {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
    justify-content: center;
  }

  .card {
    background-color: white;
    border-radius: 10px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    width: 300px;
    padding: 20px;
    border-top: 4px solid #f39c12; /* Orange top border */
    transition: transform 0.2s, box-shadow 0.2s;
  }

  .card:hover {
    transform: translateY(-10px);
    box-shadow: 0 10px 20px rgba(0,0,0,0.2);
  }

  .card h3 {
    margin-top: 0;
    color: #cf8b1dc3; /* Orange color */
  }
</style>
</head>
<body>
    <a href="{{ url()->previous() }}" class="btn btn-secondary go-back-btn">Go Back</a>

<header class="mt-3">
  <h1>Healthy Diet & Food Advice</h1>
</header>

<section>
  <div class="decor"></div>
  <h2>Create Your Personalized Diet Plan</h2>
  <div class="service-item">
    <img src="{{ asset('assets/image1.png') }}" alt="{{ __('healthy food') }}">
    <div class="service-text">
      <h3>Make a Balanced Diet Plan</h3>
      <p>Start by including a variety of fruits, vegetables, whole grains, lean proteins, and healthy fats. Adjust portion sizes to match your activity level and health goals. Consult with nutrition experts for personalized advice.</p>
    </div>
  </div>
</section>
<section>
    <div class="decor"></div>
    <h2>Healthy Food Tips & Advice</h2>
    <div class="tips">
      <!-- Advice cards -->
      <div class="card">
        <h3>Eat Colorful Fruits & Veggies</h3>
        <img src="{{ asset('assets/image3.png') }}"  alt="Colorful fruits and vegetables" style="width:100%; height:auto; border-radius:8px;">
        <p>Choose a variety of colors to get a mix of essential nutrients and antioxidants for overall health.</p>
      </div>
      <div class="card">
        <h3>Limit Processed Foods</h3>
        <img src="{{ asset('assets/image5.png') }}" alt="Avoid processed foods" style="width:100%; height:auto; border-radius:8px;">
        <p>Avoid foods high in refined sugars, unhealthy fats, and artificial additives for a healthier lifestyle.</p>
      </div>
      <div class="card">
        <h3>Stay Hydrated</h3>
        <img src="{{ asset('assets/image6.png') }}" alt="Glass of water and healthy drinks" style="width:100%; height:auto; border-radius:8px;">
        <p>Drink plenty of water throughout the day. Limit sugary drinks and excessive caffeine.</p>
      </div>
      <div class="card">
        <h3>Practice Portion Control</h3>
        <img src="{{ asset('assets/image2.png') }}" alt="Portion control with balanced plates" style="width:100%; height:auto; border-radius:8px;">
        <p>Eat moderate portions to avoid overeating. Pay attention to hunger cues and avoid late-night snacks.</p>
      </div>
      <div class="card">
        <h3>Plan Your Meals</h3>

        <img src="{{ asset('assets/image4.png') }}" alt="meals"   style="width:100%; height:auto; border-radius:8px;"/>
        <p>Preparing meals ahead of time helps you avoid unhealthy choices and ensures a balanced diet every day.</p>
      </div>
    </div>
  </section>

</body>
</html>
