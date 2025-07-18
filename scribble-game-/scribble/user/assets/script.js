// Redirect with both room name and code
function selectRoom(roomName, roomCode) {
    const url = `join_room.html?roomName=${encodeURIComponent(roomName)}&roomCode=${roomCode}`;
    window.location.href = url;
}

//basic room selection function
function back() {
  const home_url = `../index.html`;
  window.location.href = home_url;
}

//Modal Functions
function join_openModal(room) {
  document.getElementById(room).classList.remove('hidden');
  document.getElementById(room).classList.add('flex');
}

function join_closeModal(room) {
  document.getElementById(room).classList.remove('flex');
  document.getElementById(room).classList.add('hidden');
}

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
      { username: "@PaintWizard", score: 600 },
      { username: "@ArtNinja", score: 580 },
      { username: "@ScribbleKid", score: 500 },
    ];

    function renderLeaderboard(data) {
      const tbody = document.getElementById("leaderboardTable").querySelector("tbody");
      tbody.innerHTML = '';
      data.sort((a, b) => b.score - a.score).slice(0, 12).forEach((u, i) => {
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