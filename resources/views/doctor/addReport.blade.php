@extends('layouts.app')

@section('content')
<style>
    /* Your styles here... (unchanged) */
</style>
<div class="container mt-4">
 <!-- Styled and Decorated Create/Edit Report Section -->

  <h4 class="text-center mb-3" >
    {{ isset($report) ? 'Update Report' : 'Add New Report' }}
  </h4>

  <form action="{{ isset($report) ? route('updateReport',[$report->id,$report->patient_id]) : route('storeReport') }}"  method="POST" enctype="multipart/form-data" style="position: relative;">
  @csrf

  <!-- Title -->
  <div class="form-group mb-3">Title :
   <input
    name="title"
    type="text"
    class="form-control"
    placeholder="Title"
    required
    value="{{ isset($report) ? $report->title : '' }}"
    style="border: 2px solid #ffa500; border-radius: 0.25rem; padding: 10px; font-weight: 600; transition: border-color 0.2s, box-shadow 0.2s;"
    onfocus="this.style.borderColor='#ff7f00'; this.style.boxShadow='0 0 8px rgba(255, 127, 80, 0.4)'"
    onblur="this.style.borderColor='#ffa500'; this.style.boxShadow='none'"
   >
  </div>

  <!-- Description -->
  <div class="form-group mb-3">Description :
   <input
    name="description"
    type="text"
    class="form-control"
    placeholder="Description about report"
    required
    value="{{ isset($report) ? $report->description : '' }}"
    style="border: 2px solid #ffa500; border-radius: 0.25rem; padding: 10px; font-weight: 600; transition: border-color 0.2s, box-shadow 0.2s;"
    onfocus="this.style.borderColor='#ff7f00'; this.style.boxShadow='0 0 8px rgba(255, 127, 80, 0.4)'"
    onblur="this.style.borderColor='#ffa500'; this.style.boxShadow='none'"
   >
  </div>

  <div class="form-group mb-3">Recommended :
    <input
     name="recommended"
     type="text"
     class="form-control"
     placeholder="Recommended (optional)"
     value="{{ isset($report) ? $report->recommended : '' }}"
     style="border: 2px solid #ffa500; border-radius: 0.25rem; padding: 10px; transition: border-color 0.2s, box-shadow 0.2s;"
     onfocus="this.style.borderColor='#ff7f00'; this.style.boxShadow='0 0 8px rgba(255, 127, 80, 0.4)'"
     onblur="this.style.borderColor='#ffa500'; this.style.boxShadow='none'"
    >
  </div>

  <div class="form-group mb-3">Date :
    <input
     name="date"
     type="date"
     class="form-control"
     placeholder="Date"
     value="{{ isset($report) ? $report->date : '' }}"
     style="border: 2px solid #ffa500; border-radius: 0.25rem; padding: 10px; transition: border-color 0.2s, box-shadow 0.2s;"
     onfocus="this.style.borderColor='#ff7f00'; this.style.boxShadow='0 0 8px rgba(255, 127, 80, 0.4)'"
     onblur="this.style.borderColor='#ffa500'; this.style.boxShadow='none'"
    >
  </div>
  @if(!isset($report))
  <!-- Patient Selection -->
  <div class="form-group mb-3">
    <label for="patient_id">Patient</label>
    <select name="patient_id" class="form-select" id="patient_id">
      <option value="">Select patient</option>

      {{-- Fetch plan orders for the current doctor --}}
      @php
        $planOrders = \App\Models\PlanOrder::where('doctor_id', auth()->user()->id)->get();
      @endphp

      @foreach($planOrders as $planOrder)
        @if($planOrder->plan)
          @php
            // Get the patient associated with this plan order
            $patient = \App\Models\User::find($planOrder->patient_id);
          @endphp
          @if($patient)
            <option value="{{ $patient->id }}">{{ $patient->name }}</option>
          @endif
        @endif
      @endforeach

    </select>
  </div>
@endif

  <!-- Submit Button -->
  <button
   type="submit"
   class="btn btn-lg btn-block"
   style="background: linear-gradient(135deg, #ff8c00, #ffa500); color: white; border: none; border-radius: 0.5rem; font-weight: bold; padding: 12px 20px; font-size: 1.2rem; cursor: pointer; transition: background 0.3s, transform 0.2s;"
   onmouseover="this.style.background='linear-gradient(135deg, #ff7f00, #ffa500)'; this.style.transform='translateY(-2px)'"
   onmouseout="this.style.background='linear-gradient(135deg, #ff8c00, #ffa500)'; this.style.transform='translateY(0)'"
  >
   {{ isset($report) ? 'Update Report' : 'Save Report' }}
  </button>
  </form>
</div>
@endsection
