<?php
include 'Database.php';
include 'User.php';

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    // Retrieve the matric value from the GET request
    $matric = $_GET['matric'];

    // Create database connection
    $database = new Database();
    $db = $database->getConnection();

    $user = new User($db);
    $userDetails = $user->getUser($matric);

    $db->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update User</title>
</head>

<body>
    <h1>Update User</h1>

    <form action="update.php" method="post">

        <!-- Matric (disabled but still sent using hidden input) -->
        <label for="matric_display">Matric:</label>
        <input type="text" id="matric_display" value="<?php echo $userDetails['matric']; ?>" disabled><br>
        <input type="hidden" name="matric" value="<?php echo $userDetails['matric']; ?>">

        <!-- Name -->
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" value="<?php echo $userDetails['name']; ?>" required><br>

        <!-- Access Level -->
        <label for="role">Access Level:</label>
        <select name="role" id="role" required>
            <option value="">Please select</option>
            <option value="lecturer" <?php if ($userDetails['role'] == 'lecturer') echo "selected"; ?>>Lecturer</option>
            <option value="student" <?php if ($userDetails['role'] == 'student') echo "selected"; ?>>Student</option>
        </select><br><br>

        <!-- Buttons -->
        <input type="submit" value="Update">
        <a href="read.php" style="margin-left:10px;">Cancel</a>

    </form>
</body>

</html>

<?php } ?>
