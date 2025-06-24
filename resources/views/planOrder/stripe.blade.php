<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<style>

    body{
    background: linear-gradient(135deg, #ffe5b4, #fff8f0);

    }
      #payment-container {
    max-width: 500px;
    width: 100%;
    padding: 20px;
    background-color: #ffffffcc;
    border-radius: 15px;
    box-shadow: 0 8px 20px rgba(0,0,0,0.15);
  }
  #pay-button {
    width: 100%;
    padding: 12px;
    background-color: #4CAF50;
    color: white;
    border: none;
    border-radius: 8px;
    font-size: 16px;
    font-weight: 700;
    cursor: pointer;
    margin-top: 20px;
  }
  #pay-button:hover {
    background-color: #45a049;
  }
  #payment-message {
    margin-top: 15px;
    font-weight: bold;
    text-align: center;
  }
  #error-message {
    margin-top: 15px;
    color: red;
    text-align: center;
    display: none;
  }
  #card-element {
    padding: 15px;
    border: 1px solid #ccc;
    border-radius: 8px;
    background-color: #f8d9c1;
    box-shadow: inset 0 1px 3px rgba(0,0,0,0.1);
  }
</style>
<body>
    <a href="{{ url('home') }}" class="btn btn-secondary mt-3 mx-2">Go Back</a>

    {{-- {{ dd($planOrder) }} --}}
    <div>
        <!-- النموذج منسق بشكل أنيق -->
        <form id="payment-form" style="
        max-width: 400px;
        margin: 50px auto;
        padding: 20px;
        border-radius: 10px;
        background-color: #f9f9f9;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        font-family: 'Arial', sans-serif;">
        @csrf
        <h2 style="text-align: center; color: #333;">your order has been registered.. Are You Ready For Paying?</h2>

        <div id="card-element" style="
          padding: 15px;
          border: 1px solid #ccc;
          border-radius: 8px;
          background-color: #f8d9c1;
          box-shadow: inset 0 1px 3px rgba(0,0,0,0.1);
          margin-top: 20px;">
        </div>

        <!-- رسالة خطأ تظهر هنا -->
        <div id="error-message" style="color: red; margin-top: 15px; display: none; font-size: 14px;background-color:#d35400"></div>

        <div id="payment-message" style="margin-top: 15px; font-weight: bold;"></div>




        @if($theplanOrder)
        <div>The Price is : {{ $theplanOrder->price }} $</div>

    @else
        <div>PlanOrder not found</div>
    @endif

        <button class="" id="submit" type="submit" style="

          padding: 12px;
          margin-top: 20px;
          background-color: #4CAF50;
          color: white;
          border: none;
          border-radius: 8px;
          font-size: 16px;
          cursor: pointer;
          transition: background-color 0.3s ease;">
         Pay Now
        </button>
        </form>
       <div>{{  $theplanOrder->isPaid=1 }}</div>


    </div>


<!-- تضمين Stripe.js -->
<script src="https://js.stripe.com/v3/"></script>
<script>
// تهيئة Stripe باستخدام المفتاح الخاص بك
var stripe = Stripe('pk_test_51RaGuT4U8tFRdWda3InpovObRUJ3ooJRvhPkQZoCUqM5cNYN2aLStYL3yqJuODUNFINohoIRdKca2wticfJi7HH7003bwkDcd8');
var elements = stripe.elements();

// إنشاء عنصر بطاقة وتخصيصه
var style = {
  base: {
    color: '#333',
    fontSize: '16px',
    fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
    padding: '10px',
    '::placeholder': {
      color: '#a0a0a0',
    },
  },
  invalid: {
    color: 'red',
  },
};

var card = elements.create('card', { style: style });
card.mount('#card-element');

// معالجة إرسال النموذج
var form = document.getElementById('payment-form');
var errorMessage = document.getElementById('error-message');

form.addEventListener('submit', function(event) {
  event.preventDefault();

  // مسح رسالة الخطأ القديمة
  errorMessage.style.display = 'none';
  errorMessage.textContent = '';
// استدعاء Stripe لإنشاء Token
stripe.createToken(card).then(function(result) {
    if (result.error) {
        // عرض رسالة فشل الدفع
        document.getElementById('payment-message').textContent = result.error.message;
        document.getElementById('payment-message').style.color = 'red'; // تحديد اللون للأحمر للفشل
    } else {
        // تحميل الرسالة عند النجاح
       document.getElementById('payment-message').textContent = 'Payed successfully';
        document.getElementById('payment-message').style.color = 'green';


      // إرسال الطلب إلى السيرفر لتحديث الحالة
      fetch('/update-payment-status', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': '{{ csrf_token() }}' // حسب إطار Laravel الخاص بك
        },
        body: JSON.stringify({
          stripeToken: result.token.id,
          order_id: '{{ $theplanOrder->id }}' // تمرير الـID الصحيح
        }),
      })
      .then(response => response.json())
      .then(data => {
        if (data.success) {
          alert('تم تحديث  الطلب الى تم الدفع');
          // يمكن هنا إعادة تحميل الصفحة أو أي إجراء آخر
        } else {
          alert('فشل التحديث: ' + data.message);
        }
      })
      .catch(error => console.error('خطأ:', error));



        // إضافة الـToken وإرسال النموذج
        var hiddenInput = document.createElement('input');
        hiddenInput.setAttribute('type', 'hidden');
        hiddenInput.setAttribute('name', 'stripeToken');
        hiddenInput.setAttribute('value', result.token.id);
        form.appendChild(hiddenInput);

        form.submit();



    }





  });

});


</script>
{{-- <script src="https://js.stripe.com/v3/"></script>
<script>
    const stripe = Stripe('pk_test_51RaGuT4U8tFRdWda3InpovObRUJ3ooJRvhPkQZoCUqM5cNYN2aLStYL3yqJuODUNFINohoIRdKca2wticfJi7HH7003bwkDcd8');
    const elements = stripe.elements();

    // Define styles for the card element
    const style = {
        base: {
            color: '#333',
            fontSize: '16px',
            fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
            padding: '10px',
            '::placeholder': {
                color: '#a0a0a0',
            },
        },
        invalid: {
            color: 'red',
        },
    };

    // Create the card element
    const card = elements.create('card', { style: style });
    card.mount('#card-element');

    // Handle form submission
    const form = document.getElementById('payment-form');
    const paymentMessage = document.getElementById('payment-message');

    form.addEventListener('submit', function(event) {
        event.preventDefault();

        // Clear previous messages
        paymentMessage.textContent = '';

        // Create the token with Stripe
        stripe.createToken(card).then(function(result) {
            if (result.error) {
                // Show error message if there's a failure
                paymentMessage.textContent = result.error.message;
                paymentMessage.style.color = 'red';
            } else {
                // Send the token to the server
                fetch('/update-payment-status', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        stripeToken: result.token.id,
                        order_id: '{{ $theplanOrder->id }}' // Pass the correct ID
                    }),
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        paymentMessage.textContent = 'Payment successful! Your order has been updated.';
                        paymentMessage.style.color = 'green';
                        // Optionally redirect or reload the page
                        // window.location.reload();
                    } else {
                        paymentMessage.textContent = 'Payment failed: ' + data.message;
                        paymentMessage.style.color = 'red';
                    }
                })
                .catch(error => {
                    paymentMessage.textContent = 'Request failed: ' + error.message;
                    paymentMessage.style.color = 'red';
                });
            }
        });
    });
</script> --}}


</body>

</html>
