<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <style>
        /* General Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .profile-container {
            background-color: #fff;
            width: 400px;
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            text-align: center;
            position: relative;
        }

        .user-icon {
            font-size: 50px;
            color: #007bff;
            margin-bottom: 10px;
        }

        .profile-container img {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            margin-bottom: 20px;
            object-fit: cover;
            border: 3px solid #007bff;
        }

        .profile-container h2 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        .profile-group {
            margin-bottom: 15px;
            text-align: left;
        }

        .profile-group label {
            display: block;
            font-weight: bold;
            color: #007bff;
            margin-bottom: 5px;
        }

        .profile-group .profile-value {
            color: #555;
            font-size: 16px;
            padding: 10px;
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .button-group {
            margin-top: 20px;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        button {
            padding: 10px 15px;
            font-size: 14px;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: transform 0.2s, background-color 0.3s;
        }

        .logout-btn {
            background-color: #dc3545;
        }

        .logout-btn:hover {
            background-color: #c82333;
        }

        .edit-btn {
            background-color: #007bff;
        }

        .edit-btn:hover {
            background-color: #0056b3;
        }

        .change-password-btn {
            background-color: #ffc107;
        }

        .change-password-btn:hover {
            background-color: #e0a800;
        }

        button:active {
            transform: scale(0.97);
        }
    </style>
    <!-- Include FontAwesome for icons -->
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</head>
<body>
    <div class="profile-container">
        <!-- User Icon -->
        <div class="user-icon">
            <i class="fas fa-user-circle"></i>
        </div>

        <?php
        // Mock user details (replace with database fetching logic)
        $user_id = 1; // Example User ID
        $first_name = "John";
        $last_name = "Doe";
        $contact_number = "123-456-7890";
        $email = "john.doe@example.com";
        $profile_image = "https://via.placeholder.com/120"; // Replace with user image URL or path

        // Display user image
        echo '<img src="' . htmlspecialchars($profile_image) . '" alt="User Image">';
        ?>


        <?php
        // Display user details
        echo '
            <div class="profile-group">
                <label for="user_id">User ID:</label>
                <div class="profile-value" id="user_id">' . htmlspecialchars($user_id) . '</div>
            </div>
            <div class="profile-group">
                <label for="first_name">First Name:</label>
                <div class="profile-value" id="first_name">' . htmlspecialchars($first_name) . '</div>
            </div>
            <div class="profile-group">
                <label for="last_name">Last Name:</label>
                <div class="profile-value" id="last_name">' . htmlspecialchars($last_name) . '</div>
            </div>
            <div class="profile-group">
                <label for="contact_number">Contact Number:</label>
                <div class="profile-value" id="contact_number">' . htmlspecialchars($contact_number) . '</div>
            </div>
            <div class="profile-group">
                <label for="email">Email:</label>
                <div class="profile-value" id="email">' . htmlspecialchars($email) . '</div>
            </div>
        ';
        ?>

        <div class="button-group">
            <button class="edit-btn" onclick="editProfile()">Edit Profile</button>
            <button class="change-password-btn" onclick="changePassword()">Change Password</button>
            <button class="logout-btn" onclick="logout()">Logout</button>
        </div>
    </div>

    <script>
        // Redirect to Edit Profile Page
        function editProfile() {
            window.location.href = "connection.php"; // Change to your edit profile page
        }

        // Redirect to Change Password Page
        function changePassword() {
            window.location.href = "change_pass.php"; // Change to your change password page
        }

        // Logout
        function logout() {
            if (confirm("Are you sure you want to logout?")) {
                window.location.href = "/PAWCARE/logout"; // Change to your logout handling page
            }
        }
    </script>
</body>
</html>
