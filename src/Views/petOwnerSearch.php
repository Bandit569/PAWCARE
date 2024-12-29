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

</head>
<body>

<!-- Navigation -->
<?php require_once (dirname(__DIR__).'\Views\components\navbar.php'); ?>
<main>
    <div>
        <section class="search-filters">
            <h2>Search Filters</h2>
            <form id="search-form">
                <div class="form-group">
                    <label for="town">Town:</label>
                    <input type="text" id="town" name="town" placeholder="Enter town">
                </div>
                <div class="form-group">
                    <label for="country">Country:</label>
                    <input type="text" id="country" name="country" placeholder="Enter country">
                </div>
                <div class="form-group">
                    <label for="rating">Minimum Rating:</label>
                    <select id="rating" name="rating">
                        <option value="">Select rating</option>
                        <option value="5">5 Stars</option>
                        <option value="4">4 Stars</option>
                        <option value="3">3 Stars</option>
                        <option value="2">2 Stars</option>
                        <option value="1">1 Star</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for = "order">Display order</label>
                    <select id="order" name="order">
                        <option value="1">Rating desc</option>
                        <option value="2">Rating asc</option>
                        <option value="3">Name asc</option>
                        <option value="4">Name desc</option>
                    </select>
                </div>
                <button type="submit" class="btn-search">Search</button>
            </form>
        </section>
        <section class="results">
            <h2>Caregivers Near You</h2>
            <script>
                function f(){
                    const listingsData = <?php echo json_encode(array_map(function ($listing) {
                        return [
                            'img' => 'placeholder.jpg', // Replace this with the appropriate image logic if available
                            'alt' => $listing->getServiceType(),
                            'name' => $listing->getUser()->getFirstName() . ' ' . $listing->getUser()->getLastName(),
                            'review' => 'Placeholder review' // Replace this with actual review data if available
                        ];
                    }, $listings)); ?>;

                }
            </script>
            <div class="caregiver-grid">
                <!-- Sample caregiver card -->
                <script>
                    function f(){
                        const listingsData = <?php echo json_encode(array_map(function ($listing) {
                            return [
                                    'img' => 'placeholder.jpg',
                                'name' => $listing->getUser()->getFirstName() . ' ' . $listing->getUser()->getLastName(),
                                'reviewAvrg' => $listing -> getUser()->getReviewAverage(),
                                'country' => $listing -> getAddress()->getCountry(),
                                'city' => $listing -> getAddress()->getTown(),
                                'street' => $listing -> getAddress()->getStreet(),
                                'LastRev' => $listing ->getUser() -> getLastReview()
                            ];
                    },$listings)); ?>;

                        const listingsContainer = document.querySelector(".listingsContainer")
                        listingsData.foreach(listing => {
                            //Container for 1 listing
                            const listingDiv = document.createElement("div")
                            listingDiv.classList.add('caregiver-card')

                            const userImg = .createElement("img")
                        })
                    }
                </script>
                <div class = "listingsContainer">

                </div>
                <div class="caregiver-card">
                    <img src="placeholder.jpg" alt="Caregiver Photo" class="caregiver-photo">
                    <div class="caregiver-info">
                        <h3>John Doe</h3>
                        <p>Location: London, UK</p>
                        <p>Rating: ★★★★☆</p>
                        <p>Specializes in: Dogs, Cats</p>
                    </div>
                </div>
                <!-- Additional cards will go here -->
            </div>
        </section>
    </div>
    <script src="/PAWCARE/public/js/petOwnerSearch.js"></script>
</main>
</body>
</html>