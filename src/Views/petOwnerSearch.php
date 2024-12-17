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
        <div class="container scrollable">
            <!-- Sidebar Filters -->
            <aside class="filters">
                <h2>Service</h2>
                <label>
                    <select>
                        <option>Home Visits</option>
                        <option>Pet Boarding</option>
                        <option>Day Care</option>
                    </select>
                </label>

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
            <main class="listings scrollable">
                <?php
                // Sample PHP array with listing data
                $listings = [
                    [
                        'img' => 'avatar1.jpg',
                        'alt' => 'Gaelle',
                        'name' => 'Gaelle',
                        'description' => 'Pet Sitting Premium / Welcome',
                        'price' => '€15/day',
                        'review' => 'Gaelle is wonderful. She took great care of our two cats...'
                    ],
                    [
                        'img' => 'avatar2.jpg',
                        'alt' => 'Milana',
                        'name' => 'Milana',
                        'description' => 'Your Pet’s New Playmate',
                        'price' => '€15/day',
                        'review' => 'Trustworthy, loving & fun!'
                    ]
                    // Add more listings as needed
                ];
                ?>

                <script>
                    const listingsData = <?php echo json_encode($listings); ?>;
                    const listingsContainer = document.querySelector('.listings');

                    listingsData.forEach(listing => {
                        const listingDiv = document.createElement('div');
                        listingDiv.classList.add('listing');

                        listingDiv.innerHTML = `
            <div class="info">
                <img src="${listing.img}" alt="${listing.alt}">
                <div>
                    <h3>${listing.name}</h3>
                    <p>${listing.description}</p>
                    <p>From <strong>${listing.price}</strong></p>
                </div>
            </div>
            <p>${listing.review}</p>
        `;

                        listingsContainer.appendChild(listingDiv);
                    });
                </script>


            </main>

            <!-- Map Section There is no map, don't ask why it's a map section, I made it, and I decided it would be called map section-->
            <aside id="map" class="scrollable">
                <!-- Default image -->
                <img src="/PAWCARE/public/Images/clc.webp"
                     alt="Lemon Cakes My Love"
                     class="map-image"
                     style="width: 100%; height: 100%; object-fit: cover; /* Scales the image to cover the container */">

                <!-- Listing details -->
                <div class="listing-details hidden">
                    <!-- Header Section -->
                    <div class="header-section">
                        <img id="detailsImg" src="" alt="Caretaker Image" class="caretaker-image" />
                        <div class="header-info">
                            <h2 id="detailsName">Caretaker Name</h2>
                            <p id="detailsReviewAverage">Review Average: ★★★★☆</p>
                        </div>
                    </div>

                    <!-- About Section -->
                    <section class="about-section">
                        <h3>About</h3>
                        <p id="detailsAbout">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec odio.</p>
                    </section>

                    <!-- Offers Section -->
                    <section class="offers-section">
                        <h3>Offers & Services</h3>
                        <div class="services">
                            <h4>Services</h4>
                            <ul id="servicesList">
                                <!-- List of services will go here -->
                            </ul>
                        </div>
                        <div class="animals-handled">
                            <h4>Animals Handled</h4>
                            <ul id="animalsList">
                                <!-- List of animals the caretaker handles will go here -->
                            </ul>
                        </div>
                    </section>

                    <!-- Availability Section -->
                    <section class="availability-section">
                        <h3>Availability</h3>
                        <div class="calendar-container">
                            <div class="calendar-header">
                                <button id="prevMonth">&lt;</button>
                                <h2 id="monthYear">Month Year</h2>
                                <button id="nextMonth">&gt;</button>
                            </div>
                            <div class="calendar-legend">
                                <span class="available">Available</span>
                                <span class="not-available">Not available</span>
                            </div>
                            <div class="calendar-days">
                                <div class="days-row">
                                    <div>Mon</div>
                                    <div>Tue</div>
                                    <div>Wed</div>
                                    <div>Thu</div>
                                    <div>Fri</div>
                                    <div>Sat</div>
                                    <div>Sun</div>
                                </div>
                                <div id="calendarGrid" class="days-grid"></div>
                            </div>
                        </div>
                    </section>

                    <!-- Booking Section -->
                    <section class="booking-section">
                        <h3>Book a Service</h3>
                        <form>
                            <label for="serviceChoice">Choose a service:</label>
                            <select id="serviceChoice">
                                <!-- Options will be populated dynamically -->
                            </select>

                            <p>Price: <span id="detailsPrice">€0</span></p>

                            <label for="chosenDate">Choose a date:</label>
                            <input type="date" id="chosenDate">

                            <button type="button" onclick="contactCaretaker()">Contact Caretaker</button>
                        </form>
                    </section>

                    <!-- Reviews Section -->
                    <section class="reviews-section">
                        <h3>Reviews</h3>
                        <ul id="reviewsList">
                            <!-- List of reviews will go here -->
                        </ul>
                    </section>
                </div>


                <script src="/PAWCARE/public/js/petOwnerSearch.js"></script>
            </aside>

        </div>
    </main>
</body>
</html>