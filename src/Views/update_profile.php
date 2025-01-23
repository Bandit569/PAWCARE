<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update User</title>
    <link rel="stylesheet" href="../public/assets/style.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <div class="form-container">
        <h2>Update Profile</h2>
        <div class="profile-section">
            <img id="profileImagePreview" src="https://via.placeholder.com/120" alt="Profile Picture">
            <label for="profileImageUpload">Upload Profile Picture</label>
            <input type="file" id="profileImageUpload" name="profile_image" accept="image/*">
        </div>
        <form method="POST" action="../public/index.php?action=updateUserProfile" enctype="multipart/form-data">
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
                window.location.href = "/PAWCARE/profile_page2";
            }
        }
    </script>
</body>
</html>
