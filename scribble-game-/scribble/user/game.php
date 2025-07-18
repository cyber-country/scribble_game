<?php include './includes/header.php'; ?>

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

<?php include './includes/footer.php'; ?>