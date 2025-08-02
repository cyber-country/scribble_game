<?php
require_once "./includes/db.php";

$room_code = isset($_GET['room_code']) ? intval($_GET['room_code']) : 0;

$players_result = $conn->prepare("SELECT player_name FROM players WHERE room_id = ?");
$players_result->bind_param("i", $room_code);
$players_result->execute();
$players_result->bind_result($player);

while ($players_result->fetch()) {
    echo '<div class="bg-white/80 p-3 rounded-xl shadow text-center font-bold text-blue-700 text-base sm:text-lg">'
       . htmlspecialchars($player) .
       '</div>';
}

$players_result->close();
