<?php
/**
 * @var ServiceTypeEntity [] $ServiceTypes The list of Service types fetched from service_type table.
 *
 * @var \Entities\ServiceRequestEntity [] $listings The list of all service requests from
 *
 * @var ServiceTypeEntity [] $services The list of proposed services
 */

use Entities\ServiceTypeEntity;

?>
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

    <?php
    // Sample PHP array with listing data
    ?>
    <script>
        function f() {
            // Use the listings data passed from PHP
            const listingsData = <?php echo json_encode(array_map(function ($listing) {
                return [
                    'img' => 'placeholder.jpg', // Replace this with the appropriate image logic if available
                    'alt' => $listing->getServiceType(),
                    'name' => $listing->getUser()->getFirstName() . ' ' . $listing->getUser()->getLastName(),
                    'description' => $listing->getDescription(),
                    'price' => $listing->getPrice(),
                    'review' => 'Placeholder review' // Replace this with actual review data if available
                ];
            }, $listings)); ?>;

            const listingsContainer = document.querySelector('.list');

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
        }

    </script>
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
                    <?php
                    if (!empty($services)) {
                        foreach ($services as $service) {
                            echo '<option>' . htmlspecialchars($service->getName()) . '</option>';
                        }
                    } else {
                        echo '<option>No services available</option>';
                    }

                    ?>
                </select>
            </label>

            <div class="search-container">
                <label for="search-bar">
                    <i class="material-icons">
                        <h2>search</h2>
                    </i>
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


            <label for="rangeInput"><h2>Price (EUR)</h2></label>
            <input type="range" id="rangeInput" min="0" max="100" value="50">
            <span id="rangeValue">50</span> <!-- Display the current value -->

            <script>
                const rangeInput = document.getElementById('rangeInput');
                const rangeValue = document.getElementById('rangeValue');

                // Update the value displayed when the range input changes
                rangeInput.addEventListener('input', () => {
                    rangeValue.textContent = rangeInput.value;
                });
            </script>
        </aside>
    </div>
        <!-- Main Listings -->
        <div class="listings">
            <div class = "list">
                <script>
                    f();
                </script>
                <!-- Map Section There is no map, don't ask why it's a map section, I made it, and I decided it would be called map section-->
            </div>

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
        </div>
</main>
</body>
</html>