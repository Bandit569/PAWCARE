<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Service Requests</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&family=Material+Symbols+Outlined" rel="stylesheet">
    <title>Pet Care Connect - Find trusted sitters</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="/petcare/src/public/css/stylesheet.css">
    <link rel="stylesheet" href="/petcare/src/public/css/registerStyle.css">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
    <meta name="author" content="Group G2D">
    <meta name="description" content="Connect with reliable pet sitters and caretakers.">
</head>


<body>
    <?php require_once(dirname(__DIR__) . '\Views\components\navbar.php'); ?>

    <div style="margin: 0 auto; width: 80%;">

        <h2>Manage Requests</h2>

        <!-- Search bar -->
        <div class="search-bar">
            <form method="GET" action="/PAWCARE/ManageRequest">
                <input type="text" name="search" placeholder="Search by Request Type or Status..." value="<?php echo htmlspecialchars($_GET['search'] ?? ""); ?>">
                <button type="submit">Search</button>
            </form>
        </div>
    </div>

    <table style="margin: 0 auto; border-collapse: collapse; border: 2px solid #FF8C00; width: 80%;">
        <tr style="border: 2px solid #FF8C00; background-color: #FFDAB9; color: #000; text-align: left;">
            <th style="border: 2px solid #FF8C00; padding: 8px;">Service Request ID</th>
            <th style="border: 2px solid #FF8C00; padding: 8px;">Date</th>
            <th style="border: 2px solid #FF8C00; padding: 8px;">Request Status</th>
            <th style="border: 2px solid #FF8C00; padding: 8px;">Service Type Name</th>
            <?php
            if (!($role == 1 || $role == 2)) {
                echo '<th style="border: 2px solid #FF8C00; padding: 8px;">Actions</th>';
            }
            ?>
        </tr>
        <?php
        // Function to get the service type name based on service_type_id
        function getServiceTypeName($service_type_id)
        {
            switch ($service_type_id) {
                case 11:
                    return "Grooming";
                case 12:
                    return "Check-Up";
                case 13:
                    return "Training";
                case 14:
                    return "Daycare";
                case 15:
                    return "Pet Boarding";
                default:
                    return "Unknown";
            }
        }

        if ($requests) {
            foreach ($requests as $row) {
                echo "<tr style='border: 2px solid #FF8C00;'>";
                echo "<td style='border: 2px solid #FF8C00; padding: 8px;'>" . htmlspecialchars($row['service_request_id']) . "</td>";
                echo "<td style='border: 2px solid #FF8C00; padding: 8px;'>" . htmlspecialchars($row['date']) . "</td>";
                echo "<td style='border: 2px solid #FF8C00; padding: 8px;'>" . htmlspecialchars($row['request_status']) . "</td>";

                // Map service_type_id to service type name
                $serviceTypeName = getServiceTypeName($row['service_type_id']);
                echo "<td style='border: 2px solid #FF8C00; padding: 8px;'>" . htmlspecialchars($serviceTypeName) . "</td>";

                if (!($role == 1 || $role == 2)) {
                    if ($role == 4 && $userId == $row['user_id']) {
                        echo "<td style='border: 2px solid #FF8C00; padding: 8px;'>
                        my pet 
                        </td>";
                    } else {
                        echo "<td style='border: 2px solid #FF8C00; padding: 8px;'>
                        <form method='POST' style='display:inline;'>
                                <input type='hidden' name='service_request_id' value='" . $row['service_request_id'] . "'>
                                <button type='submit' name='action' value='Accepted' class='approve-btn' style='background-color: #32CD32; color: #FFF; border: none; padding: 5px 10px; margin-right: 4px; cursor: pointer;'>Accept</button>
                            </form>
                            <form method='POST' style='display:inline;'>
                                <input type='hidden' name='service_request_id' value='" . $row['service_request_id'] . "'>
                                <button type='submit' name='action' value='Pending' class='pending-btn' style='background-color: #FFD700; color: #000; border: none; padding: 5px 10px; margin-right: 4px; cursor: pointer;'>Pending</button>
                            </form>
                            <form method='POST' style='display:inline;'>
                                <input type='hidden' name='service_request_id' value='" . $row['service_request_id'] . "'>
                                <button type='submit' name='action' value='Cancelled' class='cancel-btn' style='background-color: #FF6347; color: #FFF; border: none; padding: 5px 10px; cursor: pointer;'>Cancel</button>
                            </form>
                        </td>";
                    }
                }

                echo "</tr>";
            }
        }
        ?>
    </table>
    <?php require_once(dirname(__DIR__) . '\Views\components\footer.php'); ?>
</body>

</html>