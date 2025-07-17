<?php
include '../db.php';

// Fetch rooms where game_started is 1 or 2
$query = "SELECT * FROM rooms WHERE game_started = 1 ORDER BY created_at DESC";

$result = mysqli_query($conn, $query);
?>

<!-- Title -->
<h1 class="text-yellow-300 text-3xl font-bold mb-2 text-center">🎮 Active Game Rooms</h1>

    <?php if (mysqli_num_rows($result) > 0): ?>
       
        <ul class="space-y-4">
            <?php while ($room = mysqli_fetch_assoc($result)): ?>
                
                <!-- Display room details -->
                <li onclick="selectRoom($room['room_code'])" class="cursor-pointer room-card bg-yellow border-4 border-yellow-300 rounded-xl px-6 py-4">
                    <div class="flex justify-between items-center">
                        <div>
                            <h2 class="text-white font-bold text-xl"><?php echo htmlspecialchars($room['room_name']); ?></h2>
                            <p class="text-yellow-300 font-mono">Room Code: <span class="font-mono"><?php echo $room['room_code']; ?></span></p>
                            <p class="text-sm text-gray-300">
                            Total Time: <?php echo $room['total_time']; ?>s | Round Time: <?php echo $room['round_time']; ?>s
                            </p>
                           
                        </div>
                        <a onclick="join(<?php echo $room['room_code']; ?>)" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-700">
                            Join the Game
                        </a>
                    </div>
                </li>

            <?php endwhile; ?>
        </ul>
       
        
    <?php else: ?>
      <p class="text-gray-500">No active rooms found.</p>
    <?php endif; ?>
