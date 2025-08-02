<?php
require_once "./includes/db.php";

$room_code = isset($_GET['room_code']) ? intval($_GET['room_code']) : 0;

// Get room name
$room_query = $conn->prepare("SELECT room_name FROM rooms WHERE room_code = ?");
$room_query->bind_param("i", $room_code);
$room_query->execute();
$room_query->bind_result($room_name);
$room_query->fetch();
$room_query->close();

if (!$room_name) {
    echo "<script>alert('Room not found'); window.location.href='index.php';</script>";
    exit;
}

// Get players and scores
$players_result = $conn->prepare("SELECT player_name, score FROM players WHERE room_id = ?");
$players_result->bind_param("i", $room_code);
$players_result->execute();
$players_result->bind_result($player_name, $score);
$players = [];
while ($players_result->fetch()) {
    $players[] = ["name" => $player_name, "score" => $score];
}
$players_result->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
  <title>Scribble Game Arena</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@400;600;700&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Fredoka', sans-serif;
      overflow-x: hidden;
      min-height: 100vh;
      display: flex;
      flex-direction: column;
    }
    .scribble-bg {
      background: url('assets/scribblemain.png') center center fixed;
      background-size: cover;
      background-repeat: repeat;
    }
    @keyframes float { 0%, 100% { transform: translateY(0); } 50% { transform: translateY(-10px); } }
    .float-animation { animation: float 4s ease-in-out infinite; }
    @keyframes wiggle { 0%, 100% { transform: rotate(-2deg); } 50% { transform: rotate(2deg); } }
    .wiggle-animation { animation: wiggle 3s ease-in-out infinite; }
  </style>
</head>

