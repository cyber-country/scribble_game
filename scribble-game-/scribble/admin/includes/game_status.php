<?php
// connect to database
include 'db.php';

if (isset($_GET['room']) && isset($_GET['status'])) {

    $room = intval($_GET['room']);
    $status = intval($_GET['status']);

    if ($status === 1) {
        // Update the room status to 'active'
        $stmt = $conn->prepare("UPDATE rooms SET game_started = 2 WHERE room_code = ?");
        $stmt->bind_param("i", $room);
    } else {
        // Update the room status to 'inactive'
        $stmt = $conn->prepare("UPDATE rooms SET game_started = 0 WHERE room_code = ?");
        $stmt->bind_param("i", $room);
    }

    // Update game_started status (e.g., 1 = started)
    // $stmt = $conn->prepare("UPDATE rooms SET game_started = 1 WHERE id = ?"); 

    if ($stmt->execute()) {
        // redirect to the game or a success page
        header("Location: ../dashboard.php");
        exit();
    } else {
        echo "Failed to update game status.";
    }

    $stmt->close();
} else {
    echo "No room_id provided.";
}

$conn->close();
?>
