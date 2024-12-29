<!DOCTYPE html>
<html lang="en">
<head>
    <title>Pet Care Connect - Find trusted sitters</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="/PAWCARE/public/css/stylesheet.css">
    <link rel="stylesheet" href="/PAWCARE/public/css/loginStyle.css">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
    <meta name="author" content="Group G2D">
    <meta name="description" content="Connect with reliable pet sitters and caretakers.">

</head>


<body>
<!-- Navigation -->
<?php require_once (dirname(__DIR__).'\Views\components\navbar.php'); ?>

        <div class="login-container">
            <form class="login-form">
            <h1>Login to PawCare</h1>

            <form action="/login" method="POST">
                <label for="userid">User ID</label>
                <input type="userid" name="userid" id="userid" required>

                <label for="password">Password</label>
                <input type="password" name="password" id="password" required>

                <button class="Reqbutton" type="submit">Login</button>

                <p><br>Don't have an account? <a href="/Register" class="cta-button">Register here</a></br></p>
            </form>
        </div>

<?php require_once (dirname(__DIR__).'\Views\components\footer.php'); ?>

</body>
</html>


