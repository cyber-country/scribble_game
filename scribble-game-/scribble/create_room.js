// === Generate Numeric Room Code ===
function generateRoomCode(length = 6) {
  const digits = "0123456789";
  let result = "";
  for (let i = 0; i < length; i++) {
    result += digits.charAt(Math.floor(Math.random() * digits.length));
  }
  return result;
}

// Set generated code on page load
document.getElementById("roomCode").value = generateRoomCode();

// === Copy Room Code to Clipboard ===
const copyBtn = document.getElementById("copyRoomCodeBtn");
if (copyBtn) {
  copyBtn.addEventListener("click", () => {
    const roomCode = document.getElementById("roomCode").value;
    navigator.clipboard.writeText(roomCode).then(() => {
      copyBtn.textContent = "✅";
      setTimeout(() => {
        copyBtn.textContent = "📋";
      }, 1500);
    });
  });
}

// === Start Game Function ===
function startGame() {
  const code = document.getElementById("roomCode").value;
  const roomName = document.getElementById("roomName").value;
  const password = document.getElementById("roomPassword").value;
  const roundCount = document.getElementById("roundCount").value;
  const duration = document.getElementById("roundDuration").value;
  const hostName = document.getElementById("hostName").value;

  // Validate all fields
  if (!roomName || !code || !password || !roundCount || !duration || !hostName) {
    alert("Please fill in all fields.");
    return;
  }

  // Optional: validate password is numeric
  if (isNaN(password)) {
    alert("Room password must be numeric.");
    return;
  }

  // Redirect to waiting_room.html with all query parameters
  const url = `waiting_room.html?room=${code}&roomName=${encodeURIComponent(roomName)}&password=${encodeURIComponent(password)}&rounds=${roundCount}&duration=${duration}&name=${encodeURIComponent(hostName)}`;

  window.location.href = url;
}
