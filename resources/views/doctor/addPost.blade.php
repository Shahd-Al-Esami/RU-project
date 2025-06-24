@extends('layouts.app')

@section('content')
<style>
    /* Overall page styling */
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background-color: #fff8f0; /* Light warm background */
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
</style>
<body>
<div class="container mt-4">
 <!-- Styled and Decorated Create/Edit Post Section -->

  <h4 class="text-center mb-3" >
    {{ isset($post) ? 'Update Post' : 'Add New Post' }}
  </h4>

  <form  action="{{ isset($post) ? route('post.update',$post->id) : route('storePost') }}" method="POST" enctype="multipart/form-data" style="position: relative;">
  @csrf

  <!-- Title -->
  <div class="form-group mb-3">
   <input
    name="title"
    type="text"
    class="form-control"
    placeholder="Title"
    required
    value="{{ isset($post) ? $post->title : '' }}" {{-- عرض عنوان المنشور إذا كان موجودًا --}}
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
   <input
    name="description"
    type="text"
    class="form-control"
    placeholder="What's on your mind Doctor?"
    required
    value="{{ isset($post) ? $post->description : '' }}" {{-- عرض وصف المنشور إذا كان موجودًا --}}
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
   <input
    name="link_source"
    type="text"
    class="form-control"
    placeholder="Source Link (optional)"
    value="{{ isset($post) ? $post->link_source : '' }}" {{-- عرض رابط المصدر إذا كان موجودًا --}}
    style="
    border: 2px solid #ffa500;
    border-radius: 0.25rem;
    padding: 10px;
    transition: border-color 0.2s, box-shadow 0.2s;"
    onfocus="this.style.borderColor='#ff7f00'; this.style.boxShadow='0 0 8px rgba(255, 127, 80, 0.4)'"
    onblur="this.style.borderColor='#ffa500'; this.style.boxShadow='none'"
   >
  </div>

  <!-- Image Upload -->
  <div class="form-group mb-4">
    @if(isset($post) && $post->image)
    <img src="{{ asset('storage/' . $post->image) }}" alt="Current Image" style="max-width: 200px; display: block; margin-bottom: 10px;">
  @endif
   <input
    class="form-control-file"
    name="image"
    type="file"
    style="
    border: 2px dashed #ffa500;
    padding: 8px;
    border-radius: 4px;
    transition: border-color 0.2s;"
    onfocus="this.style.borderColor='#ff7f00'"
    onblur="this.style.borderColor='#ffa500'"
   >
  </div>
  {{-- <div class="row mb-3">
    <label for="image" class="col-md-4 col-form-label text-md-end">{{ __('Image') }}</label>

    <div class="col-md-6">
        <input id="image" type="file" class="form-control @error('image') is-invalid @enderror" name="image" value="{{ old('image') }}"  autocomplete="image">
        @error('image')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div> --}}

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
   {{ isset($post) ? 'Update Post' : 'Save Post' }} {{-- تغيير نص الزر --}}
  </button>
  </form>
 </div>
@endsection
</body>
