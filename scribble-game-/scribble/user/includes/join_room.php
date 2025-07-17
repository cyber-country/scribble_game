
<?php
include 'includes/db.php';

if (isset($_GET['room'])) {

    $room = intval($_GET['room']);

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['join_room'])) {
        $room_code = rand(10000, 99999);
        $room_name = $_POST['room_name'];
        $total_time = (int)$_POST['total_time'];
        $round_time = (int)$_POST['round_time'];
        
        $sql = "INSERT INTO rooms 
                (room_code, room_name, total_time, round_time, game_started, end_time) 
                VALUES 
                ('$room_code', '$room_name', $total_time, $round_time, 1, NOW()-($total_time * 60))";

        if (mysqli_query($conn, $sql)) {
            echo "<script>alert('Room created successfully with code: $room_code');</script>";
            header("Location: dashboard.php?success=1&code=$room_code");
            exit();
        } else {
            echo "<script>alert('Error: " . mysqli_error($conn) . "');</script>";
        }
    }
} else {
    echo "No room_id provided.";
}
/*
    0 - Ended Phase
    1 - Waiting Phase
    2 - Started Phase
*/
?>

<!-- Modal Background -->
<div id="<?php echo $room; ?>" class="fixed inset-0 bg-black bg-opacity-80 hidden items-center justify-center z-50">
<!-- <div id="myModal" class="g-gradient-to-br from-gray-800 to-black p-8 rounded-3xl shadow-2xl w-full max-w-xl border-4 border-yellow-400 scribble-border"> -->
  <!-- Modal Box -->
  <!-- <div class="bg-white rounded-lg shadow-lg max-w-md w-full p-6 relative"> -->
  <div class="bg-gray-800 g-gradient-to-br from-gray-800 to-white p-8 rounded-3xl shadow-2xl w-full max-w-xl border-4 border-yellow-400 scribble-border">
    <!-- <h2 class="text-xl font-bold mb-4">Create Room</h2> -->
    
    <h1 class="text-yellow-300 pb-10 text-3xl font-bold mb-2 text-center">🛠️ Join the Room</h1>

    <form method="POST">

      <!-- Room Name -->
      <div class="mb-5">
        <label class="block mb-2 font-bold text-lg">Room Name:</label>
        <input required
          name="room_name"
          type="text"
          id="roomName"
          value="<?php echo $room ? htmlspecialchars($room) : ''; ?>"
          class="w-full bg-purple-900 border-3 border-purple-500 text-white font-bold px-4 py-3 rounded-xl focus:outline-none focus:border-purple-300 text-lg placeholder-white"
        >
      </div>

      <!-- Total Rounds -->
      <div class="mb-5">
        <label class="block mb-2 font-bold text-lg">Total Gameplay Time:</label>
        <input required
          name="total_time"
          type="number"
          id="roundCount"
          placeholder="in minutes"
          min="1"
          max="120"
          class="w-full bg-orange-900 border-3 border-orange-500 text-white font-bold px-4 py-3 rounded-xl focus:outline-none focus:border-orange-300 text-lg placeholder-white appearance-none"
        >
      </div>

      <!-- Total Rounds -->
      <div class="mb-5">
        <label class="block mb-2 font-bold text-lg">Per Round Time:</label>
        <input required
          name="round_time"
          type="number"
          id="roundCount"
          placeholder="in seconds"
          min="1"
          max="200"
          inputmode="numeric"
          class="w-full bg-orange-900 border-3 border-orange-500 text-white font-bold px-4 py-3 rounded-xl focus:outline-none focus:border-orange-300 text-lg placeholder-white appearance-none"
        >
      </div>

      <!-- Close Button -->
      <button onclick="closeModal(<?php echo $room ?>)" class="absolute top-2 right-2 text-red-500 hover:text-red-500 text-2xl">
        &times;
      </button>

      <!-- Action Button -->
      <!-- <button onclick="closeModal()" class="mt-4 px-4 py-2 bg-red-600 text-white rounded hover:bg-green-700">
        Close
      </button> -->
      <button type="submit" name="join_room" class="mt-4 px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">
        Add
      </button>
    </form>

  </div>

</div>
