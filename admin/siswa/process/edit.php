<?php

include '../../../database/connection.php';
session_start();

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    function updateData($id, $name, $nis, $phone, $id_class, $jenis_kelamin, $tanggal_lahir, $alamat, $nisn) {
        try {
            $connection = (new Connection)->getConnection();

            $sql = "UPDATE siswa SET 
                name = :name,
                nis = :nis,
                nisn = :nisn,
                phone = :phone,
                id_class = :id_class,
                jenis_kelamin = :jenis_kelamin,
                tanggal_lahir = :tanggal_lahir,
                alamat = :alamat
                WHERE id = :id";

            $statement = $connection->prepare($sql);

            $statement->bindParam(':id', $id);
            $statement->bindParam(':name', $name);
            $statement->bindParam(':nis', $nis);
            $statement->bindParam(':nisn', $nisn);
            $statement->bindParam(':phone', $phone);
            $statement->bindParam(':id_class', $id_class);
            $statement->bindParam(':jenis_kelamin', $jenis_kelamin);
            $statement->bindParam(':tanggal_lahir', $tanggal_lahir);
            $statement->bindParam(':alamat', $alamat);

            $statement->execute();
            
            return true; // Update successful
        } catch (Exception $e) {
            return throw $e;
            // return false; // Update failed
        }
    }
  $id = $_POST['id'];
    $name = $_POST['name'];
    $nis = $_POST['nis'];
    $nisn = $_POST['nisn'];
    $phone = $_POST['phone'];
    $id_class = $_POST['id_class'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $tanggal_lahir = $_POST['tanggal_lahir'];
    $alamat = $_POST['alamat'];

    if (updateData($id, $name, $nis, $phone, $id_class, $jenis_kelamin, $tanggal_lahir, $alamat, $nisn)) {
        setFlashMessage("Silahkan check data tersebut", 'Berhasil update data siswa!', "success","Ok");
        header("Location: ../index.php"); 
    } else {
        setFlashMessage("Gagal", 'Gagal edit siswa!', "error","Ok");
        // redirect('../index.php');
    }
}else{
    redirect('../load.php');
}


