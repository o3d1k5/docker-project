
<?php
require_once 'config/database.php';

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if (!$id) {
    die("ID tidak valid");
}

$stmt = $pdo->prepare("SELECT * FROM mahasiswa WHERE id = ?");
$stmt->execute([$id]);

$row = $stmt->fetch();

if (!$row) {
    die("Data tidak ditemukan");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nim = trim($_POST['nim']);
    $nama = trim($_POST['nama']);
    $jurusan = trim($_POST['jurusan']);
    $alamat = trim($_POST['alamat']);

    $sql = "UPDATE mahasiswa SET
            nim = :nim,
            nama = :nama,
            jurusan = :jurusan,
            alamat = :alamat
            WHERE id = :id";

    $stmt = $pdo->prepare($sql);

    $stmt->execute([
        ':nim' => $nim,
        ':nama' => $nama,
        ':jurusan' => $jurusan,
        ':alamat' => $alamat,
        ':id' => $id
    ]);

    //header("Location: index.php");
    echo "<script type='text/javascript'>document.location.href = 'index.php';</script>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="card p-4">
        <h3>Edit Data Mahasiswa</h3>

        <form method="POST">
            <div class="mb-3">
                <label>NIM</label>
                <input type="text" name="nim"
                       class="form-control"
                       value="<?= htmlspecialchars($row['nim']) ?>" required>
            </div>

            <div class="mb-3">
                <label>Nama</label>
                <input type="text" name="nama"
                       class="form-control"
                       value="<?= htmlspecialchars($row['nama']) ?>" required>
            </div>

            <div class="mb-3">
                <label>Jurusan</label>
                <input type="text" name="jurusan"
                       class="form-control"
                       value="<?= htmlspecialchars($row['jurusan']) ?>" required>
            </div>

            <div class="mb-3">
                <label>Alamat</label>
                <textarea name="alamat" class="form-control"><?= htmlspecialchars($row['alamat']) ?></textarea>
            </div>

            <button type="submit" class="btn btn-success">
                Update
            </button>

            <a href="index.php" class="btn btn-secondary">
                Kembali
            </a>
        </form>
    </div>
</div>

</body>
</html>
