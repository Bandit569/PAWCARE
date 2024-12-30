<!DOCTYPE html>
<html lang="en">
<head>
    <title>Pet Care Connect - Find trusted sitters</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="/PAWCARE/public/css/stylesheet.css">
    <link rel="stylesheet" href="/PAWCARE/public/css/submitRequestStyle.css">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
    <meta name="author" content="Group G2D">
    <meta name="description" content="Connect with reliable pet sitters and caretakers.">

</head>


<body>
<!-- Navigation -->
<?php require_once (dirname(__DIR__).'\Views\components\navbar.php'); ?>

<!-- Main Content -->
<main>


    <section class="hero">
        <div class="container">
            <div class="cat-image">
                <img src="/PAWCARE/public/Images/GPTMyLove.webp" alt="Cat">
            </div>
            <div class="form-container">
                <h1>Service Request Form</h1>
                <form action="submitOffer" method="POST">
                    <!-- User Details -->
                    <div class="form-group">
                        <label for="userID">User ID:</label>
                        <input type="number" id="userID" name="userID" required><br><br>
                    </div>

<!--                    <div class="form-group">-->
<!--                        <!-- Pet Details -->-->
<!--                        <label for="petID">Pet ID:</label>-->
<!--                        <input type="number" id="petID" name="petID" required disabled><br><br>-->
<!--                    </div>-->

                    <div class="form-group">
                        <!-- Service Type -->
                        <label for="serviceTypeID">Service Type:</label>
                        <select id="serviceTypeID" name="serviceTypeID" required>
                            <option value="1">Grooming</option>
                            <option value="2">Vet Visit</option>
                            <option value="3">Boarding</option>
                            <!-- Add more options dynamically from the database -->
                        </select><br><br>
                    </div>

                    <div class="form-group">
                        <!-- Service Request Type -->
                        <label for="requestType">Request Type:</label>
                        <input type="text" id="requestType" name="requestType" required disabled><br><br>
                    </div>

<!--                    <div class="form-group">-->
<!--                        <!-- Address -->-->
<!--                        <label for="addressID">Address ID:</label>-->
<!--                        <input type="number" id="addressID" name="addressID" required disabled><br><br>-->
<!--                    </div>-->

                    <div class="form-group">
                        <!-- Date and Time -->
                        <label for="date">Date:</label>
                        <input type="date" id="date" name="date" required><br><br>

                        <label for="time">Time:</label>
                        <input type="time" id="time" name="time" required><br><br>
                    </div>

                    <div class="form-group">
                        <!-- Request Status -->
                        <!-- <label for="requestStatus">Request Status:</label>
                         <select id="requestStatus" name="requestStatus" required disabled>
                             <option value="Pending">Pending</option>
                             <option value="Accepted">Accepted</option>
                             <option value="Completed">Completed</option>
                         </select><br><br>-->

                        <!-- Acceptor ID -->
<!--                        <label for="acceptorID">Acceptor ID:</label>-->
<!--                        <input type="number" id="acceptorID" name="acceptorID" disabled><br><br>-->
                    </div>
                    <!-- Submit Button -->
                    <button class="Reqbutton" type="submit" onclick="submitRequest">Submit Service Request</button>
                </form>
            </div>
            <!--<div class="lemon-cake-image">
               <img src="/PAWCARE/public/Images/LemonCakesMyLove.webp" alt="Lemon Cake"> -->
        </div>
        </div>
    </section>
</main>

<script src="/PAWCARE/public/js/main.js"></script>

<?php require_once (dirname(__DIR__).'\Views\components\footer.php'); ?>

</body>
</html>
