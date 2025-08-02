<?php
$conn = mysqli_connect("localhost", "root", "", "scribble_game");
if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}
?>
