<nav>
    <button class="menu-toggle">
        <span class="material-symbols-outlined">menu</span>
    </button>
    <div class="logo">
        <a href="/PAWCARE/">
            <img style="height:56px; width:auto;" src="/PAWCARE/public/images/Logo.png" alt="Logo">
        </a>
    </div>
    <ul class="nav-links">
        <li><a href="/PAWCARE">Home</a></li>
        <li><a href="/services">Services</a></li>
        <li class="dropdown">
            <a href="#" class="dropbtn">Find a Caretaker</a>
            <ul class="dropdown-content">
                <li><a class = "drop-down-a" href="/PAWCARE/Request">Post a Request</a></li>
                <li><a class = "drop-down-a" href="/PAWCARE/petOwnerSearch">Search for a Caretaker</a></li>
            </ul>
        </li>
        <li class="dropdown">

            <a href="#" class="dropbtn">Become a Caretaker</a>
            <ul class="dropdown-content">
                <li><a href="/PAWCARE/Offers">Post an Offer</a></li>
                <li><a href="/pet-owners">Look for Pet Owners in Need</a></li>
            </ul>
        </li>
        <li><a href="/contact">Contact</a></li>
    </ul>
    <button id="login-btn" onclick="location.href='/PAWCARE/login'">Login</button>
    <button id="profile-btn" style="display: none;" class="sidebar-toggle" id="sidebar-toggle">
        <span class="material-symbols-outlined">account_circle</span>
    </button>

</nav>

<div class="sidebar" id="sidebar">
    <div class="profile">
        <img src="https://via.placeholder.com/80" alt="Profile Picture">
        <h3>John Doe</h3>
        <p>Pet Owner</p>
    </div>
    <a href="#">Profile Settings</a>
    <a href="#">Manage Requests</a>
    <a href="#">Logout</a>
</div>
<script>

    // Toggle Sidebar visibility
    const sidebar = document.getElementById('sidebar');
    const menuToggle = document.getElementById('sidebar-toggle');
    const content = document.getElementById('content');

    // Toggle the sidebar popup on click
    menuToggle.addEventListener('click', () => {
        sidebar.classList.toggle('open'); // Show/Hide the sidebar
    });
</script>

<script>

    const linkPreconnect1 = document.createElement('link');
    linkPreconnect1.rel = 'preconnect';
    linkPreconnect1.href = 'https://fonts.googleapis.com';
    document.head.appendChild(linkPreconnect1);

    const linkPreconnect2 = document.createElement('link');
    linkPreconnect2.rel = 'preconnect';
    linkPreconnect2.href = 'https://fonts.gstatic.com';
    linkPreconnect2.crossOrigin = 'anonymous'; // Add crossorigin attribute
    document.head.appendChild(linkPreconnect2);

    const linkFont = document.createElement('link');
    linkFont.rel = 'stylesheet';
    linkFont.href = 'https://fonts.googleapis.com/css2?family=Cherry+Bomb+One&display=swap';
    document.head.appendChild(linkFont);
</script>


<script>
// toggle display of Login/Register with Profile button
    var username = "<?php echo $_SESSION['user_id']?>";
    if(username) {
        const isLoggedIn = true; // Set to false to simulate not logged in
    }
    else {
        isLoggedIn = false;
    }

    // Get button elements
    const profileBtn = document.getElementById("profile-btn");
    const loginBtn = document.getElementById("login-btn");

    // Function to control button display
    function controlButtonDisplay() {
        if (isLoggedIn) {
            // User is logged in: Show Profile button, hide Login/Register button
            profileBtn.style.display = "block";
            loginBtn.style.display = "none";
        } else {
            // User is NOT logged in: Show Login/Register button, hide Profile button
            profileBtn.style.display = "none";
            loginBtn.style.display = "block";
        }
    }

    // Run the function on page load
    controlButtonDisplay();


</script>