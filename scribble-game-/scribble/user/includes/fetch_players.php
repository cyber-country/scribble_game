<?php
$room_id = $_GET['room_id'] ?? 0;

require_once './db.php';

// $conn = new mysqli("localhost", "root", "", "scribble_game");
// if ($conn->connect_error) {
//     die(json_encode(["error" => "Database connection failed"]));
// }

// Fetch players
$player_sql = $conn->prepare("SELECT player_name FROM players WHERE room_id = ? ORDER BY joined_at ASC");
$player_sql->bind_param("i", $room_id);
$player_sql->execute();
$player_result = $player_sql->get_result();

$players = [];
while ($row = $player_result->fetch_assoc()) {
    $players[] = $row;
}

// Check if game_started is 2
$room_sql = $conn->prepare("SELECT game_started FROM rooms WHERE room_code = ?");
$room_sql->bind_param("i", $room_id);
$room_sql->execute();
$room_sql->bind_result($game_started);
$room_sql->fetch();

echo json_encode([
    "players" => $players,
    "game_started" => $game_started
]);
