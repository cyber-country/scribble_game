
<?php include './includes/header.php'; ?>
    
    <body class="bg-gray-950 text-white min-h-screen flex items-center justify-center p-6">
        
    <!-- Back to Home -->
    <div class="fixed top-0 left-0 w-full flex justify-between items-center p-4 bg-gray-800 shadow z-50">
                
        <!-- Button to main page -->
        <button onclick="back()" class="justify-start ms-4 px-4 py-2 bg-red-500 text-white rounded hover:bg-red-700"> Homepage </button>

    </div>

    <!-- Main Container -->
    <div class="bg-gradient-to-br from-gray-800 to-black p-8 rounded-3xl shadow-2xl w-full max-w-xl border-4 border-yellow-400 scribble-border">

        <!-- Room List Page -->
        <?php include './includes/rooms.php'; ?>

    </div>

    <!-- Include the modal from another file -->
    <?php // include './includes/join_room.php'; ?>

<?php include './includes/footer.php'; ?>
        