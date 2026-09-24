<?php
include 'db_connect.php';

$username = $_POST['username'];
$password = $_POST['password'];

if (!empty($_POST['id'])) {
  $id = intval($_POST['id']);
  $sql = "UPDATE students SET username='$username', password='$password' WHERE id=$id";
} else {
  $sql = "INSERT INTO students (username, password)
        VALUES ('$username', '$password')";
}

if (mysqli_query($conn, $sql)) {
  return header("Location: index.php" . "?success=1");
} else {
  echo "Error: " . mysqli_error($conn);
}
