<?php
// 1. Define Database Credentials
$servername = "localhost";
$username = "root";
$password = "Japjap123@";
$dbname = "db_rosero";
// 2. Create the connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// 3. Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
