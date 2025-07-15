
function generateRoomCode(length = 6) {
  const digits = '0123456789';
  let result = '';
  for (let i = 0; i < length; i++) {
    result += digits.charAt(Math.floor(Math.random() * digits.length));
  }
  return result;
}


    document.getElementById("roomCode").value = generateRoomCode();

    document.getElementById("copyRoomCodeBtn").addEventListener("click", () => {
      const code = document.getElementById("roomCode").value;
      navigator.clipboard.writeText(code).then(() => {
        document.getElementById("copyRoomCodeBtn").textContent = "✅";
        setTimeout(() => {
          document.getElementById("copyRoomCodeBtn").textContent = "📋";
        }, 1500);
      });
    });
function startGame() {
  const code = document.getElementById("roomCode").value;
  const name = document.getElementById("hostName").value;
  const duration = document.getElementById("roundDuration").value;
  const roomName = document.getElementById("roomName").value;
  const password = document.getElementById("roomPassword").value;

  if (!name || !duration || !roomName || !password) {
    alert("Please fill in all fields including password.");
    return;
  }

  // Redirect to waiting room with all data
  window.location.href = `waiting_room.html?room=${code}&name=${encodeURIComponent(name)}&duration=${duration}&roomName=${encodeURIComponent(roomName)}&password=${encodeURIComponent(password)}`;
}
