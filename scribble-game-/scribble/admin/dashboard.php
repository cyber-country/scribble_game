<?php
session_start();
//require_once "../db.php";

if (!isset($_SESSION['admin'])) {
    header("Location: ./includes/login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Create Room</title>
        <link rel="stylesheet" href="../tailwind.min.css">
        <link rel="stylesheet" href="../assets/style.css">
        <link rel="stylesheet" href="./assets/style.css"> 
    </head>
    <body class="bg-gray-950 text-white min-h-screen flex items-center justify-center p-6">
        <!-- Main Container -->
        <div class="bg-gradient-to-br from-gray-800 to-black p-8 rounded-3xl shadow-2xl w-full max-w-xl border-4 border-yellow-400 scribble-border">

            <!-- Title -->
            <h1 class="text-yellow-300 text-3xl font-bold mb-2 text-center scanning">🔎 Room List</h1>
            <!-- <p class="text-gray-400 mb-6 text-center text-sm">Please select a room to join.</p> -->

            <!-- Room List -->
            <div class="grid gap-4 mb-6">

            <!-- Room 1 -->
            <div onclick="selectRoom('Fun Game', '123456')" class="cursor-pointer room-card bg-blue-900 border-4 border-blue-500 rounded-xl px-6 py-4">
                <h2 class="text-white font-bold text-xl">🎉 Fun Game</h2>
                <p class="text-yellow-300 font-mono">Room Code: 123456</p>
                <p class="text-sm text-gray-300">Players: 2 / 6</p>
            </div>

            <!-- Room 2 -->
            <div onclick="selectRoom('Scribble Squad', '334455')" class="cursor-pointer room-card bg-purple-900 border-4 border-purple-500 rounded-xl px-6 py-4">
                <h2 class="text-white font-bold text-xl">🔥 Scribble Squad</h2>
                <p class="text-yellow-300 font-mono">Room Code: 334455</p>
                <p class="text-sm text-gray-300">Players: 5 / 8</p>
            </div>

            <!-- Room 3 -->
            <div onclick="selectRoom('Quiz Arena', '778899')" class="cursor-pointer room-card bg-green-900 border-4 border-green-500 rounded-xl px-6 py-4">
                <h2 class="text-white font-bold text-xl">🧠 Quiz Arena</h2>
                <p class="text-yellow-300 font-mono">Room Code: 778899</p>
                <p class="text-sm text-gray-300">Players: 1 / 4</p>
            </div>

            </div>

            <!-- Back to Home -->
            <div class="text-center">
            <a href="index.html" class="text-yellow-400 hover:underline text-sm">⬅️ Back to Home</a>
            </div>
        </div>

        <script src="./assets/script.js"></script>
    </body>
</html>