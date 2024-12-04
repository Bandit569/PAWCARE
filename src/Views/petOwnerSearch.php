<!DOCTYPE html>
<html>
<head>
	<title>Look for a caretaker!</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="/PAWCARE/public/css/stylesheet.css">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
    <link rel="stylesheet" href="/PAWCARE/public/css/petOwnerStyle.css">
    <meta name="author" content="Group G2D">
    <meta name="description" content="Search for a caretaker">
</head>

<body>

<!-- Navigation -->
<?php require_once (dirname(__DIR__).'\Views\components\navbar.php'); ?>
	<main>
        <div class="container">
            <!-- Sidebar Filters -->
            <aside class="filters">
                <h2>Service</h2>
                <select>
                    <option>Home Visits</option>
                    <option>Pet Boarding</option>
                    <option>Day Care</option>
                </select>

                <div class="search-container">
                    <label for="search-bar">
                        <i class="material-icons">search</i>
                    </label>
                    <input type="text" id="search-bar" placeholder="Enter your town" readonly>
                </div>

                <!-- Popup Modal -->
                <div id="popup" class="popup">
                    <div class="popup-content">
                        <span class="close-btn">&times;</span>
                        <h2>Search for your town</h2>
                        <input type="text" id="popup-input" placeholder="Type to search...">
                        <div id="popup-results"></div>
                    </div>
                </div>
                <script src="/PAWCARE/public/js/main.js"></script>

                <h2>Dates</h2>
                <input type="date" />

                <h2>Price (EUR)</h2>
                <input type="range" min="4" max="180" />

                <h2>How many pets?</h2>
                <label>Small Dog (0-8kg)
                    <input type="number" min="0" value="0">
                </label>
                <label>Medium Dog (8-18kg)
                    <input type="number" min="0" value="0">
                </label>
                <label>Large Dog (18-45kg)
                    <input type="number" min="0" value="0">
                </label>
                <label>Giant Dog (+45kg)
                    <input type="number" min="0" value="0">
                </label>
            </aside>

            <!-- Main Listings -->
            <main class="listings">
                <div class="listing">
                    <div class="info">
                        <img src="avatar1.jpg" alt="Gaelle">
                        <div>
                            <h3>Gaelle</h3>
                            <p>Pet Sitting Premium / Welcome</p>
                            <p>From <strong>€15/day</strong></p>
                        </div>
                    </div>
                    <p>Gaelle is wonderful. She took great care of our two cats...</p>
                </div>

                <div class="listing">
                    <div class="info">
                        <img src="avatar2.jpg" alt="Milana">
                        <div>
                            <h3>Milana</h3>
                            <p>Your Pet’s New Playmate</p>
                            <p>From <strong>€15/day</strong></p>
                        </div>
                    </div>
                    <p>Trustworthy, loving & fun!</p>
                </div>
            </main>

            <!-- Map Section -->
            <aside class="map">
                <div id="map">
                    <img src="/PAWCARE/public/Images/clc.webp" alt = "Lemon Cakes My Love" style="width: 100%;
    height: 100%;
    object-fit: cover; /* Scales the image to cover the container */
    display: block;">
                </div>
            </aside>
        </div>
    </main>
</body>
</html>