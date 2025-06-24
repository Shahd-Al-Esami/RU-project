@extends('layouts.app')

@section('content')
<style>
    /* Overall page styling */
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background: linear-gradient(135deg, #fff7f0, #ffe4b5);
        color: #333;
    }

    /* Container styling */
    .container {
        max-width: 900px;
        margin: auto;
        padding: 30px;
        background-color: #fff;
        border-radius: 15px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        border: 1px solid #f0ad4e; /* Light orange border */
    }

    /* Headings styling */
    h1, h2,h4 {
        color: #ff7f50; /* Bright orange for headings */
        margin-bottom: 20px;
        text-align: center;
    }

    /* List styling for appointments */
    .appointments-list ul {
        padding: 0;
        list-style: none;
    }

    .list-group-item {
        padding: 15px 20px;
        margin-bottom: 10px;
        background-color: #fff3e0; /* Light orange background */
        border-left: 6px solid #ff7f50; /* Orange accent border */
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        transition: all 0.3s ease;
    }

    .list-group-item:hover {
        background-color: #ffe0b2; /* Slightly darker hover color */
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    }

    /* Form section styling */
    .new-appointment {
        margin-top: 40px;
        padding: 25px;
        background-color: #fff0e0; /* Soft orange background */
        border-radius: 15px;
        border: 1px solid #f0ad4e;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }

    .new-appointment h2 {
        margin-bottom: 20px;
        color: #ff7f50;
    }

    /* Labels and inputs */
    label {
        font-weight: bold;
        display: block;
        margin-bottom: 8px;
        color: #d35400; /* Darker orange for labels */
    }

    .form-select, .form-control {
        border-radius: 8px;
        border: 1px solid #f0ad4e;
        box-shadow: inset 0 1px 3px rgba(0,0,0,0.1);
        transition: border-color 0.3s;
    }

    .form-select:focus, .form-control:focus {
        border-color: #ff7f50;
        outline: none;
        box-shadow: 0 0 8px rgba(255,127,80,0.3);
    }

    /* Button styling */
    .btn-primary {
        background-color: #ff7f50;
        border-color: #ff7f50;
        transition: background-color 0.3s, box-shadow 0.3s;
    }

    .btn-primary:hover {
        background-color: #ff6f3f;
        box-shadow: 0 4px 8px rgba(0,0,0,0.2);
    }

    /* Responsive design for small screens */
    @media (max-width: 768px) {
        .container {
            padding: 20px;
        }
        .list-group-item {
            padding: 12px 16px;
        }
    }

    .follow-btn {
        background-color: #ffcc80; /* Bootstrap danger color */
        border: none;
        padding: 10px 20px;
        color: #222121;
        font-size: 1rem;
        border-radius: 25px;
        cursor: pointer;
        transition: background-color 0.3s, transform 0.2s;
    }

    .follow-btn:hover {
        background-color: #df9f51;
        transform: scale(1.05);
    }
</style>
<body>
<a href="{{ url('showPlan',$plan->plan_order_id) }}" class="btn btn-secondary go-back-btn">Go Back</a>

<div class="container mt-4">

 <!-- Styled and Decorated Create/Edit plan Section -->

  <h4 class="text-center mb-3" >
    {{ isset($plan) ? 'Update plan' : 'Add New plan' }}
  </h4>

  <form action="{{ isset($plan) ? route('updatePlan', [$plan->plan_order_id, $plan->id]) : route('storePlan', $plan_order_id) }}" method="POST" enctype="multipart/form-data" style="position: relative;">
      @csrf

  <!-- Title -->
  <div class="form-group mb-3">
    <label for="title">Title</label>

   <input
    name="title"
    type="text"
    class="form-control"
    placeholder="Title"
    required
    value="{{ isset($plan) ? $plan->title : '' }}" {{-- عرض عنوان المنشور إذا كان موجودًا --}}
    style="
    border: 2px solid #ffa500;
    border-radius: 0.25rem;
    padding: 10px;
    font-weight: 600;
    transition: border-color 0.2s, box-shadow 0.2s;"
    onfocus="this.style.borderColor='#ff7f00'; this.style.boxShadow='0 0 8px rgba(255, 127, 80, 0.4)'"
    onblur="this.style.borderColor='#ffa500'; this.style.boxShadow='none'"
   >
  </div>

  <!-- Description -->
  <div class="form-group mb-3">
    <label for="start_date">start Date</label>

   <input
    name="start_date"
    type="date"
    class="form-control"
    placeholder="start date"
    required
    value="{{ isset($plan) ? $plan->start_date : '' }}" {{-- عرض وصف المنشور إذا كان موجودًا --}}
    style="
    border: 2px solid #ffa500;
    border-radius: 0.25rem;
    padding: 10px;
    font-weight: 600;
    transition: border-color 0.2s, box-shadow 0.2s;"
    onfocus="this.style.borderColor='#ff7f00'; this.style.boxShadow='0 0 8px rgba(255, 127, 80, 0.4)'"
    onblur="this.style.borderColor='#ffa500'; this.style.boxShadow='none'"
   >
  </div>

  <!-- Source Link -->
  <div class="form-group mb-3">
    <label for="end_date">End Date</label>

   <input
    name="end_date"
    type="date"
    class="form-control"
    placeholder="end date"
    value="{{ isset($plan) ? $plan->end_date : '' }}" {{-- عرض رابط المصدر إذا كان موجودًا --}}
    style="
    border: 2px solid #ffa500;
    border-radius: 0.25rem;
    padding: 10px;
    transition: border-color 0.2s, box-shadow 0.2s;"
    onfocus="this.style.borderColor='#ff7f00'; this.style.boxShadow='0 0 8px rgba(255, 127, 80, 0.4)'"
    onblur="this.style.borderColor='#ffa500'; this.style.boxShadow='none'"
   >
  </div>
  <div class="form-group mb-3">
    <label for="state">State (optional)</label>
    <select name="state" class="form-select" id="state">
        <option value="" {{ isset($plan) && $plan->state == '' ? 'selected' : '' }}>Select State</option>
        <option value="initial" {{ isset($plan) && $plan->state == 'initial' ? 'selected' : '' }}>Initial</option>
        <option value="modified" {{ isset($plan) && $plan->state == 'modified' ? 'selected' : '' }}>Modified</option>
    </select>
</div>






  <!-- Submit Button -->
  <button
   type="submit"
   class="btn btn-lg btn-block"
   style="
    background: linear-gradient(135deg, #ff8c00, #ffa500);
    color: white;
    border: none;
    border-radius: 0.5rem;
    font-weight: bold;
    padding: 12px 20px;
    font-size: 1.2rem;
    cursor: pointer;
    transition: background 0.3s, transform 0.2s;"
   onmouseover="this.style.background='linear-gradient(135deg, #ff7f00, #ffa500)'; this.style.transform='translateY(-2px)'"
   onmouseout="this.style.background='linear-gradient(135deg, #ff8c00, #ffa500)'; this.style.transform='translateY(0)'"
  >
   {{ isset($plan) ? 'Update plan' : 'Save plan' }} {{-- تغيير نص الزر --}}
  </button>
  </form>
 </div>
@endsection

@if(session('message'))
<script>
    alert('{{ session('message') }}');
</script>
@endif


</body>
