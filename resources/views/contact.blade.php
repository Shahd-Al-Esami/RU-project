<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

<title>Contact Us</title>
<style>
  body {
    font-family: 'Arial', sans-serif;
    background: linear-gradient(135deg, #fff7f0, #ffe4b5);
    margin: 0;
    padding: 0;
    color: #333;
  }
  .container {
    max-width: 1200px;
    margin: 50px auto;
    display: flex;
    flex-wrap: wrap;
    background: #fff;
    box-shadow: 0 8px 16px rgba(0,0,0,0.2);
    border-radius: 10px;
    overflow: hidden;
  }
  .contact-info, .contact-form {
    flex: 1;
    padding: 40px;
  }
  .contact-info {
    background: #ffe0b2; /* Light orange background */
  }
  h2 {
    margin-top: 0;
    color: #FF7F50; /* Coral/Orange Accent */
  }
  .info-item {
    margin-bottom: 20px;
    font-size: 1.1em;
  }
  .info-item span {
    font-weight: bold;
  }
  /* Style links in contact info */
  .info-item a {
    color: #FF7F50;
    text-decoration: none;
  }
  .info-item a:hover {
    text-decoration: underline;
  }
  form {
    display: flex;
    flex-direction: column;
  }
  input, textarea {
    margin-bottom: 20px;
    padding: 15px;
    border: 1px solid #ccc;
    border-radius: 8px;
    font-size: 1em;
    transition: border-color 0.3s;
  }
  input:focus, textarea:focus {
    border-color: #FF7F50; /* Match accent color */
    outline: none;
  }
  button {
    padding: 15px;
    border: none;
    border-radius: 8px;
    background-color: #FF7F50; /* Coral/Orange button */
    color: #fff;
    font-size: 1.2em;
    cursor: pointer;
    transition: background-color 0.3s;
  }
  button:hover {
    background-color: #e6733b; /* Darker shade for hover */
  }
  /* Responsive */
  @media(max-width: 768px){
    .container {
      flex-direction: column;
    }
  }
</style>
</head>
<body>
    <a href="{{ url()->previous() }}" class="btn btn-secondary mt-3 mx-3">Go Back</a>

<div class="container">
  <div class="contact-info">
    <h2>Contact Us</h2>
    <div class="info-item"><strong>Address:</strong> 123 Main Street, City, Country</div>
    <div class="info-item"><strong>Phone:</strong> +1 234 567 890</div>
    <div class="info-item"><strong>Email:</strong> info@example.com</div>
    <div class="info-item"><strong>Follow us:</strong>
      <a href="#">Facebook</a> | <a href="#">Twitter</a> | <a href="#">Instagram</a>
    </div>
  </div>
  <div class="contact-form">
    <h2>Send a Message</h2>
    <form>
      <input type="text" placeholder="Your Name" required />
      <input type="email" placeholder="Your Email" required />
      <textarea rows="5" placeholder="Your Message" required></textarea>
      <button type="submit">Send Message</button>
    </form>
  </div>
</div>
</body>
</html>
