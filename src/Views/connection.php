<?php
// Database connection setup
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "petcare"; // Replace with your actual database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize input
    $user_id = isset($_POST['user_id']) ? intval($_POST['user_id']) : 0;
    $first_name = isset($_POST['first_name']) ? trim($_POST['first_name']) : '';
    $last_name = isset($_POST['last_name']) ? trim($_POST['last_name']) : '';
    $contact_number = isset($_POST['user_contact_number']) ? trim($_POST['user_contact_number']) : '';
    $email = isset($_POST['user_email']) ? trim($_POST['user_email']) : '';
    $profile_image = null;

    // Handle profile image upload
    if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] === UPLOAD_ERR_OK) {
        $profile_image = $_FILES['profile_image']['name'];
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($profile_image);

        // Verify if uploaded file is an image
        $check = getimagesize($_FILES['profile_image']['tmp_name']);
        if ($check !== false) {
            if (move_uploaded_file($_FILES['profile_image']['tmp_name'], $target_file)) {
                echo "Profile picture uploaded successfully.";
            } else {
                echo "Error uploading profile picture.";
                exit();
            }
        } else {
            echo "Uploaded file is not a valid image.";
            exit();
        }
    }

    // Update query
    $sql = "UPDATE user_details SET user_first_name=?, user_last_name=?, user_contact_number=?, user_email=?, user_image=? WHERE user_id=?";
    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        die("Error preparing statement: " . $conn->error);
    }

    // Bind parameters
    $stmt->bind_param("sssssi", $first_name, $last_name, $contact_number, $email, $profile_image, $user_id);

    // Execute statement and check success
    if ($stmt->execute()) {
    echo "<script>
        window.onload = function() {
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: 'Profile updated successfully.',
            }).then(() => {
                window.location.href = 'profile_page2.php'; // Redirect after confirmation
            });
        }
    </script>";
} else {
    echo "<script>
        window.onload = function() {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Error updating profile: " . addslashes($stmt->errorInfo()[2]) . "',
            });
        }
    </script>";
}


    // Close statement and connection
    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update User</title>
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

        .form-container {
            background-color: #fff;
            width: 400px;
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        .form-container h2 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        .profile-section {
            text-align: center;
            margin-bottom: 15px;
        }

        .profile-section img {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            background-color: #ddd;
            object-fit: cover;
            cursor: pointer;
        }

        .profile-section label {
            display: block;
            margin-top: 10px;
            font-size: 14px;
            font-weight: bold;
            color: #007bff;
            cursor: pointer;
        }

        input[type="file"] {
            display: none;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            font-weight: bold;
            color: #007bff;
            margin-bottom: 5px;
        }

        .form-group input {
            width: 100%;
            padding: 10px;
            font-size: 14px;
            border: 1px solid #ddd;
            border-radius: 5px;
            transition: border-color 0.3s;
        }

        .form-group input:focus {
            border-color: #007bff;
            outline: none;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.2);
        }

        .button-group {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
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

        .update-btn {
            background-color: #28a745;
        }

        .update-btn:hover {
            background-color: #218838;
        }

        .cancel-btn {
            background-color: #dc3545;
        }

        .cancel-btn:hover {
            background-color: #c82333;
        }

        button:active {
            transform: scale(0.97);
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Update Profile</h2>
        <div class="profile-section">
            <img id="profileImagePreview" src="https://via.placeholder.com/120" alt="Profile Picture">
            <label for="profileImageUpload">Upload Profile Picture</label>
            <input type="file" id="profileImageUpload" name="profile_image" accept="image/*">
        </div>
        <form method="POST" action="" enctype="multipart/form-data">
            <div class="form-group">
                <label for="user_id">User ID:</label>
                <input type="number" id="user_id" name="user_id" required>
            </div>

            <div class="form-group">
                <label for="first_name">New First Name:</label>
                <input type="text" id="first_name" name="first_name" required>
            </div>

            <div class="form-group">
                <label for="last_name">New Last Name:</label>
                <input type="text" id="last_name" name="last_name" required>
            </div>

            <div class="form-group">
                <label for="contact_number">Contact Number:</label>
                <input type="text" id="user_contact_number" name="user_contact_number" required>
            </div>

            <div class="form-group">
                <label for="email">Email Address:</label>
                <input type="email" id="user_email" name="user_email" required>
            </div>

            <div class="button-group">
                <button type="submit" class="update-btn">Update</button>
                <button type="button" class="cancel-btn" onclick="cancelEdit()">Cancel</button>
            </div>
        </form>
    </div>

    <script>
        // Handle profile image preview
        const profileImageUpload = document.getElementById("profileImageUpload");
        const profileImagePreview = document.getElementById("profileImagePreview");

        profileImageUpload.addEventListener("change", function () {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    profileImagePreview.src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        });

        function cancelEdit() {
            if (confirm("Are you sure you want to cancel?")) {
                window.location.href = "profile_page2.php"; // Replace with your desired redirect URL
            }
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</body>
</html>
