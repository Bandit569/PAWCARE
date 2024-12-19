<!DOCTYPE html>
<html lang="en">
<head>
    <title>Pet Care Connect - Find trusted sitters</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--    <link rel="stylesheet" href="/PAWCARE/public/css/stylesheet.css">-->
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
            <h1>Login to PawCare</h1>
            <form action="/Login" method="POST">
                <label for="username">Username</label>
                <input type="username" name="username" id="username" required>

                <label for="password">Password</label>
                <input type="password" name="password" id="password" required>

                <button type="submit">Login</button>
            </form>

            <p>Don't have an account? <a href="/Register" class="cta-button">Register here</a></p>



        <!--    <p>Your trusted partner in finding pet caretakers.</p>
            <a href="/services" class="cta-button">Explore Services</a>-->
        </div>
<!--        <div class="lemon-cake-image">

            <img src="/PAWCARE/public/Images/LemonCakesMyLove.webp" alt="Lemon Cake">
        </div>-->
    </section>

<!--    <section class="I need a herooo">

    </section>-->
</main>


<?php require_once (dirname(__DIR__).'\Views\components\footer.php'); ?>

</body>
</html>

