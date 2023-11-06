<?php

session_start();
 
if (!isset($_SESSION['user'])) {
    header("Location: ../login/index.php");
}
$email = $_SESSION['user']['email'];
$name = $_SESSION['user']['name'];
$word =  htmlspecialchars("Anda berhasil login ! Selamat datang " . $name ) ;    

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selamat datang <?= $name ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
</head>
<body>
    <div class="container mt-5">
    <h2 class="text-center"><?= $word ?></h2>
    <div class="d-flex gap-1">
    <a  href="siswa/" class="btn btn-info text-white">Daftar siswa</a>
    <a href="siswa/" class="btn btn-info text-white">Spp</a>
    
    <form action="logout.php">
        <button type="submit" class="btn btn-danger text-white">Logout</button>
    </form>
    </div>
    </div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>
</html>

