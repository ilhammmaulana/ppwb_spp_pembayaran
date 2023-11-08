<?php
include '../../database/connection.php';
$connection = (new Connection())->getConnection();  
$sqlMonths = "SELECT * FROM months";
$sqlGetPembayaran = "SELECT pembayaran.id , pembayaran.tgl_bayar, pembayaran.created_at, siswa.name, pembayaran.tahun_bayar, months.name as month_name,pembayaran.jumlah_bayar, pembayaran.created_at,  class.name AS classname 
FROM pembayaran 
LEFT JOIN siswa ON pembayaran.id_siswa = siswa.id
LEFT JOIN class ON siswa.id_class = class.id
LEFT JOIN months ON siswa.id_class = months.id";
$months = $connection->query($sqlMonths)->fetchAll(PDO::FETCH_ASSOC);
$data = $connection->query($sqlGetPembayaran)->fetchAll(PDO::FETCH_ASSOC);
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SPP pembayaran</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>
    <div class="container mt-5">
        <h2>SPP Pembayaran</h2>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addSiswaModal">
            Catat pembayaran spp
        </button>
        <a href="../siswa" class="btn btn-info text-white">Tambah siswa</a>
        <a href="../index.php" class="btn btn-info text-white">Back to dashboard</a>
   <div class="mt-3">
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Id</th>
                <th>Siswa</th>
                <th>Tanggal Bayar</th>
                <th>Bulan</th>
                <th>Tahun Bayar</th>
                <th>Jumlah bayar</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data as $key => $row) { ?>
                <tr>
                    <td><?php echo e($row['id']); ?></td>
                    <td><?php echo e($row['name']) . "(" .e($row['classname']) .")" ; ?></td>
                    <td><?php echo e($row['tgl_bayar']); ?></td>
                    <td><?php echo e($row['month_name']); ?></td>
                    <td><?php echo e($row['tahun_bayar']); ?></td>
                    <td><?php echo e($row['jumlah_bayar']); ?></td>
                    <td class="row gap-2">
                        <a class="col-md-6 btn btn-primary" href="edit.php?id=<?= $salt ."|". base64_encode($row['id']) ?>">Edit</a>
                        <form action="process/delete.php" class="col-md-6" method="POST">
                            <input type="hidden" name="id" value="<?= base64_encode($row['id']) ?>">
                            <button class="btn btn-danger" type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
    </div>
    
    <div class="modal  fade" id="addSiswaModal" tabindex="-1" role="dialog" aria-labelledby="addPembayaran" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addPembayaran">Form Pendaftaran</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="process/create.php" method="POST">
                        <div class="row">
                            <div class="col-md-6">
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name" name="name" required placeholder="Nama siswa" aria-describedby="emailHelp">
                            </div>
                            </div>
                            <div class="col-md-6">
                            <div class="mb-3">
                                <label for="nis" class="form-label">NIS</label>
                                <input type="text" class="form-control" id="nis" placeholder="Nomer Induk Siswa" name="nis" aria-describedby="emailHelp" required>
                            </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                            <div class="mb-3">
                                <label for="phone" class="form-label">Phone</label>
                                <input type="text" class="form-control" id="phone" placeholder="Nomer telephone" name="phone" aria-describedby="emailHelp" required>
                            </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="asal_sekolah" class="form-label">Asal Sekolah</label>
                                    <input type="text" class="form-control" id="asal_sekolah" placeholder="Asal sekolah" name="asal_sekolah" aria-describedby="emailHelp" required>
                                </div>
                            </div>
                             <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="class" class="form-label">Kelas</label>
                                    <input type="text" class="form-control" id="class" placeholder="Kelas" name="class" aria-describedby="emailHelp">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="jenis_kelamin" class="form-label">Jenis kelamin</label>
                                <select name="jenis_kelamin" id="jenis_kelamin" class="form-select mb-3" aria-label="Jenis Kelamin">
                                    <option selected disabled>Jenis Kelamin</option>
                                    <option value="male">Laki Laki</option>
                                    <option value="female">Peremupan</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                <label for="tanggal_lahir" class="form-label">Tanggal lahir</label>
                                <input type="date" class="form-control" id="tanggal_lahir" placeholder="Asal sekolah" name="tanggal_lahir">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <textarea class="form-control" style="height: 125px;" name="alamat" placeholder="Alamat siswa" id="floatingTextarea"></textarea>
                                    <label for="floatingTextarea">Alamat siswa</label>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary mt-4">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function showAlert(title ,message, type, confirmText) {
            Swal.fire({
                title: title,
                text: message,
                icon: type,
                confirmButtonText: confirmText
            });
        }
        <?php 
        if(isset($_SESSION['flash_message'])){
            $message = $_SESSION['flash_message'];
            $func = "showAlert('" . $message['title'] . "','" . $message['message'] . "','". $message['type'] . "','" . $message['confirm_text'] . "')";
            echo $func;
            clearFlashMessage();
        } ?>
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script></body>
</html>
