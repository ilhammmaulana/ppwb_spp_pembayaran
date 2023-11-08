<?php
session_start();

require_once '../database/connection.php';
$connection = (new Connection())->getConnection();


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $databaseConnection = new Connection();
    $connection = $databaseConnection->getConnection();

    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = "SELECT * FROM admins WHERE email = :email";
    $stmt = $connection->prepare($query);
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user'] = $user;
        setFlashMessage("Password yang anda masukan benar!", 'Berhasil login', "success", "Oke");
        redirect('../admin/index.php');
    } else {
        setFlashMessage("Silahkan coba lagi", 'Maaf password atau email anda salah!', "error", "Coba lagi");
        redirect('./index.php');
    }
}else if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    header("Location: index.php");
    exit();
}
