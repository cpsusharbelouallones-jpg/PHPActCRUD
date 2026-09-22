<?php
include 'db_connect.php';

// Check if ID is provided in the URL
if (isset($_GET['id'])) {
    $student_id = intval($_GET['id']);
    
    // Write the DELETE Query
    $sql = "DELETE FROM students WHERE id = $student_id";
    
    if (mysqli_query($conn, $sql)) {
        // Redirect back to index page after successful deletion
        header("Location: index.php");
        exit();
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
    }
} else {
    echo "Invalid request. No ID provided.";
}
?>