<?php
/**
 * @var $lemoncake string our parameter name
 */
?>

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
    <form id="registerForm" action="/PAWCARE/Register" method="POST">
        <h1>Register to PawCare</h1>

        <div class="form-group">
    <label for="firstname">First Name</label>
    <input type="text" id="firstname" name="firstname" required>
        </div>

        <div class="form-group">
    <label for="lastname">Last Name</label>
    <input type="text" id="lastname" name="lastname" required>
        </div>

        <div class="form-group">
    <label for="email">Email</label>
    <input type="email" id="email" name="email" required>
        </div>

        <div class="form-group">
    <label for="contactno">Contact No.</label>
    <input type="text" id="contactno" name="contactno" required>
        </div>

        <div class="form-group">
    <label for="username">Username</label>
    <input type="text" id="username" name="username" required>
        </div>

        <div class="form-group">
    <label for="password">Password</label>
    <input type="password" id="password" name="password" required>
        </div>

        <div class="form-group">
    <label for="role">Register as</label>
    <select name="role" id="role" required>
        <?php if(!empty($roles)): ?>
            <option value="">Select Role</option>
        <?php foreach ($roles as $role): ?>
            <option value="<?= htmlspecialchars($role['iduser_type']) ?>"><?= htmlspecialchars($role['user_type_name']) ?></option>
        <?php endforeach; ?>
        <?php else: ?>
            <option value="" disabled>No roles available</option>
        <?php endif; ?>
    </select>
        </div>
<div class="button-container">
    <button type="submit">Register</button>
<button id="cancelButton" type="button">Cancel</button>
</div>

        <script>
            // Add event handler for the cancel button to redirect to Home page
            const cancelButton = document.getElementById('cancelButton');
            cancelButton.addEventListener('click', () => {
                window.location.href = '/PAWCARE/'; // Replace with the actual home page path
            });
        </script>
</form>
</div>
</div>
    <?php require_once (dirname(__DIR__).'\Views\components\footer.php'); ?>
</body>
</html>
<script>
    document.addEventListener("DOMContentLoaded", () => {
        const form = document.getElementById("registerForm");
        const firstname = document.getElementById("firstname");
        const lastname = document.getElementById("lastname");
        const email = document.getElementById("email");
        const contactno = document.getElementById("contactno");
        const username = document.getElementById("username");
        const password = document.getElementById("password");
        const role = document.getElementById("role");

        const fields = [firstname, lastname, email, contactno, username, password, role];

        // Function to show error messages dynamically below the input field
        const showError = (field, message) => {
            let errorElement = field.parentElement.querySelector(".error");
            if (!errorElement) {
                // Create and insert the error message if it doesn't exist
                errorElement = document.createElement("div");
                errorElement.classList.add("error");
                field.parentElement.appendChild(errorElement);
            }
            errorElement.textContent = message; // Set the error message text
            field.classList.add("invalid");
        };

        // Function to clear any existing error messages
        const clearError = (field) => {
            let errorElement = field.parentElement.querySelector(".error");
            if (errorElement) {
                errorElement.textContent = ''; // Clear the error text
                field.classList.remove("invalid"); // Remove styling
            }
        };

        // Validate an individual field
        const validateField = (field) => {
            if (field === firstname) {
                if (field.value.trim() === "") {
                    showError(field, "First name is required.");
                    return false;
                } else if (!/^[a-zA-Z]+$/.test(field.value.trim())) {
                    showError(field, "First name must contain only alphabets.");
                    return false;
                }
            }

            if (field === lastname) {
                if (field.value.trim() === "") {
                    showError(field, "Last name is required.");
                    return false;
                } else if (!/^[a-zA-Z]+$/.test(field.value.trim())) {
                    showError(field, "Last name must contain only alphabets.");
                    return false;
                }
            }

            if (field === email) {
                if (field.value.trim() === "") {
                    showError(field, "Email is required.");
                    return false;
                } else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(field.value.trim())) {
                    showError(field, "Please enter a valid email address.");
                    return false;
                }
            }

            if (field === contactno) {
                if (field.value.trim() === "") {
                    showError(field, "Contact number is required.");
                    return false;
                } else if (!/^\d{10}$/.test(field.value.trim())) {
                    showError(field, "Contact number must be 10 digits.");
                    return false;
                }
            }

            if (field === username) {
                if (field.value.trim() === "") {
                    showError(field, "Username is required.");
                    return false;
                } else if (field.value.trim().length < 3 || field.value.trim().length > 15) {
                    showError(field, "Username must be between 3 and 15 characters.");
                    return false;
                }
            }

            if (field === password) {
                if (field.value.trim() === "") {
                    showError(field, "Password is required.");
                    return false;
                } else if (field.value.trim().length < 6) {
                    showError(field, "Password must be at least 6 characters.");
                    return false;
                }
            }

            if (field === role) {
                if (field.value.trim() === "") {
                    showError(field, "Please select a role.");
                    return false;
                }
            }

            // If valid, clear any existing error
            clearError(field);
            return true;
        };

        // Add "blur" event listener to validate on field exit
        fields.forEach(field => {
            field.addEventListener("blur", () => {
                validateField(field);
            });
        });

        // Validate all fields on form submission
        form.addEventListener("submit", (e) => {
            let isValid = true;
            fields.forEach(field => {
                if (!validateField(field)) {
                    isValid = false;
                }
            });

            // Prevent form submission if validation fails
            if (!isValid) {
                e.preventDefault();
            }
        });
    });

</script>
