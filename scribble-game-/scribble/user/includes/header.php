<?php
session_start();
require_once "../db.php";

if (!isset($_SESSION['admin'])) {
    header("Location: ./includes/login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Join Room - Room List</title>
  <link rel="stylesheet" href="tailwind.min.css" />
  <link rel="stylesheet" href="index.css" />
  <style>
    .room-card {
      transition: transform 0.2s ease, box-shadow 0.3s ease;
    }
    .room-card:hover {
      transform: scale(1.02);
      box-shadow: 0 0 20px rgba(250, 204, 21, 0.7), 0 0 10px rgba(250, 204, 21, 0.4);
      border-color: #facc15;
    }
    .scanning::after {
      content: "...";
      animation: dots 1s steps(3, end) infinite;
    }
    @keyframes dots {
      0% { content: ""; }
      33% { content: "."; }
      66% { content: ".."; }
      100% { content: "..."; }
    }
  </style>
</head>
<body class="bg-gray-950 text-white min-h-screen flex items-center justify-center p-6">