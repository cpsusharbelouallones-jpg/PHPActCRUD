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
  $username = mysqli_real_escape_string($conn, $_POST['username']);
  $password = mysqli_real_escape_string($conn, $_POST['password']);

  $sql = "UPDATE students SET username='$username', password='$password' WHERE id=$id";

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

  <?php if (isset($error)) {
    echo "<p style='color:red;'>$error</p>";
  } ?>

  <form method="POST" action="">
    <!-- Hidden input to keep track of the student ID -->
    <input type="hidden" name="id" value="<?php echo $student['id']; ?>">

    <label>Username:</label><br>
    <input type="text" name="username" value="<?php echo htmlspecialchars($student['username']); ?>" required><br><br>

    <label>Password:</label><br>
    <input type="password" name="password" value="<?php echo htmlspecialchars($student['password']); ?>" required><br><br>

    <input type="submit" value="Update Student">
    <a href="index.php">Cancel</a>
  </form>
</body>

</html>