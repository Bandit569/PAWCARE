<?php
// Start session (if not already started)
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Check if user is logged in by verifying 'user_id' in session
$isLoggedIn = isset($_SESSION['user']['id']) && !empty($_SESSION['user']['id']);
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
            <a href="#" class="dropbtn">Pet Owners</a>
            <ul class="dropdown-content">
                <li><a class="drop-down-a" href="/PAWCARE/LoadRequest">Post a Request</a></li>
                <li><a class="drop-down-a" href="/PAWCARE/petOwnerSearch">Search for a Caretaker</a></li>
            </ul>
        </li>
        <li class="dropdown">
            <a href="#" class="dropbtn">Caretakers</a>
            <ul class="dropdown-content">
                <li><a href="/PAWCARE/LoadOffer">Post an Offer</a></li>
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
            <span class="username">
                <?php echo htmlspecialchars($_SESSION['user']['first_name'] ?? 'User'); ?>
            </span>
        </button>
    <?php endif; ?>
</nav>

<!-- Sidebar for Logged-in User -->
<?php if ($isLoggedIn): ?>
    <div class="sidebar" id="sidebar">
        <div class="profile">
            <img src="https://via.placeholder.com/80" alt="Profile Picture">
            <!-- Display the logged-in user’s name -->
            <h3><?php echo htmlspecialchars($_SESSION['user']['first_name'] ?? 'User'); ?></h3>

            <!-- Optional: Display user role -->
<!--            <p>--><?php //echo htmlspecialchars($_SESSION['user']['role'] ?? ''); ?><!--</p>-->
        </div>
        <!-- Sidebar Links -->
        <a href="/PAWCARE/profile-settings">Profile Settings</a>
        <a href="/PAWCARE/manage-requests">Manage Requests</a>
        <a href="/PAWCARE/logout">Logout</a>
    </div>
<?php endif; ?>

<script>
    // Sidebar toggle functionality
    const sidebar = document.getElementById('sidebar');
    const profileButton = document.getElementById('sidebar-toggle');

    // Only bind the event listener if elements exist
    if (profileButton && sidebar) {
        profileButton.addEventListener('click', () => {
            sidebar.classList.toggle('open'); // Toggle sidebar visibility
        });
    }
</script>
