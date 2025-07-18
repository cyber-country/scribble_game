<?php
// include '../db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['join_room'])) {
    // Get form data safely
    $player_name = trim($_POST['player_name']);
    $room_id = intval($_POST['room_id']);

    // Check if room_id is 5-digit
    if ($room_id < 10000 || $room_id > 99999) {
        echo "<script>alert('Room ID must be a 5-digit number'); history.back();</script>";
        exit;
    }

    // Check if player name already exists
    $stmt = $conn->prepare("SELECT room_id FROM players WHERE player_name = ?");
    $stmt->bind_param("s", $player_name);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($existing_room_id);
        $stmt->fetch();

        // Check if the existing room has already started
        $roomCheck = $conn->prepare("SELECT game_started FROM rooms WHERE room_code = ?");
        $roomCheck->bind_param("i", $existing_room_id);
        $roomCheck->execute();
        $roomCheck->bind_result($game_started);
        $roomCheck->fetch();
        $roomCheck->close();

        if ($game_started == 2) {
            echo "<script>alert('The player name is already taken and game has already started.'); history.back();</script>";
            exit;
        } else {
            // Update the player's room_id
            $update = $conn->prepare("UPDATE players SET room_id = ? WHERE player_name = ?");
            $update->bind_param("is", $room_id, $player_name);
            $update->execute();
            echo "<script>alert('Player re-assigned to new room.'); window.location.href='lobby.php?room_id={$room_id}';</script>";
            exit;
        }

    } else {
        // Insert new player
        $insert = $conn->prepare("INSERT INTO players (player_name, room_id) VALUES (?, ?)");
        $insert->bind_param("si", $player_name, $room_id);
        $insert->execute();
        echo "<script>alert('Player joined successfully!'); window.location.href='lobby.php?room_id={$room_id}';</script>";
        exit;
    }
$stmt->close();
$conn->close();
}


?>

<!-- Title -->
<h1 class="text-yellow-300 pb-10 text-3xl font-bold mb-2 text-center">🛠️ Join the Room</h1>

    <form method="POST">

      <!-- Players Name -->
      <div class="mb-5">
        <label class="block mb-2 font-bold text-lg">Player Name:</label>
        <input required
          name="player_name"
          type="text"
          id="playerName"
          placeholder="Enter player name"
          class="w-full bg-purple-900 border-3 border-purple-500 text-white font-bold px-4 py-3 rounded-xl focus:outline-none focus:border-purple-300 text-lg placeholder-white"
        >
      </div>

      <!-- Room Id -->
      <div class="mb-5">
        <label class="block mb-2 font-bold text-lg">Room Id:</label>
        <input required
          name="room_id"
          type="number"
          id="roomId"
          placeholder="Enter 5-digit room ID"
          min="00000"
          max="99999"
          class="w-full bg-orange-900 border-3 border-orange-500 text-white font-bold px-4 py-3 rounded-xl focus:outline-none focus:border-orange-300 text-lg placeholder-white appearance-none"
        >
      </div>

      <!-- Action Button -->
      <button type="submit" name="join_room" class="mt-4 px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">
        Join Room
      </button>
    </form>
