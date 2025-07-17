// Redirect with both room name and code
function selectRoom(roomName, roomCode) {
    const url = `join_room.html?roomName=${encodeURIComponent(roomName)}&roomCode=${roomCode}`;
    window.location.href = url;
}

