<?php

include '../../../database/connection.php';
session_start();
$connection = (new Connection())->getConnection();


if($connection && isset($_POST['name']) && isset($_POST['nis']) && isset($_POST['tanggal_lahir']) && isset($_POST['alamat']) && isset($_POST['id_class']) ){
    try {
        $sql = "INSERT INTO `siswa` (`name`, `nis`,`nisn`, `tanggal_lahir`, `alamat`, `phone`, `id_class`, `jenis_kelamin`) VALUES (:name, :nis, :nisn ,:tanggal_lahir, :alamat, :phone, :id_class, :jenis_kelamin )";
        $statement = $connection->prepare($sql);
        $statement->bindParam(':name', $_POST['name']);
        $statement->bindParam(':nis', $_POST['nis']);
        $statement->bindParam(':nisn', $_POST['nisn']);
        $statement->bindParam(':tanggal_lahir', $_POST['tanggal_lahir']);
        $statement->bindParam(':alamat', $_POST['alamat']);
        $statement->bindParam(':phone', $_POST['phone']);
        $statement->bindParam(':id_class', $_POST['id_class']);
        $statement->bindParam(':jenis_kelamin', $_POST['jenis_kelamin']);
        $statement->execute();  
        
        if ($statement->rowCount() > 0) {
            setFlashMessage("Silahkan check data tersebut", 'Berhasil menambahkan data siswa!', "success","Ok");
            redirect('../index.php');
        } else {
            // setFlashMessage("Silahkan coba lagi", 'Maaf gagal menambahkan data siswa!', "error", "Coba lagi");
            // redirect('../index.php');
        }
    } catch (\Throwable $th) {
        throw $th;
    }
}else{
    header("Location:../index.php");
}