<?php
session_start();
$room_id = $_SESSION['room_id'] ?? $_GET['room_id'] ?? null;

if (!$room_id) {
    die("Room ID missing");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Lobby</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="../tailwind.min.css">
</head>
<body class="bg-gray-950 text-white min-h-screen flex items-center justify-center p-6">
    <div class="">
        <div class="text-yellow-300 text-3xl font-bold mb-2 text-center">🎮 Lobby - Room <?php echo htmlspecialchars($room_id); ?></div>

        <div id="playerList" class="text-yellow-300 text-3xl font-bold mb-2 text-center max-w-md mx-auto shadow p-4">
            <div class="text-lg font-semibold mb-5">Players Joined:</div>
            <!-- <ul id="players" class=""></ul> -->
            <div id="playerCloud" class="flex flex-wrap justify-center gap-3 p-8 rounded-3xl shadow-2xl w-full max-w-xl"></div>
        </div>
    </div>

        <script>
            const roomId = <?php echo json_encode($room_id); ?>;

            function fetchPlayers() {
                fetch("includes/fetch_players.php?room_id=" + roomId)
                    .then(res => res.json())
                    .then(data => {
                        if (data.game_started === 2) {
                            window.location.href = "game.php?room_id=" + roomId;
                        } else {
                            const container = document.getElementById("playerCloud");
                            container.innerHTML = "";

                            data.players.forEach(player => {
                                const tag = document.createElement("span");
                                tag.textContent = player.player_name;
                                tag.className = "bg-lime-100 text-lime-800 px-3 py-1 rounded-full text-sm font-medium shadow hover:bg-blue-200";
                                container.appendChild(tag);
                            });
                        }
                    });
            }

            fetchPlayers();
            setInterval(fetchPlayers, 3000);
        </script>
</body>
</html>
