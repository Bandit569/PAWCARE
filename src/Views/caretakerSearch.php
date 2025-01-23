<?php
/**
 * @var ServiceTypeEntity [] $ServiceTypes The list of Service types fetched from service_type table.
 *
 * @var \Entities\ServiceRequestEntity [] $listings The list of all service requests from
 *
 * @var ServiceTypeEntity [] $services The list of proposed services
 */

use Entities\ServiceTypeEntity;
use Entities\PetEntity;




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
    <?php

    if(isset( $message)){
        echo'    <div class="message" style = "padding: 10px; justify-content: center">
        <p>'.$message.'</p>
    </div>';
    }

    ?>

    <div>
        <section class="search-filters">
            <h2>Search Filters</h2>
            <form id="search-form" method="GET" action="petOwnerSearch">
                <div class="form-group">
                    <label for="town">Town:</label>
                    <input type="text" id="town" name="town" placeholder="Enter town" maxlength="50" aria-label="Town">
                </div>
                <div class="form-group">
                    <label for="country">Country:</label>
                    <input type="text" id="country" name="country" placeholder="Enter country" maxlength="50" aria-label="Country">
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


            <div class="caregiver-grid">
                <script>
                    const listingsData = <?php
                        echo json_encode(array_map(function ($listing) {
                            return [
                                    'id' => $listing -> getId(),
                                'img' => 'placeholder.jpg',
                                'name' => $listing->getUser()->getFirstName() . ' ' . $listing->getUser()->getLastName(),
                                'reviewAvrg' => $listing->getUser()->getPetOwnerReviewAverage() ?? 0,
                                'country' => $listing->getAddress()->getCountry() ?? 'Unknown',
                                'city' => $listing->getAddress()->getTown() ?? 'Unknown',
                                'street' => $listing->getAddress()->getStreet() ?? 'Unknown',
                                'lastRev' => $listing->getUser()->getLastReview()?->getComment() ?? 'No reviews available',
                                'petName' => $listing->getPetName() ?? 'Unknown',
                                'petBreed' => $listing->getPetBreed() ?? 'Unknown',
                                'petSpecies' => $listing->getPetSpecies() ?? 'Unknown',
                                'petAge' => $listing->getPetAge() ?? 'Unknown',
                                'petMedication' => $listing->getPetMedication() ?? 'Unknown',
                                'petInfo' => $listing->getPetInfo() ?? 'Unknown'
                            ];
                        }, $listings), JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_AMP | JSON_HEX_QUOT | JSON_UNESCAPED_UNICODE);
                        ?>;
                </script>
                <script src="/PAWCARE/public/js/petOwnerSearch.js"></script>
                <script>
                    f15(listingsData);
                </script>
            </div>
        </section>
    </div>

</main>

</body>
</html>
