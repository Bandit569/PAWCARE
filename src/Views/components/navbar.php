<?php
// Start session (if not already started)
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Check if user is logged in by verifying `user_id` in session
$isLoggedIn = isset($_SESSION['user_id']) && !empty($_SESSION['user_id']);
?>

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

    <!-- Conditionally display Login or Profile buttons -->
    <?php if (!$isLoggedIn): ?>
        <!-- Show Login Button if NOT logged in -->
        <button id="login-btn" onclick="location.href='/PAWCARE/login'">Login</button>
    <?php else: ?>
        <!-- Show Profile Button if logged in -->
        <button id="sidebar-toggle" class="sidebar-toggle">
            <span class="material-symbols-outlined">account_circle</span>
        </button>
    <?php endif; ?>
</nav>
<?php if ($isLoggedIn): ?>
<div class="sidebar" id="sidebar">
    <div class="profile">
        <img src="https://via.placeholder.com/80" alt="Profile Picture">
        <h3><?php echo htmlspecialchars($_SESSION['user']['name'] ?? ''); ?></h3> <!-- User name -->
        <p><?php echo htmlspecialchars($_SESSION['user']['role'] ?? ''); ?></p> <!-- User role -->

    </div>
    <a href="#">Profile Settings</a>
    <a href="#">Manage Requests</a>
    <a href="/PAWCARE/logout">Logout</a>
</div>
<?php endif; ?>
<script>

    // Toggle Sidebar visibility
    // const sidebar = document.getElementById('sidebar');
    // const menuToggle = document.getElementById('sidebar-toggle');
    // const content = document.getElementById('content');
    //
    // // Toggle the sidebar popup on click
    // menuToggle.addEventListener('click', () => {
    //     sidebar.classList.toggle('open'); // Show/Hide the sidebar
    // });

    const sidebar = document.getElementById('sidebar');
    const profileButton = document.getElementById('sidebar-toggle'); // Correct ID now used

    // Only bind the event listener if elements exist
    if (profileButton && sidebar) {
        profileButton.addEventListener('click', () => {
            sidebar.classList.toggle('open'); // Show/Hide the sidebar
        });
    }
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

