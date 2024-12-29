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
            <form class="login-form" action="/PAWCARE/login" method="POST">
            <h1>Login to PawCare</h1>

                <label for="userid">User ID</label>
                <input type="userid" name="userid" id="userid" required>

                <label for="password">Password</label>
                <input type="password" name="password" id="password" required>

                <button class="Reqbutton" type="submit">Login</button>
            </form>
        </div>
<div class="login-container">
        <div class="form-group">
<p>
                Don't have an account?
            <a href="/PAWCARE/Register" class="Reqbutton">Register Here</a>
</p>
        </div>
</div>

<?php require_once (dirname(__DIR__).'\Views\components\footer.php'); ?>

</body>
</html>


