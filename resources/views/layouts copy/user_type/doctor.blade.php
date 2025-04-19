@extends('layouts.userapp')

@section('doctor')

@include('layouts.navbars.user.nav')

<main class="main">
    <div class="container">
            @include('layouts.navbars.user.sidebar')
            @yield('content')
    </div>
</main>

@endsection
