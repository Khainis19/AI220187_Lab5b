<?php 

include 'Database.php';
include 'User.php';

if (isset($_POST['submit']) && ($_SERVER['REQUEST_METHOD'] == 'POST')) {

    // Create database connection
    $database = new Database();
    $db = $database->getConnection();

    // Sanitize inputs
    $matric = $db->real_escape_string($_POST['matric']);
    $password = $db->real_escape_string($_POST['password']);

    // Validate inputs
    if (!empty($matric) && !empty($password)) {

        $user = new User($db);
        $userDetails = $user->getUser($matric);

        // If user exists
        if ($userDetails) {

            // Verify password
            if (password_verify($password, $userDetails['password'])) {
                echo "Login Successful";
            } else {
                echo "<p style='color:black;'>Invalid username or password, try <a href='login.php'>login</a> again.</p>";
            }

        } else {
            // Wrong matric → treat same as wrong password
            echo "<p style='color:black;'>Invalid username or password, try <a href='login.php'>login</a> again.</p>";
        }

    } else {
        echo "Please fill in all required fields.";
    }
}
