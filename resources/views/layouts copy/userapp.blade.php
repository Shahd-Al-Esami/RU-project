<!DOCTYPE html>
<head>
    <link rel="stylesheet" href="{{url("css/style11.css")}}" />
    <title>
        HealthBite
    </title>
</head>
<body>
    <div style="background: url(../assets/img/curved-images/Backround.jpg); backface-visibility: hidden;
        background-size: cover;
        background-position-x: center;
        height: 100vh;
        width: 100%;
        position: fixed;
        filter: brightness(0.5);
        background-repeat: no-repeat;
        z-index: -1;">
    </div>
    <div class="mx-3">
    @yield('doctor')
    </div>
    <script>
        // https://freecodez.com
//sidebar
const menuItems = document.querySelectorAll(".menu-item");
const messagesNotification = document.querySelector("#messages-notifications");
const messages = document.querySelector(".messages");
const message = messages.querySelectorAll(".message");
const messageSearch = document.querySelector("#message-search");

//remove active class from all menu items
const changeActiveItem = () => {
    menuItems.forEach((item) => {
        item.classList.remove("active");
    });
};

menuItems.forEach((item) => {
    item.addEventListener("click", () => {
        // Check if the clicked item is already active
        const isActive = item.classList.contains("active");

        // Remove "active" class from all items if the clicked item is not active
        if (!isActive) {
            menuItems.forEach((menuItem) => {
                menuItem.classList.remove("active");
            });
            item.classList.add("active");
        } else {
            // If the item is already active, remove the active class
            item.classList.remove("active");
        }

        // Handle notifications popup

        // Call the function to change the active item (if needed)
        changeActiveItem();
    });
});

const searchMessage = () => {
    const val = messageSearch.value.toLowerCase();
    message.forEach((chat) => {
        let name = chat.querySelector("h5").textContent.toLowerCase();
        if (name.indexOf(val) != -1) {
            chat.style.display = "flex";
        } else {
            chat.style.display = "none";
        }
    });
};

messageSearch.addEventListener("keyup", searchMessage);

messagesNotification.addEventListener("click", () => {
    messages.style.boxShadow = "0 0 1rem var(--color-primary)";
    messagesNotification.querySelector(".notification-count").style.display =
        "none";
    setTimeout(() => {
        messages.style.boxShadow = "none";
    }, 2000);
});
    </script>
</body>
</html>

