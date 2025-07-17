<?php
session_start();
require_once "./includes/db.php";

if (!isset($_SESSION['admin'])) {
    header("Location: ./includes/login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>ADMIN Dashboard</title>
        <link rel="stylesheet" href="../tailwind.min.css">
        <!-- <script src="https://cdn.tailwindcss.com"></script> -->
        <link rel="stylesheet" href="../assets/style.css">
        <link rel="stylesheet" href="./assets/style.css"> 
        <?php include 'includes/db.php'; ?>

    </head>

    <body class="bg-gray-950 text-white min-h-screen flex items-center justify-center p-6">