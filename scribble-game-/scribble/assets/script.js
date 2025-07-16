// ================= Modal Handling =================
const createRoomBtn = document.getElementById('createRoomBtn');
const joinRoomBtn = document.getElementById('joinRoomBtn');
const modal = document.getElementById('createRoomModal');
const modalContent = document.getElementById('modalContent');
const closeModal = document.getElementById('closeModal');

// Show Create Room modal (not used anymore if you go to separate page)
createRoomBtn.addEventListener('click', function () {
  window.location.href = './admin/dashboard.php'; // Updated to go to new page
});

// Close modal (if modal still exists in code)
function closeModalFunction() {
  modalContent.classList.remove('show');
  setTimeout(() => {
    modal.classList.add('hidden');
  }, 500);
}
closeModal?.addEventListener('click', closeModalFunction);
modal?.addEventListener('click', function (e) {
  if (e.target === modal) {
    closeModalFunction();
  }
});

// Close on Escape key
document.addEventListener('keydown', function (e) {
  if (e.key === 'Escape' && !modal.classList.contains('hidden')) {
    closeModalFunction();
  }
});

// ================= Join Room Modal =================
const joinRoomModal = document.getElementById('joinRoomModal');
const closeJoinModal = document.getElementById('closeJoinModal');
const joinRoomForm = document.getElementById('joinRoomForm');

joinRoomBtn.addEventListener('click', () => {
  window.location.href = "join_room_list.html"; // ← new direct flow
});

function closeJoinRoomModal() {
  joinRoomModal.querySelector('.modal-slide').classList.remove('show');
  setTimeout(() => {
    joinRoomModal.classList.add('hidden');
  }, 500);
}
closeJoinModal.addEventListener('click', closeJoinRoomModal);

joinRoomForm.addEventListener('submit', function (e) {
  e.preventDefault();
  const roomCode = document.getElementById('joinRoomCode').value.trim();
  const roomName = document.getElementById('joinRoomName').value.trim();
  const userName = document.getElementById('joinUserName').value.trim();

  if (roomCode && roomName && userName) {
    window.location.href = `game.html?room=${encodeURIComponent(roomCode)}&roomName=${encodeURIComponent(roomName)}&name=${encodeURIComponent(userName)}`;
  } else {
    alert('Please fill in all fields.');
  }
});

// ================= Copy Room Code Logic =================
function generateRoomCode(length = 6) {
  const chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
  let result = '';
  for (let i = 0; i < length; i++) {
    result += chars.charAt(Math.floor(Math.random() * chars.length));
  }
  return result;
}

const copyBtn = document.getElementById('copyRoomCodeBtn');
if (copyBtn) {
  copyBtn.addEventListener('click', () => {
    const roomCode = document.getElementById('roomCode').value;
    navigator.clipboard.writeText(roomCode).then(() => {
      copyBtn.textContent = '✅';
      setTimeout(() => (copyBtn.textContent = '📋'), 1500);
    });
  });
}