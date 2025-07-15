// Modal elements
const createRoomBtn = document.getElementById('createRoomBtn');
const joinRoomBtn = document.getElementById('joinRoomBtn');
const modal = document.getElementById('createRoomModal');
const modalContent = document.getElementById('modalContent');
const closeModal = document.getElementById('closeModal');

// Show Create Room modal
createRoomBtn.addEventListener('click', function () {
  modal.classList.remove('hidden');
  setTimeout(() => {
    modalContent.classList.add('show');
  }, 10);
});

// Close Create Room modal
function closeModalFunction() {
  modalContent.classList.remove('show');
  setTimeout(() => {
    modal.classList.add('hidden');
  }, 500);
}
closeModal.addEventListener('click', closeModalFunction);
modal.addEventListener('click', function (e) {
  if (e.target === modal) {
    closeModalFunction();
  }
});

// Close on Escape key for Create Room
document.addEventListener('keydown', function (e) {
  if (e.key === 'Escape' && !modal.classList.contains('hidden')) {
    closeModalFunction();
  }
});

// ----------------------------
// Join Room logic starts here
// ----------------------------
const joinRoomModal = document.getElementById('joinRoomModal');
const closeJoinModal = document.getElementById('closeJoinModal');
const joinRoomForm = document.getElementById('joinRoomForm');

joinRoomBtn.addEventListener('click', () => {
  joinRoomModal.classList.remove('hidden');
  setTimeout(() => {
    joinRoomModal.querySelector('.modal-slide').classList.add('show');
  }, 10);
});

function closeJoinRoomModal() {
  joinRoomModal.querySelector('.modal-slide').classList.remove('show');
  setTimeout(() => {
    joinRoomModal.classList.add('hidden');
  }, 500);
}
closeJoinModal.addEventListener('click', closeJoinRoomModal);

// Handle join form submit
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
