<?php
/**
 * @var $listings Entities\ServiceRequestEntity []
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Service Requests</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }
        .card {
            border: 1px solid #ddd;
            border-radius: 8px;
            margin-bottom: 15px;
            padding: 15px;
            background-color: #f9f9f9;
        }
        .card-header {
            font-size: 1.2em;
            margin-bottom: 8px;
        }
        .card-content {
            display: flex;
            flex-direction: column;
        }
        .card-content div {
            margin-bottom: 8px;
        }
        .btn-group {
            display: flex;
            gap: 8px;
        }
        .btn {
            padding: 8px 12px;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            text-align: center;
        }
        .btn-edit {
            background-color: #007bff;
        }
        .btn-delete {
            background-color: #dc3545;
        }
    </style>
</head>
<body>



<div class="container" id="card-container">
    <h1>Service Requests</h1>

    <script>
        function f() {
            const container = document.getElementById("card-container");
            const listingsData = <?php echo json_encode(array_map(function ($listing) {
                return [
                    'acceptor_name' => $listing->getAcceptor()->getFirstName() . " " . $listing->getAcceptor()->getLastName(),
                    'pets' => $listing->getPetsNames(),
                    'status' => $listing->getStatus(),
                    'id' => $listing->getId(),
                    'date' => $listing->getDate(),
                    'address' => $listing->getAddress(),
                ];
            }, $listings), JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP); ?>;
            listingsData.forEach(listing => {
                const card = document.createElement("div");
                card.classList.add("card")
                const cardContent = document.createElement("div");
                card.classList.add("card-content");
                const address = document.createElement("div");
                address.innerHTML = '<strong>' + listing.address + '</strong>';
                const date = document.createElement("div");
                date.innerHTML = '<strong>' + listing.date + '</strong>';
                const status = document.createElement("div");
                status.innerHTML = '<strong>' + listing.status + '</strong>';
                const petNames = document.createElement("div");
                petNames.innerHTML = '<strong>' + listing.pets + '</strong>';
                const acceptorName = document.createElement("div");
                acceptorName.innerHTML = '<strong>' + listing.acceptor_name + '</strong>';

            })
        }


    </script>

    <!-- Example Service Request Card -->
    <div class="card">
        <div class="card-header">Request ID: #12345</div>
        <div class="card-content">
            <div><strong>Address:</strong> 123 Main Street, Anytown</div>
            <div><strong>Date:</strong> January 5, 2025</div>
            <div><strong>Status:</strong> Pending</div>
            <div><strong>Pet Names:</strong> Max, Bella</div>
            <div><strong>Accepted By:</strong> John Doe</div>
            <div><strong>Time:</strong> 2:30 PM</div>
        </div>
        <div class="btn-group">
            <a href="edit_request.html?id=12345" class="btn btn-edit">Edit</a>
            <a href="delete_request.php?id=12345" class="btn btn-delete">Delete</a>
        </div>
    </div>

    <!-- Repeat similar blocks for each service request -->

</div>

</body>
</html>


