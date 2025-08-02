<?php
require_once "./includes/db.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $room_name = trim($_POST['room_name']);
    $total_time = intval($_POST['total_time']);
    $round_time = intval($_POST['round_time']);

    $room_code = rand(10000, 99999);

    $stmt = $conn->prepare("
        INSERT INTO rooms (room_code, room_name, total_time, round_time, game_started, end_time)
        VALUES (?, ?, ?, ?, 0, DATE_ADD(NOW(), INTERVAL 1 HOUR))
    ");
    $stmt->bind_param("isii", $room_code, $room_name, $total_time, $round_time);

    if ($stmt->execute()) {
        echo "<script>alert('Room created successfully! Code: $room_code'); window.location.href='index.html';</script>";
        exit;
    } else {
        echo "<script>alert('Error creating room: " . $stmt->error . "');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Create Room</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@400;600;700&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Fredoka', sans-serif;
    }
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
    <div class="doodle top-10 left-10 text-5xl float-animation absolute">✏️</div>
    <div class="doodle top-1/4 right-1/3 text-4xl wiggle-animation absolute">🎨</div>
    <div class="doodle bottom-1/3 left-1/4 text-5xl float-animation absolute">📝</div>
    <div class="doodle bottom-10 right-10 text-3xl wiggle-animation absolute">🖍️</div>
    <div class="doodle top-1/2 left-5 text-4xl float-animation absolute">🌟</div>
    <div class="doodle top-1/3 right-5 text-3xl wiggle-animation absolute">🎭</div>
  </div>

  <!-- SVG Paint Splashes -->
  <svg class="floating-svg absolute top-16 left-1/4 w-20 h-20 opacity-30 z-0" viewBox="0 0 100 100">
    <circle cx="50" cy="50" r="30" fill="#fbbf24"/>
    <circle cx="30" cy="30" r="15" fill="#3b82f6"/>
  </svg>
  <svg class="floating-svg absolute bottom-32 right-1/4 w-16 h-16 opacity-30 z-0" viewBox="0 0 100 100">
    <circle cx="40" cy="60" r="25" fill="#10b981"/>
    <circle cx="60" cy="30" r="12" fill="#8b5cf6"/>
  </svg>

  <!-- Create Room Form -->
  <div class="relative w-11/12 sm:w-4/5 md:w-3/5 lg:w-1/2 xl:w-2/5 p-6 sm:p-10 rounded-3xl shadow-2xl border-2 border-white backdrop-blur-xl bg-white/60 text-neutral-800 z-10">
    <h1 class="text-3xl sm:text-4xl md:text-5xl font-black text-center mb-6 text-blue-800 drop-shadow-lg tracking-wide whitespace-nowrap">
      🛠 Create a Room
    </h1>
    <form method="POST" class="space-y-5">
      <div>
        <label class="block text-lg font-semibold mb-1">Room Name</label>
        <input type="text" name="room_name" placeholder="e.g. fun-doodle" required
          class="w-full px-4 py-3 rounded-xl border border-gray-300 placeholder-neutral-500 text-neutral-800 focus:outline-none">
      </div>
      <div>
        <label class="block text-lg font-semibold mb-1">Total Game Time (seconds)</label>
        <input type="number" name="total_time" placeholder="e.g. 60" required
          class="w-full px-4 py-3 rounded-xl border border-gray-300 placeholder-neutral-500 text-neutral-800 focus:outline-none">
      </div>
      <div>
        <label class="block text-lg font-semibold mb-1">Round Time (seconds)</label>
        <input type="number" name="round_time" placeholder="e.g. 30" required
          class="w-full px-4 py-3 rounded-xl border border-gray-300 placeholder-neutral-500 text-neutral-800 focus:outline-none">
      </div>
      <button type="submit"
        class="w-full bg-gradient-to-r from-green-500 to-green-600 text-white font-bold py-4 rounded-xl hover:scale-105 transition transform duration-300">
        🚀 Create Room
      </button>
    </form>
  </div>

</body>
</html>