<body class="text-neutral-800 scribble-bg relative">
  <!-- Floating Doodles -->
  <div class="absolute inset-0 z-0 pointer-events-none">
    <div class="absolute top-10 left-10 text-5xl float-animation">✏️</div>
    <div class="absolute top-1/3 right-1/4 text-4xl wiggle-animation">🎨</div>
    <div class="absolute bottom-1/4 left-1/3 text-5xl float-animation">📝</div>
    <div class="absolute bottom-10 right-10 text-3xl wiggle-animation">🖍️</div>
  </div>

  <!-- Header -->
  <header class="bg-yellow-400 p-6 text-center shadow-xl relative z-10">
    <h1 class="text-3xl sm:text-4xl font-black text-neutral-800 tracking-wide drop-shadow">
      🎮 Scribble Game Arena - <?php echo htmlspecialchars($room_name); ?> (<?php echo $room_code; ?>)
    </h1>
  </header>

  <!-- Game Box -->
  <main class="relative z-10 flex justify-center items-center p-4">
    <div class="w-11/12 sm:w-10/12 md:w-4/5 lg:w-3/4 xl:w-2/3 
                backdrop-blur-xl bg-white/60 border-2 border-white 
                rounded-3xl shadow-2xl p-6 flex flex-col lg:flex-row gap-6">

      <!-- Canvas Area -->
      <div class="flex flex-col flex-1 items-center gap-4">
        <div class="flex flex-wrap gap-4 justify-center">
          <input type="color" id="colorPicker" value="#000000" class="w-16 h-12 border-4 border-purple-500 bg-purple-100 rounded-xl">
          <input type="range" id="brushSize" min="1" max="20" value="3" class="w-40 h-2 bg-orange-300 border-4 border-orange-500 rounded-xl">
          <button onclick="clearCanvas()" class="bg-yellow-400 hover:bg-yellow-500 text-black font-bold px-4 py-2 rounded-xl shadow">🧽 Clear</button>
        </div>
        <canvas id="canvas" 
                class="w-full max-w-[650px] aspect-[4/3] bg-white rounded-xl border-4 border-yellow-400 shadow-lg">
        </canvas>
        <div class="flex flex-wrap justify-center gap-4 mt-2 w-full">
          <div class="bg-yellow-400 text-black font-bold text-lg px-6 py-3 rounded-xl border-4 border-white min-w-[200px] text-center">
            🔍 Hint: <span id="hintDisplay">_ _ _ _ _</span>
          </div>
          <div class="bg-yellow-400 text-black font-bold text-lg px-6 py-3 rounded-xl border-4 border-white min-w-[200px] text-center">
            ⏳ Time: <span id="timeLeft">30</span> sec
          </div>
        </div>
      </div>

      <!-- Chat Area -->
      <div class="bg-white/70 backdrop-blur-xl border-4 border-blue-300 rounded-3xl p-4 w-full max-w-md flex flex-col">
        <h3 class="text-blue-800 text-2xl font-bold mb-2 text-center">💬 Chat & Guess</h3>
        <div id="chatMessages" class="flex-1 bg-white text-black rounded-xl p-3 mb-3 overflow-y-auto border-2 border-blue-300 h-60 space-y-2">
          <div class="flex justify-center">
            <div class="bg-gray-400 text-black px-4 py-2 rounded-xl text-sm shadow">
              System: Game starting soon...
            </div>
          </div>
          <?php foreach ($players as $p): ?>
            <div class="flex justify-between bg-blue-100 px-3 py-1 rounded">
              <span><?php echo htmlspecialchars($p['name']); ?></span>
              <span><?php echo $p['score']; ?> pts</span>
            </div>
          <?php endforeach; ?>
        </div>
        <div class="flex w-full">
          <input type="text" id="chatInput" placeholder="Type your guess..." class="flex-1 bg-blue-900 text-white placeholder-white font-bold px-4 py-2 rounded-l-xl border-2 border-blue-400 focus:outline-none">
          <button onclick="sendChat()" class="bg-yellow-400 hover:bg-yellow-500 text-black font-bold px-4 py-2 rounded-r-xl">Send</button>
        </div>
      </div>
    </div>
  </main>

  <!-- Leaderboard -->
  <div id="leaderboardModal" class="fixed inset-0 bg-black bg-opacity-70 flex justify-center items-center z-50 hidden">
    <div class="bg-white/80 backdrop-blur-xl p-8 rounded-3xl shadow-2xl border-4 border-yellow-400 w-full max-w-xl text-center">
      <h2 class="text-yellow-500 text-3xl font-bold mb-4">🏆 Leaderboard</h2>
      <ul id="leaderboardList" class="text-neutral-800 space-y-2 text-lg font-semibold"></ul>
      <button onclick="closeLeaderboard()" class="mt-6 bg-yellow-400 hover:bg-yellow-500 text-black px-6 py-2 rounded-xl font-bold shadow">Close</button>
    </div>
  </div>

  <!-- Footer -->
  <footer class="bg-black text-yellow-400 text-center py-3 mt-auto relative z-10">
    Created by BCA Team
    <div id="typingNames" class="text-white font-bold mt-1" style="min-height: 1.5rem;"></div>
  </footer>

  <script>
    // Canvas Resizing
    const canvas = document.getElementById("canvas");
    const ctx = canvas.getContext("2d");
    let drawing = false;

    function resizeCanvas() {
      const containerWidth = canvas.clientWidth;
      canvas.width = containerWidth;
      canvas.height = containerWidth * 0.75; // 4:3 aspect
    }
    resizeCanvas();
    window.addEventListener("resize", resizeCanvas);

    canvas.addEventListener("mousedown", e => { drawing = true; ctx.beginPath(); ctx.moveTo(e.offsetX, e.offsetY); });
    canvas.addEventListener("mousemove", e => {
      if (!drawing) return;
      ctx.lineTo(e.offsetX, e.offsetY);
      ctx.strokeStyle = document.getElementById("colorPicker").value;
      ctx.lineWidth = document.getElementById("brushSize").value;
      ctx.lineCap = "round";
      ctx.stroke();
    });
    canvas.addEventListener("mouseup", () => drawing = false);
    canvas.addEventListener("mouseleave", () => drawing = false);

    function clearCanvas() { ctx.clearRect(0, 0, canvas.width, canvas.height); }

    // Chat
    function sendChat() {
      const input = document.getElementById('chatInput');
      if (!input.value.trim()) return;
      const chatBox = document.getElementById('chatMessages');
      const msgWrapper = document.createElement('div');
      msgWrapper.className = "flex justify-end";
      const bubble = document.createElement('div');
      bubble.className = "bg-green-500 text-white px-4 py-2 rounded-xl max-w-xs break-words shadow-md";
      bubble.textContent = input.value;
      msgWrapper.appendChild(bubble);
      chatBox.appendChild(msgWrapper);
      input.value = '';
      chatBox.scrollTop = chatBox.scrollHeight;
    }

    // Typewriter
    const typingNames = ["Rohit Pandit", "R Santoshwaran", "Bhumi Ghosh", "Dristi Sarkar", "Faculty: Mr. Tanmoy Ghosh"];
    const typingDiv = document.getElementById("typingNames");
    let nameIndex = 0, charIndex = 0, isDeleting = false;

    function typeNames() {
      const currentName = typingNames[nameIndex];
      if (!isDeleting) {
        typingDiv.textContent = currentName.substring(0, charIndex++);
        if (charIndex > currentName.length) {
          isDeleting = true;
          setTimeout(typeNames, 2000);
          return;
        }
      } else {
        typingDiv.textContent = currentName.substring(0, charIndex--);
        if (charIndex < 0) {
          isDeleting = false;
          nameIndex = (nameIndex + 1) % typingNames.length;
        }
      }
      setTimeout(typeNames, 100);
    }
    typeNames();
  </script>
</body>
</html>
