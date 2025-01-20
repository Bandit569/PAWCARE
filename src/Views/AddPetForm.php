<!DOCTYPE html>
<html lang="en">
<head>
    <title>Pet Care Connect - Find trusted sitters</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="/PAWCARE/public/css/stylesheet.css">
    <link rel="stylesheet" href="/PAWCARE/public/css/registerStyle.css">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
    <meta name="author" content="Group G2D">
    <meta name="description" content="Connect with reliable pet sitters and caretakers.">
</head>
<body>
<!-- Navigation -->
<?php require_once (dirname(__DIR__).'\Views\components\navbar.php'); ?>
<div class="registration-body">
    <div class="registration-container">
        <form id="petRegisterForm" action="/PAWCARE/RegisterPet" method="POST">

    <h1>Add a Pet</h1>
    <label for="petName">Pet Name</label>
    <input type="text" id="petName" name="petName" required>

    <label for="petSpecies">Pet Species</label>
    <input type="text" id="petSpecies" name="petSpecies" required>

    <label for="petBreed">Pet Breed</label>
    <input type="text" id="petBreed" name="petBreed" required>

    <label for="petAge">Pet Age</label>
    <input type="number" id="petAge" name="petAge" min="0" required>

    <label for="petMedication">Pet Medication</label>
    <input type="text" id="petMedication" name="petMedication">

    <label for="petAdditionalInfo">Additional Information</label>
    <textarea id="petAdditionalInfo" name="petAdditionalInfo"></textarea>

    <button type="submit">Add Pet</button>
</form>
    </div>
</div>
<?php require_once (dirname(__DIR__).'\Views\components\footer.php'); ?>
</body>
</html>