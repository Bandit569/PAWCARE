<nav>
    <button class="menu-toggle">
        <span class="material-symbols-outlined">menu</span>
    </button>
    <div class="logo">
        <a href="/">
            <img style="height:56px; width:auto;" src="/PAWCARE/public/images/Logo.png" alt="Logo">
        </a>
    </div>
    <ul class="nav-links">
        <li><a href="/">Home</a></li>
        <li><a href="/services">Services</a></li>
        <li class="dropdown">
            <a href="#" class="dropbtn">Find a Caretaker</a>
            <ul class="dropdown-content">
                <li><a class = "drop-down-a" href="/requests">Post a Request</a></li>
                <li><a href="/caretakers">Search for a Caretaker</a></li>
            </ul>
        </li>
        <li class="dropdown">

            <a href="#" class="dropbtn">Become a Caretaker</a>
            <ul class="dropdown-content">
                <li><a href="/offers">Post an Offer</a></li>
                <li><a href="/pet-owners">Look for Pet Owners in Need</a></li>
            </ul>
        </li>
        <li><a href="/contact">Contact</a></li>
    </ul>
    <button class="sidebar-toggle" id="sidebar-toggle">
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