<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Scribble Game - All-in-One</title>
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Baloo+2:wght@600&family=Press+Start+2P&display=swap');

:root {
  --yellow: #faff00;
  --neon-blue: #00f0ff;
  --hot-pink: #ff2cbe;
  --green: #00ff9d;
  --black: #000000;
  --white: #ffffff;
  --purple: #a100ff;
  --orange: #ff7a00;
  --bg-dark: #0e0e0e;
}

* {
  box-sizing: border-box;
}

body {
  font-family: 'Baloo 2', sans-serif;
  margin: 0;
  color: var(--white);
  background: linear-gradient(130deg, #0f0f0f, #1a1a1a);
  overflow-x: hidden;
}

header {
  background: linear-gradient(to right, var(--hot-pink), var(--yellow));
  color: var(--black);
  padding: 25px;
  text-align: center;
  box-shadow: 0 5px 20px var(--hot-pink);
  font-family: 'Press Start 2P', cursive;
  text-transform: uppercase;
}

header h1 {
  margin: 0;
  font-size: 1.3rem;
  text-shadow: 2px 2px #ff0066;
}

.header-info {
  margin-top: 15px;
  display: flex;
  justify-content: center;
  gap: 20px;
}

.timer-box,
.hint-box {
  padding: 10px 20px;
  border-radius: 10px;
  font-weight: bold;
  font-size: 0.9rem;
  box-shadow: 0 0 10px var(--neon-blue);
}

.timer-box {
  background: var(--green);
  color: var(--black);
}

.hint-box {
  background: var(--yellow);
  color: var(--black);
}

.main-container {
  display: grid;
  grid-template-columns: 260px 1fr 300px;
  gap: 20px;
  padding: 20px;
  color: var(--white);
}

.leaderboard {
  background: linear-gradient(160deg, #1e1e1e, #2e2e2e);
  border: 3px solid var(--neon-blue);
  border-radius: 12px;
  padding: 20px;
  box-shadow: 0 0 15px var(--neon-blue);
}

.leaderboard h2 {
  text-align: center;
  color: var(--hot-pink);
  font-size: 1rem;
  margin-bottom: 15px;
  font-family: 'Press Start 2P', cursive;
}

.leaderboard table {
  width: 100%;
  border-collapse: collapse;
  font-size: 0.9rem;
}

.leaderboard th,
.leaderboard td {
  border: 1px solid #444;
  padding: 8px;
  text-align: center;
}

.leaderboard th {
  background: linear-gradient(to right, var(--hot-pink), var(--purple));
  color: var(--white);
}

.canvas-area {
  display: flex;
  flex-direction: column;
  align-items: center;
}

canvas {
  border: 4px solid var(--hot-pink);
  background: var(--white);
  border-radius: 12px;
  box-shadow: 0 0 20px var(--hot-pink);
}

.tools {
  margin-top: 15px;
  display: flex;
  gap: 12px;
  align-items: center;
}

.tools input[type="color"] {
  border: none;
  width: 40px;
  height: 40px;
  cursor: pointer;
  border-radius: 50%;
  box-shadow: 0 0 10px var(--neon-blue);
}

.tools input[type="range"] {
  width: 100px;
}

.tools button {
  background: var(--hot-pink);
  color: var(--white);
  border: none;
  border-radius: 8px;
  padding: 8px 14px;
  font-weight: bold;
  font-size: 1rem;
  cursor: pointer;
  box-shadow: 0 0 8px var(--hot-pink);
  transition: all 0.3s ease;
}

.tools button:hover {
  background: var(--purple);
  transform: scale(1.1);
}

.guess-area {
  margin-top: 20px;
  width: 100%;
}

.guess-area input {
  width: 100%;
  padding: 12px;
  font-size: 1rem;
  border-radius: 10px;
  border: 3px solid var(--neon-blue);
  background: #0e0e0e;
  color: var(--white);
  box-shadow: 0 0 12px var(--neon-blue);
}

.chat-box {
  background: linear-gradient(160deg, #1a1a1a, #2e2e2e);
  border: 3px solid var(--green);
  box-shadow: 0 0 15px var(--green);
  border-radius: 12px;
  padding: 15px;
  display: flex;
  flex-direction: column;
}

.chat-box h3 {
  text-align: center;
  color: var(--yellow);
  font-family: 'Press Start 2P', cursive;
  margin-bottom: 10px;
}

.chat-messages {
  flex: 1;
  height: 250px;
  overflow-y: auto;
  background: #111;
  border: 1px solid #444;
  padding: 10px;
  margin-bottom: 12px;
  border-radius: 8px;
  color: #fff;
  font-size: 0.9rem;
}

.chat-input-container {
  display: flex;
  align-items: center;
}

.chat-box input {
  flex: 1;
  padding: 10px;
  background: #000;
  color: var(--yellow);
  border: 2px solid var(--yellow);
  border-radius: 8px;
  font-size: 1rem;
}

.chat-box button {
  background: var(--yellow);
  color: #000;
  font-weight: bold;
  border: none;
  padding: 10px 16px;
  margin-left: 10px;
  cursor: pointer;
  border-radius: 8px;
  transition: 0.3s ease;
  box-shadow: 0 0 10px var(--yellow);
}

.chat-box button:hover {
  background: var(--hot-pink);
  color: #fff;
  transform: scale(1.05);
}

  </style>
</head>
<body>


  <!-- ===== Header ===== -->
  <header>
    <h1>🎮 Scribble Game Arena</h1>
    <div class="header-info">
      <div class="timer-box">⏳ Time Left: <span id="timer">30s</span></div>
      <div class="hint-box">🔍 Hint: <span id="hintDisplay">_ _ _ _ _</span></div>
    </div>
  </header>

  <!-- ===== Main Content ===== -->
  <div class="main-container">

    <!-- Leaderboard -->
    <div class="leaderboard">
      <h2>🏆 Leaderboard</h2>
      <table id="leaderboardTable">
        <thead>
          <tr>
            <th>#</th>
            <th>Player</th>
            <th>Score</th>
          </tr>
        </thead>
        <tbody></tbody>
      </table>
    </div>

    <!-- Canvas Drawing Area -->
    <div class="canvas-area">
      <canvas id="canvas" width="700" height="450"></canvas>
      <div class="tools">
        <input type="color" id="colorPicker" value="#000000" />
        <input type="range" id="brushSize" min="1" max="20" value="3" />
        <button onclick="clearCanvas()">🧽 Clear</button>
      </div>
      <div class="guess-area">
        <input type="text" placeholder="Type your guess here..." />
      </div>
    </div>

    <!-- Chat Section -->
    <div class="chat-box">
      <h3>💬 Chat</h3>
      <div class="chat-messages" id="chatMessages">
        <div><strong>System:</strong> Game starting soon...</div>
      </div>
      <div class="chat-input-container">
        <input type="text" id="chatInput" placeholder="Type a message...">
        <button onclick="sendChat()">Send</button>
      </div>
    </div>

  </div>

  <!-- ===== Scripts ===== -->
  <script>
    // ===== Drawing Functionality =====
    const canvas = document.getElementById('canvas');
    const ctx = canvas.getContext('2d');
    let drawing = false;
    const colorPicker = document.getElementById('colorPicker');
    const brushSize = document.getElementById('brushSize');

    canvas.addEventListener('mousedown', (e) => {
      drawing = true;
      ctx.beginPath();
      ctx.moveTo(e.offsetX, e.offsetY);
    });

    canvas.addEventListener('mousemove', (e) => {
      if (!drawing) return;
      ctx.lineTo(e.offsetX, e.offsetY);
      ctx.strokeStyle = colorPicker.value;
      ctx.lineWidth = brushSize.value;
      ctx.lineCap = 'round';
      ctx.stroke();
    });

    canvas.addEventListener('mouseup', () => drawing = false);
    canvas.addEventListener('mouseleave', () => drawing = false);

    function clearCanvas() {
      ctx.clearRect(0, 0, canvas.width, canvas.height);
    }

    // ===== Chat System =====
    function sendChat() {
      const input = document.getElementById('chatInput');
      const msg = input.value.trim();
      if (!msg) return;
      const chatBox = document.getElementById('chatMessages');
      const div = document.createElement('div');
      div.innerHTML = `<strong>You:</strong> ${msg}`;
      chatBox.appendChild(div);
      input.value = '';
      chatBox.scrollTop = chatBox.scrollHeight;
    }

    // ===== Timer =====
    let time = 30;
    const timerSpan = document.getElementById("timer");
    const countdown = setInterval(() => {
      time--;
      timerSpan.textContent = `${time}s`;
      if (time <= 0) {
        clearInterval(countdown);
        timerSpan.textContent = "⏱️ Time's Up!";
      }
    }, 1000);

    // ===== Hint Reveal =====
    const word = "apple";
    const revealed = [false, false, true, false, false];

    function updateHint() {
      const hint = word
        .split("")
        .map((char, i) => (revealed[i] ? char.toUpperCase() : "_"))
        .join(" ");
      document.getElementById("hintDisplay").textContent = hint;
    }

    updateHint();

    // ===== Leaderboard =====
    const users = [
      { username: "@TopPlayer", score: 1200 },
      { username: "@SketchQueen", score: 1100 },
      { username: "@DoodleKing", score: 950 },
      { username: "@Brushie", score: 875 },
      { username: "@ColorSplash", score: 840 },
      { username: "@PixelPenguin", score: 780 },
      { username: "@LineMaster", score: 720 },
      { username: "@Inkling", score: 690 },
      { username: "@DrawDragon", score: 650 },
      { username: "@PaintWizard", score: 600 },
      { username: "@ArtNinja", score: 580 },
      { username: "@ScribbleKid", score: 500 },
    ];

    function renderLeaderboard(data) {
      const tbody = document.getElementById("leaderboardTable").querySelector("tbody");
      tbody.innerHTML = '';
      data.sort((a, b) => b.score - a.score).slice(0, 10).forEach((u, i) => {
        const tr = document.createElement("tr");
        tr.innerHTML = `
          <td>${i + 1}</td>
          <td>${u.username}</td>
          <td>${u.score}</td>
        `;
        tbody.appendChild(tr);
      });
    }

    setInterval(() => {
      users.forEach(u => {
        u.score += Math.floor(Math.random() * 6);
      });
      renderLeaderboard(users);
    }, 4000);

    renderLeaderboard(users);
  </script>
</body>
</html>
