
<?php include './includes/header.php'; ?>
<?php
// if (isset($_GET['success']) && isset($_GET['code'])) {
//     echo "<script>alert('Room created successfully! Room Code: " . $_GET['code'] . "');</script>";
// }
?>
    <!-- Back to Home -->
    <div class="fixed top-0 left-0 w-full flex justify-between items-center p-4 bg-gray-800 shadow z-50">
                
        <!-- Button to open the modal -->
        <button onclick="logout()" class="justify-start ms-4 px-4 py-2 bg-red-500 text-white rounded hover:bg-red-700">🚪 Logout </button>
                
        <!-- Button to open the modal -->
        <button onclick="openModal()" class="justify-end ms-4 px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Create New Room </button>

    </div>

        <!-- Main Container -->
        <div class="bg-gradient-to-br from-gray-800 to-black p-8 pt-20 rounded-3xl shadow-2xl w-full max-w-xl border-4 border-yellow-400 scribble-border">

            <!-- Room List Page -->
            <?php include './includes/list_room.php'; ?>

            <!-- Include the modal from another file -->
            <?php include './includes/create_room.php'; ?>

        </div>

<?php include './includes/footer.php'; ?>
        