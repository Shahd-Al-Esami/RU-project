<nav>
    <div class="container">
        <h2 class="logo" >HealthBite</h2>
        <div class="search-bar">
            <i class="uil uil-search"></i>
            <input
            type="text"
            placeholder="Search for creators, inspirations and projects"
          />
        </div>
        <div class="create">
            <a href="{{ url('/logout')}}" class="btn btn-primary" for="create-post"> Log Out </a>
            <div class="profile-pic">
                <img src={{($user->image)? $user->image : url('default.jpg') }} alt="pic 1" />
            </div>
        </div>
    </div>
</nav>
