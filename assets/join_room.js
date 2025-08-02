// Pre-fill room name from URL
const params = new URLSearchParams(window.location.search);
const roomName = params.get("roomName");

if (roomName) {
  document.getElementById("roomName").value = roomName;
}

// Join Room button click
function joinRoom() {
  const code = document.getElementById("roomCode").value;
  const player = document.getElementById("playerName").value;

  if (!code || !player || code.length !== 6) {
    alert("Please enter a 6-digit room code and your name.");
    return;
  }

  // Redirect to waiting room with parameters
  window.location.href = `waiting_room.html?room=${code}&name=${encodeURIComponent(player)}&roomName=${encodeURIComponent(roomName)}`;
}

// TODO: In backend, verify room existence, validate code, and join session
