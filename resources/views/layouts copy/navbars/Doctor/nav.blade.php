<link rel="stylesheet" href="css/style.css" />
    <!-- Unicons CSS -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css" />
<nav class="nav">
    <i class="uil uil-bars navOpenBtn"></i>
    <a href="#" class="logo">CodingLab</a>
    <ul class="nav-links">
      <i class="uil uil-times navCloseBtn"></i>
      <li><a href="#">Home</a></li>
      <li><a href="#">supscriper</a></li>
      <li><a href="#">plans</a></li>
      <li><a href="#">Bills</a></li>
      <li><a href="#">Plan Requests</a></li>
    </ul>
    <i class="uil uil-search search-icon" id="searchIcon"></i>
    <div class="search-box">
      <i class="uil uil-search search-icon"></i>
      <input type="text" placeholder="Search here..." />
    </div>
    <a href="{{ url('/logout')}}" class="nav-link text-body font-weight-bold px-0">
        <i class="fa fa-user me-sm-1"></i>
        <span class="d-sm-inline d-none">Sign Out</span>
    </a>
  </nav>

  <script>
    const nav = document.querySelector(".nav"),
  searchIcon = document.querySelector("#searchIcon"),
  navOpenBtn = document.querySelector(".navOpenBtn"),
  navCloseBtn = document.querySelector(".navCloseBtn");
searchIcon.addEventListener("click", () => {
  nav.classList.toggle("openSearch");
  nav.classList.remove("openNav");
  if (nav.classList.contains("openSearch")) {
    return searchIcon.classList.replace("uil-search", "uil-times");
  }
  searchIcon.classList.replace("uil-times", "uil-search");
});
navOpenBtn.addEventListener("click", () => {
  nav.classList.add("openNav");
  nav.classList.remove("openSearch");
  searchIcon.classList.replace("uil-times", "uil-search");
});
navCloseBtn.addEventListener("click", () => {
  nav.classList.remove("openNav");
});
  </script>
