<?php
include '../../database/connection.php';
try {
    if(isset($_GET['id'])){
    $raw = $_GET['id'];
    $parts = explode('|', $raw);   
    $id = base64_decode($parts[1]);
    $sqlGetClass = "SELECT * FROM class";
    
    $sql = "SELECT siswa.id, siswa.name, siswa.phone,siswa.tanggal_lahir,siswa.jenis_kelamin, siswa.nisn,siswa.nis,siswa.alamat, siswa.phone, siswa.id_class  FROM siswa WHERE siswa.id = $id ORDER BY siswa.id DESC";
    $connection = (new Connection)->getConnection();
    $prepareClass = $connection->prepare($sqlGetClass); 
    $prepareClass->execute();

    $classes = $prepareClass->fetchAll(PDO::FETCH_ASSOC);
    $prepare = $connection->prepare($sql);
    $prepare->execute();
    $data = $prepare->fetch(PDO::FETCH_ASSOC);
}
} catch (\Throwable $th) {
    dd($th);
    // redirect('index.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Data</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/style.css">    <link rel="stylesheet" href="./css/style.css"><link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,400;0,500;1,300;1,600&display=swap" rel="stylesheet">
</head>
<body>
    <section class="container">
        <h2 class="mt-5 text-center">Update Siswa</h2>
      <div class="row justify-content-center">
        <div class="col-md-8">
        <?php if(isset($data)): ?>
        <form method="POST" action="process/edit.php"> 
            <input type="hidden" name="id" value="<?php echo $data['id']; ?>">
        <div class="row">
            <div class="col-md-6">
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" value="<?= e($data['name']) ?>" id="name" name="name" required placeholder="Nama siswa" aria-describedby="emailHelp">
            </div>
            </div>
            <div class="col-md-6">
            <div class="mb-3">
                <label for="nis" class="form-label">NIS</label>
                <input type="text" class="form-control"  value="<?= e($data['nis']) ?>" id="nis" placeholder="Nomer Induk Siswa" name="nis" aria-describedby="emailHelp">
            </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
            <div class="mb-3">
                <label for="phone" class="form-label">Phone</label>
                <input type="text" class="form-control"   value="<?= e($data['phone']) ?>"id="phone" placeholder="Nomer telephone" name="phone" aria-describedby="emailHelp">
            </div>
            </div>
            <div class="col-md-6">
    <div class="mb-3">
        <label for="id_class" class="form-label">Kelas</label>
        <select name="id_class" id="class" class="form-select" aria-describedby="emailHelp">
            <option value="" disabled>Pilih Kelas</option>
            <?php foreach ($classes as $class): ?>
                <option value="<?= $class['id'] ?>" <?= $data['id_class'] == $class['id'] ? "selected" : "" ?>>
                    <?= e($class['name']) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>
</div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <label for="jenis_kelamin" class="form-label">Jenis kelamin</label>
                <select name="jenis_kelamin" id="jenis_kelamin" class="form-select mb-3" aria-label="Jenis Kelamin">
                    <option selected disabled>Jenis Kelamin</option>
                    <option value="male" <?= $data['jenis_kelamin'] == "male" ? "selected" : '' ?>>Laki Laki</option>
                    <option value="female" <?= $data['jenis_kelamin'] == "female" ? "selected" : '' ?>>Peremupan</option>
                </select>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                <label for="tanggal_lahir" class="form-label">Tanggal lahir</label>
                <input type="date" class="form-control" value="<?= $data['tanggal_lahir'] ?>" id="tanggal_lahir" placeholder="Asal sekolah" name="tanggal_lahir">
                </div>
            </div>
            <div class="col-12">
                <div class="form-floating">
                    <textarea class="form-control" style="height: 125px;" name="alamat" placeholder="Alamat siswa" id="floatingTextarea"><?= e($data['alamat']) ?></textarea>
                <label for="floatingTextarea">Alamat siswa</label>
                </div>
            </div>
        </div>
            <button type="submit" class="btn btn-primary mt-3">Update</button>
        </form>
        <?php else: ?>
        <p>Data not found</p>
        <?php endif; ?>
        </div>
      </div>
    </section>

    <!-- Include Bootstrap and other scripts if needed -->
</body>
</html>


