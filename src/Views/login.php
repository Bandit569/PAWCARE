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

<!-- Main Content -->
<main>
    <section class="hero">
        <div class="cat-image">
            <img src="/PAWCARE/public/Images/GPTMyLove.webp" alt="Cat">
        </div>
        <div class="hero-text">
            <h1>Welcome to Pawcare!</h1>

            <form class="form-container" action="/PAWCARE/login" method="POST">

                        <label class="form-group" for="userid">User ID</label>
                        <input class="form-group" type="text" name="userid" required>
                <label class="form-group" for="password">Password</label>
                <input class="form-group" type="password" name="password" required>

                <button class="Reqbutton" type="submit">Login</button>

            </form>

        </div>
        <div class="lemon-cake-image">
            <img src="/PAWCARE/public/Images/LemonCakesMyLove.webp" alt="Lemon Cake">
        </div>
    </section>
</main>

<?php require_once (dirname(__DIR__).'\Views\components\footer.php'); ?>

</body>
</html>


