<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>
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

        button {
            width: 100%;
            padding: 10px;
            font-size: 14px;
            color: white;
            background-color: #007bff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #0056b3;
        }

        .message {
            margin-top: 15px;
            text-align: center;
            font-size: 14px;
            color: red;
        }

        .success {
            color: green;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Change Password</h2>
        <form method="POST" action="">
            <div class="form-group">
                <label for="user_id">User ID:</label>
                <input type="number" id="user_id" name="user_id" required>
            </div>

            <div class="form-group">
                <label for="old_password">Old Password:</label>
                <input type="password" id="old_password" name="old_password" required>
            </div>

            <div class="form-group">
                <label for="new_password">New Password:</label>
                <input type="password" id="new_password" name="new_password" required>
            </div>

            <div class="form-group">
                <label for="confirm_password">Confirm New Password:</label>
                <input type="password" id="confirm_password" name="confirm_password" required>
            </div>

            <button type="submit" name="change_password">Change Password</button>
        </form>
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['change_password'])) {
            $servername = "localhost";
            $username = "root";
            $password = "root";
            $dbname = "petcare";

            $conn = new mysqli($servername, $username, $password, $dbname);

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Capture and sanitize user input
            $user_id = htmlspecialchars($_POST['user_id']);
            $old_password = htmlspecialchars($_POST['old_password']);
            $new_password = htmlspecialchars($_POST['new_password']);
            $confirm_password = htmlspecialchars($_POST['confirm_password']);

            // Check if the passwords match
            if ($new_password !== $confirm_password) {
                echo "<p class='message'>New password and confirmation password do not match.</p>";
            } else {
                // Validate the current password
                $sql = "SELECT user_password FROM user_details WHERE user_id = ?";
                $stmt = $conn->prepare($sql);

                if ($stmt) {
                    $stmt->bind_param("i", $user_id);
                    $stmt->execute();
                    $stmt->bind_result($user_password);
                    $stmt->fetch();

                    // Verify old password
                    if (password_verify($old_password, $user_password)) {
                        // Hash the new password and update
                        $hashed_password = password_hash($new_password, PASSWORD_BCRYPT);
                        $stmt->close();

                        $update_sql = "UPDATE user_details SET user_password = ? WHERE user_id = ?";
                        $update_stmt = $conn->prepare($update_sql);
                        if ($update_stmt) {
                            $update_stmt->bind_param("si", $hashed_password, $user_id);
                            if ($update_stmt->execute()) {
                                echo "<p class='message success'>Password updated successfully!</p>";
                            } else {
                                echo "<p class='message'>Error updating password: " . $update_stmt->error . "</p>";
                            }
                            $update_stmt->close();
                        }
                    } else {
                        echo "<p class='message'>Incorrect old password.</p>";
                    }
                } else {
                    echo "<p class='message'>Error preparing query: " . $conn->error . "</p>";
                }
            }
            $conn->close();
        }
        ?>
    </div>
</body>
</html>
