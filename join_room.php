<?php
require_once "./includes/db.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $player_name = trim($_POST['player_name']);
    $room_code = intval($_POST['room_code']);

    if ($room_code < 10000 || $room_code > 99999) {
        echo "<script>alert('Invalid Room Code');</script>";
    } else {
        $room_check = $conn->prepare("SELECT id FROM rooms WHERE room_code = ?");
        $room_check->bind_param("i", $room_code);
        $room_check->execute();
        $room_check->store_result();

        if ($room_check->num_rows > 0) {
            $stmt = $conn->prepare("INSERT INTO players (player_name, room_id) VALUES (?, ?)");
            $stmt->bind_param("si", $player_name, $room_code);

            if ($stmt->execute()) {
                header("Location: waiting_room.php?room_code=$room_code&name=" . urlencode($player_name));
                exit;
            } else {
                echo "<script>alert('Error joining room: " . $stmt->error . "');</script>";
            }
        } else {
            echo "<script>alert('Room not found');</script>";
        }

        $room_check->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Join Room</title>
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

    /* Adjust doodle positions so they don't overlap header */
    .doodle-top { top: 5%; }
    .doodle-bottom { bottom: 5%; }

    /* Scale doodles on smaller screens */
    @media (max-width: 640px) {
      .doodle { font-size: 1.5rem !important; }
      .floating-svg { display: none; }
    }
  </style>
</head>
<body class="animated-bg min-h-screen flex items-center justify-center p-6 text-neutral-800 font-sans overflow-hidden">

  <!-- Floating Doodles -->
  <div class="absolute inset-0 z-0 pointer-events-none">
    <div class="doodle doodle-top left-10 text-5xl float-animation absolute">✏️</div>
    <div class="doodle doodle-top right-1/3 text-4xl wiggle-animation absolute">🎨</div>
    <div class="doodle bottom-1/3 left-1/4 text-5xl float-animation absolute">📝</div>
    <div class="doodle doodle-bottom right-10 text-3xl wiggle-animation absolute">🖍️</div>
    <div class="doodle top-1/2 left-5 text-4xl float-animation absolute">🌟</div>
    <div class="doodle top-1/3 right-5 text-3xl wiggle-animation absolute">🎭</div>
  </div>

  <!-- SVG Paint Splashes -->
  <svg class="floating-svg absolute top-20 left-1/4 w-20 h-20 opacity-30 z-0" viewBox="0 0 100 100">
    <circle cx="50" cy="50" r="30" fill="#fbbf24"/>
    <circle cx="30" cy="30" r="15" fill="#3b82f6"/>
  </svg>
  <svg class="floating-svg absolute bottom-32 right-1/4 w-16 h-16 opacity-30 z-0" viewBox="0 0 100 100">
    <circle cx="40" cy="60" r="25" fill="#10b981"/>
    <circle cx="60" cy="30" r="12" fill="#8b5cf6"/>
  </svg>

  <!-- Join Room Form -->
  <div class="relative w-11/12 sm:w-4/5 md:w-3/5 lg:w-1/2 xl:w-2/5 p-6 sm:p-10 rounded-3xl shadow-2xl border-2 border-white backdrop-blur-xl bg-white/60 text-neutral-800 z-10">
    <h1 class="text-3xl sm:text-4xl md:text-5xl font-black text-center mb-6 text-blue-800 drop-shadow-lg tracking-wide break-words">
      🔐 Join a Room
    </h1>
    <form method="POST" class="space-y-5">
      <div>
        <label class="block text-lg font-semibold mb-1">Your Name</label>
        <input type="text" name="player_name" placeholder="Enter your name" required
          class="w-full px-4 py-3 rounded-xl border border-gray-300 placeholder-neutral-500 text-neutral-800 focus:outline-none">
      </div>
      <div>
        <label class="block text-lg font-semibold mb-1">Room Code</label>
        <input type="number" name="room_code" placeholder="e.g. 12345" min="10000" max="99999" required
          class="w-full px-4 py-3 rounded-xl border border-gray-300 placeholder-neutral-500 text-neutral-800 focus:outline-none">
      </div>
      <button type="submit"
        class="w-full bg-gradient-to-r from-blue-500 to-blue-600 text-white font-bold py-4 rounded-xl hover:scale-105 transition transform duration-300">
        🚀 Join Room
      </button>
    </form>
  </div>

</body>
</html>
