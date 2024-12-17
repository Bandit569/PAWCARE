<?php
require_once __DIR__ . '/../../app/controllers/ServiceRequestController.php';

$controller = new ServiceRequestController();
$controller->submitRequest();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Submit Pet Care Request</title>
</head>
<body>
<h1>Submit Pet Care Request</h1>
<form method="POST" action="">
    <label for="userID">User ID:</label>
    <input type="number" name="userID" required><br>

    <label for="requestType">Request Type:</label>
    <input type="text" name="requestType" required><br>

    <label for="serviceTypeID">Service Type ID:</label>
    <input type="number" name="serviceTypeID" required><br>

    <label for="date">Date:</label>
    <input type="date" name="date" required><br>

    <label for="time">Time:</label>
    <input type="time" name="time" required><br>

    <label for="addressID">Address ID:</label>
    <input type="number" name="addressID" required><br>

    <button type="submit">Submit Request</button>
</form>
</body>
</html>

