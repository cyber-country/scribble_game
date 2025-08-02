<?php
require_once "./includes/db.php";

$room_code = isset($_GET['room_code']) ? intval($_GET['room_code']) : 0;
$player_name = isset($_GET['name']) ? htmlspecialchars($_GET['name']) : '';

// Validate room
$room_query = $conn->prepare("SELECT room_name FROM rooms WHERE room_code = ?");
$room_query->bind_param("i", $room_code);
$room_query->execute();
$room_query->bind_result($room_name);
$room_query->fetch();
$room_query->close();

if (!$room_name) {
    echo "<script>alert('Room not found'); window.location.href='join_room_list.php';</script>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Waiting Room</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@400;600;700&display=swap" rel="stylesheet">
  <style>
    body { font-family: 'Fredoka', sans-serif; }
    @keyframes gradientFlow {
      0% { background-position: 0% 50%; }
      50% { background-position: 100% 50%; }
      100% { background-position: 0% 50%; }
    }
    .animated-bg {
      background: linear-gradient(-45deg, #fde68a, #ffdf3e, #93c5fd, #a5f3fc);
      background-size: 500% 500%;
      animation: gradientFlow 12s ease infinite;
    }
    @keyframes float {
      0%, 100% { transform: translateY(0); }
      50% { transform: translateY(-10px); }
    }
    .float-animation { animation: float 3s ease-in-out infinite; }
    @keyframes wiggle {
      0%, 100% { transform: rotate(-2deg); }
      50% { transform: rotate(2deg); }
    }
    .wiggle-animation { animation: wiggle 2s ease-in-out infinite; }

    .doodle { z-index: 0; pointer-events: none; }
    #player-list { transition: opacity 0.3s ease; }

    @media (max-width: 640px) {
      .doodle { font-size: 1.5rem !important; }
    }
  </style>
  <script>
    // Auto-refresh player list from fetch_players.php
    setInterval(() => {
      const list = document.getElementById('player-list');
      list.style.opacity = 0;
      fetch(`fetch_players.php?room_code=<?php echo $room_code; ?>`)
        .then(res => res.text())
        .then(html => {
          list.innerHTML = html;
          list.style.opacity = 1;
        });
    }, 5000);
  </script>
</head>
<body class="animated-bg min-h-screen flex items-center justify-center p-6 text-neutral-800 font-sans overflow-hidden">

  <!-- Floating Doodles -->
  <div class="absolute inset-0 z-0">
    <div class="doodle top-10 left-10 text-5xl float-animation absolute">✏️</div>
    <div class="doodle top-1/4 right-1/3 text-4xl wiggle-animation absolute">🎨</div>
    <div class="doodle bottom-1/3 left-1/4 text-5xl float-animation absolute">📝</div>
    <div class="doodle bottom-10 right-10 text-3xl wiggle-animation absolute">🖍️</div>
    <div class="doodle top-1/2 left-5 text-4xl float-animation absolute">🌟</div>
    <div class="doodle top-1/3 right-5 text-3xl wiggle-animation absolute">🎭</div>
  </div>

  <!-- Waiting Room Box -->
  <div class="relative z-10 w-11/12 sm:w-4/5 md:w-3/5 lg:w-1/2 xl:w-2/5 p-6 sm:p-10 rounded-3xl shadow-2xl border-2 border-white backdrop-blur-xl bg-white/60 text-neutral-800">
    <h1 class="text-3xl sm:text-4xl md:text-5xl font-black text-center mb-6 text-blue-800 drop-shadow-lg tracking-wide break-words">
      🎮 Waiting Room
    </h1>
    <p class="text-center text-lg sm:text-xl font-semibold mb-4">
      Room: <?php echo htmlspecialchars($room_name); ?> (Code: <?php echo $room_code; ?>)
    </p>

    <!-- Player List -->
    <div id="player-list" class="space-y-2">
      <?php
      $players_result = $conn->prepare("SELECT player_name FROM players WHERE room_id = ?");
      $players_result->bind_param("i", $room_code);
      $players_result->execute();
      $players_result->bind_result($player);
      while ($players_result->fetch()):
      ?>
        <div class="bg-white/80 p-3 rounded-xl shadow text-center font-bold text-blue-700 text-base sm:text-lg">
          <?php echo htmlspecialchars($player); ?>
        </div>
      <?php endwhile; $players_result->close(); ?>
    </div>

    <!-- Start Game Button -->
    <div class="mt-6 text-center">
      <button onclick="window.location.href='game_lobby.php?room_code=<?php echo $room_code; ?>'"
        class="bg-gradient-to-r from-green-500 to-green-600 text-white font-bold px-6 py-3 rounded-xl hover:scale-105 transition transform duration-300">
        Start Game
      </button>
    </div>
  </div>

</body>
</html>
