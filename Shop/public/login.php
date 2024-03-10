<?php
session_start();

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if username and password are provided
    if (isset($_POST["username"]) && isset($_POST["password"])) {
        $username = $_POST["username"];
        $password = $_POST["password"];

        // Validate username and password (You should use a secure way to store and retrieve passwords, like bcrypt)
        if ($username === '1029admin_admin1029' && $password === '71d4ec024886c1c8e4707fb02b46fd568df44e77dd5055cadc3451747f0f2716') {
            // Authentication successful, create session
            $_SESSION["username"] = $username;
            header("Location: dashboard.php"); // Redirect to dashboard or authenticated page
            exit();
        } else {
            // Invalid username or password
            echo "Invalid username or password.";
        }
    }
}
?>
