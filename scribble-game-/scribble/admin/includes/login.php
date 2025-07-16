<?php

session_start();
$correct_password = "admin123";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $entered = $_POST['password'] ?? '';
    if ($entered === $correct_password) {
        $_SESSION['admin'] = true;
        header("Location: ../dashboard.php");
        exit;
    } else {
        $error = "Incorrect password!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Create Room</title>
 <link rel="stylesheet" href="../../tailwind.min.css">
<link rel="stylesheet" href="../../assets/style.css"> 

</head>
<body class="bg-gray-950 text-white min-h-screen flex items-center justify-center p-6">

    <?php if (!empty($error)) echo "<p style='color:red;'>$error</p>"; ?>
    <form method="post" class="bg-gradient-to-br from-gray-800 to-black p-8 rounded-3xl shadow-2xl w-full max-w-xl border-4 border-yellow-400 scribble-border">
        <h1 class="title-font text-yellow-300 text-4xl mb-6 text-center">Admin Login</h1>

        <div class="mb-5">
            <label class="block mb-2 font-bold text-lg">Password:</label>
            <input type="password" name="password" required class="w-full text-white placeholder-white font-bold px-4 py-3 rounded-xl border-4 border-orange-500 bg-orange-900 focus:outline-none focus:border-orange-300 text-lg appearance-none"
        style="background-color: #7c2d12 !important; color: white !important;"/>
        </div>
        
        <button class="w-full bg-yellow-400 hover:bg-yellow-500 text-black font-bold py-4 rounded-xl transition-all duration-300">Login</button>
        <!-- <button type="submit">Login</button> -->
    </form>


    <!-- Room Name
<div class="mb-5">
  <label class="block mb-2 font-bold text-lg">Room Name:</label>
  <input
    type="text"
    id="roomName"
    
    
  >
</div>

<div class="mb-5">
  <label class="block mb-2 font-bold text-lg">Total Gameplay Time:</label>
  <input
    type="number"
    id="roundCount"
    placeholder="in minutes"
    min="1"
    max="20"
    class="w-full bg-orange-900 border-3 border-orange-500 text-white font-bold px-4 py-3 rounded-xl focus:outline-none focus:border-orange-300 text-lg placeholder-white appearance-none"
  >
</div>


<div class="mb-5">
  <label class="block mb-2 font-bold text-lg">Per Round Time:</label>
  <input
    type="number"
    id="roundCount"
    placeholder="in seconds"
    min="1"
    max="20"
    inputmode="numeric"
    class="w-full text-white placeholder-white font-bold px-4 py-3 rounded-xl border-4 border-orange-500 bg-orange-900 focus:outline-none focus:border-orange-300 text-lg appearance-none"
    style="background-color: #7c2d12 !important; color: white !important;"
  >
</div> -->

    <!-- Start Button -->
    

  <script src="./assets/script.js"></script>
</body>
</html>
