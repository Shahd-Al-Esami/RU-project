@if($user->role == "doctor")
<div class="left">
    <a class="profile">
        <div class="profile-pic">
            <img src={{($user->image)? $user->image : url('default.jpg') }} />
        </div>
        <div class="handle">
            <h4>{{$user->name}}</h4>
            <p class="text-muted"> {{$user->role}}</p>
        </div>
    </a>
    <div class="sidebar">
        <a href="/" class="menu-item active">
            <span><i class="uil uil-home"></i></span>
            <h3>Home</h3>
        </a>
        <a href="/myBills" class="menu-item">
            <span><i class="uil uil-compass"></i></span>
            <h3>Bills</h3>
        </a>

        <a href={{url('patient')}} class="menu-item">
            <h3>My Patients</h3>
        </a>
        <a href={{url('appointment')}} class="menu-item">
            <h3>My Appointments</h3>
        </a>
        <a href={{url('reports')}} class="menu-item">
            <h3>My Reports</h3>
        </a>
        <a class="menu-item">
            <span><i class="uil uil-setting"></i></span>
            <h3>Settings</h3>
        </a>


    </div>
</div>
@else
<div class="left">
    <a class="profile">
        <div class="profile-pic">
            <img src={{($user->image)? $user->image : url('default.jpg') }} />
        </div>
        <div class="handle">
            <h4>{{$user->name}}</h4>
            <p class="text-muted"> {{$user->role}}</p>
        </div>
    </a>
    <div class="sidebar">
        <a href="/" class="menu-item active">
            <span><i class="uil uil-home"></i></span>
            <h3>Home</h3>
        </a>
        <a href="/doctors" class="menu-item">
            <span><i class="uil uil-compass"></i></span>
            <h3>Doctors</h3>
        </a>
        <a href={{url('appointment')}} class="menu-item">
            <h3>My Appointments</h3>
        </a>

    </div>
</div>

@endif
