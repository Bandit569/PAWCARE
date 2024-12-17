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
<p>
<form action="/RegisterController/store" method="POST">
    <label for="firstname">First Name</label>
    <input type="text" name="firstname" required>

    <label for="lastname">Last Name</label>
    <input type="text" name="lastname" required>

    <label for="email">Email</label>
    <input type="email" name="email" required>

    <label for="contactno">Contact No.</label>
    <input type="text" name="contactno" required>

    <label for="username">Username</label>
    <input type="text" name="username" required>

    <label for="password">Password</label>
    <input type="password" name="password" required>

    <label for="role">Register as</label>
    <select name="role" required>
        <option value="owner">Pet Owner</option>
        <option value="caretaker">Caretaker</option>
        <option value="both">Both</option>
    </select>

    <button type="submit">Register</button>
</form>
</body>
</html>
