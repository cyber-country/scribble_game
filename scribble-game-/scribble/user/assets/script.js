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