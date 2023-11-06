<?php

include '../database/connection.php';
session_start();
$connection = (new Connection())->getConnection();


if($connection && isset($_POST['name']) && isset($_POST['nis']) && isset($_POST['tanggal_lahir']) && isset($_POST['alamat']) && isset($_POST['class']) ){
    try {
        $sql = "INSERT INTO `pendaftaran` (`name`, `nis`, `tanggal_lahir`, `alamat`, `phone`, `class`, `jenis_kelamin`, `asal_sekolah`) VALUES (:name, :nis, :tanggal_lahir, :alamat, :phone, :class, :jenis_kelamin, :asal_sekolah)";
        $statement = $connection->prepare($sql);
        $statement->bindParam(':name', $_POST['name']);
        $statement->bindParam(':nis', $_POST['nis']);
        $statement->bindParam(':tanggal_lahir', $_POST['tanggal_lahir']);
        $statement->bindParam(':alamat', $_POST['alamat']);
        $statement->bindParam(':phone', $_POST['phone']);
        $statement->bindParam(':class', $_POST['class']);
        $statement->bindParam(':jenis_kelamin', $_POST['jenis_kelamin']);
        $statement->bindParam(':asal_sekolah', $_POST['asal_sekolah']);        
        $statement->execute();  
        
        if ($statement->rowCount() > 0) {
            setFlashMessage("Silahkan check data tersebut", 'Berhasil menambahkan data siswa!', "success","Ok");
            redirect('../index.php');
        } else {
            setFlashMessage("Silahkan coba lagi", 'Maaf gagal menambahkan data siswa!', "error", "Coba lagi");
            redirect('../index.php');
        }
    } catch (\Throwable $th) {
        throw $th;
    }
}else{
    header("Location:../index.php");
}