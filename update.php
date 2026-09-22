<?php
include 'db_connect.php';

// 1. Check if ID is provided in the URL
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    
    // Fetch the existing record
    $sql = "SELECT * FROM students WHERE id = $id";
    $result = mysqli_query($conn, $sql);
    
    if (mysqli_num_rows($result) == 1) {
        $student = mysqli_fetch_assoc($result);
    } else {
        echo "Student not found.";
        exit();
    }
} else {
    echo "Invalid request.";
    exit();
}

// 2. Handle form submission (when user clicks Update)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = intval($_POST['id']);
    $first_name = mysqli_real_escape_string($conn, $_POST['first_name']);
    $last_name = mysqli_real_escape_string($conn, $_POST['last_name']);

    $sql = "UPDATE students SET first_name='$first_name', last_name='$last_name' WHERE id=$id";

    if (mysqli_query($conn, $sql)) {
        // Redirect to index page after successful save
        header("Location: index.php");
        exit();
    } else {
        $error = "Error updating record: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Student</title>
</head>
<body>
    <h2>Edit Student</h2>
    
    <?php if (isset($error)) { echo "<p style='color:red;'>$error</p>"; } ?>

    <form method="POST" action="">
        <!-- Hidden input to keep track of the student ID -->
        <input type="hidden" name="id" value="<?php echo $student['id']; ?>">
        
        <label>First Name:</label><br>
        <input type="text" name="first_name" value="<?php echo htmlspecialchars($student['first_name']); ?>" required><br><br>
        
        <label>Last Name:</label><br>
        <input type="text" name="last_name" value="<?php echo htmlspecialchars($student['last_name']); ?>" required><br><br>
        
        <input type="submit" value="Update Student">
        <a href="index.php">Cancel</a>
    </form>
</body>
</html>