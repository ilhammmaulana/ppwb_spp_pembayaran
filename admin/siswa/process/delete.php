<?php
include '../../../database/connection.php';
session_start();

if($_SERVER['REQUEST_METHOD']){
    try {
        $connection = (new Connection())->getConnection();
        $id = base64_decode($_POST['id']);
        $sql = "DELETE FROM siswa WHERE id = :id";
        $stmt = $connection->prepare($sql);
        $stmt->bindParam(":id", $id); 
        $stmt->execute();
                setFlashMessage("Trimakasih", 'Berhasil menghapus !', "success","Ok");
        redirect('../index.php');
    } catch (\Throwable $th) {
        throw $th;
    }
}