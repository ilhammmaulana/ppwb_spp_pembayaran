<?php
require_once './database/connection.php';

$connection = (new Connection())->getConnection();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $nis = $_POST['nis'];
    $phone = $_POST['phone'];
    $class = $_POST['class'];
    $jenis_kelamin = $_POST['jenis_kelamin'];

    // Insert data into database
    $query = "INSERT INTO siswa (name, nis, phone, class, jenis_kelamin)
              VALUES (?, ?, ?, ?, ?)";
    $stmt = $connection->prepare($query);
    $stmt->bind_param("sssss", $name, $nis, $phone, $class, $jenis_kelamin);
    $stmt->execute();
    $stmt->close();

    header('Location: index.php');
    exit();
}

?>
