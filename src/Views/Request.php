<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Pet Care Connect - Find Trusted Sitters</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="/PAWCARE/public/css/stylesheet.css">
    <link rel="stylesheet" href="/PAWCARE/public/css/submitRequestStyle.css">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
</head>
<body>

<?php require_once(dirname(__DIR__) . '\Views\components\navbar.php'); ?>

<main>
    <section class="hero">
        <div class="container">
            <div class="cat-image">
                <img src="/PAWCARE/public/Images/GPTMyLove.webp" alt="Cat">
            </div>
            <div class="form-container">
                <h1>Service Request Form</h1>

                <?php if (isset($data['errorMessage'])): ?>
                    <p style="color:red;"><?php echo htmlspecialchars($data['errorMessage']); ?></p>
                <?php endif; ?>

                <form action="/PAWCARE/submitRequest" method="POST">
                    <!-- User ID -->
                    <div class="form-group">
                        <label for="userID">User ID:</label>
                        <input type="number" id="userID" name="userID" value="<?= $data['userID'] ?>" readonly required disabled><br><br>
                    </div>

                    <!-- Pet ID Dropdown -->
                    <div class="form-group">
                        <label for="petId">Pet ID:</label>
                        <select id="petId" name="petId" required>
                            <option value="0" disabled selected>Select a pet</option>
                            <?php foreach ($data['pets'] as $pet): ?>
                                <option value="<?= $pet['pet_id'] ?>"><?= htmlspecialchars($pet['pet_name']) ?></option>
                            <?php endforeach; ?>
                        </select><br><br>
                    </div>

                    <!-- Service Type Dropdown -->
                    <div class="form-group">
                        <label for="serviceTypeID">Service Type:</label>
                        <select id="serviceTypeID" name="serviceTypeID" required>
                            <option value="" disabled selected>Select a service</option>
                            <?php foreach ($data['serviceTypes'] as $service): ?>
                                <option value="<?= $service['service_type_id'] ?>"><?= htmlspecialchars($service['service_type_name']) ?></option>
                            <?php endforeach; ?>
                        </select><br><br>
                    </div>

                    <!-- Request Type Dropdown -->
                    <div class="form-group">
                        <label for="requestType">Request Type:</label>
                        <select id="requestType" name="requestType" required>
                            <option value="1" selected>Service Request</option>
                            <option value="2" disabled>Service Offer</option>
                        </select><br><br>
                    </div>

                    <!-- Address ID -->
                    <div class="form-group">
                        <label for="addressID">Address:</label>
                        <select id="addressID" name="addressID" required>
                            <option value="" disabled selected>Select an address</option>
                            <?php foreach ($data['addresses'] as $address): ?>
                                <option value="<?= $address['address_id'] ?>"><?= htmlspecialchars($address['address_flat_no']) ?></option>
                            <?php endforeach; ?>
                        </select><br><br>
                    </div>

                    <!-- Date and Time -->
                    <div class="form-group">
                        <label for="date">Date:</label>
                        <input type="date" id="date" name="date" required><br><br>
                        <label for="time">Time:</label>
                        <input type="time" id="time" name="time" required><br><br>
                    </div>

                    <div class="form-group">
                        <!-- Hidden Default Request Status -->
                        <input type="hidden" name="requestStatus" value="New">

                        <!-- Acceptor ID -->
                        <input type="hidden" id="acceptorID" name="acceptorID" value="null">
                    </div>

                    <!-- Submit Button -->
                    <button class="Reqbutton" type="submit">Submit Service Request</button>
                </form>
        </div>
        </div>
    </section>
</main>

<?php require_once(dirname(__DIR__) . '\Views\components\footer.php'); ?>
</body>
</html>