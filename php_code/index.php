
<?php
require_once 'config/database.php';

$stmt = $pdo->query("SELECT * FROM mahasiswa ORDER BY id DESC");
$data = $stmt->fetchAll();

function e($value) {
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>CRUD PHP PDO</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body class="bg-light">

<div class="container mt-5">
    <h2 class="mb-4">Data Mahasiswa</h2>

    <a href="tambah.php" class="btn btn-primary mb-3">
        + Tambah Data
    </a>

    <table class="table table-bordered table-striped bg-white">
        <thead class="table-dark">
            <tr>
                <th>No</th>
                <th>NIM</th>
                <th>Nama</th>
                <th>Jurusan</th>
                <th>Alamat</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
        <?php if (count($data) > 0): ?>
            <?php $no = 1; ?>
            <?php foreach ($data as $row): ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= e($row['nim']) ?></td>
                <td><?= e($row['nama']) ?></td>
                <td><?= e($row['jurusan']) ?></td>
                <td><?= e($row['alamat']) ?></td>
                <td>
                    <a href="edit.php?id=<?= $row['id'] ?>"
                       class="btn btn-warning btn-sm">Edit</a>

                    <a href="hapus.php?id=<?= $row['id'] ?>"
                       class="btn btn-danger btn-sm"
                       onclick="return confirm('Yakin ingin menghapus data?')">
                       Hapus
                    </a>
                </td>
            </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="6" class="text-center">
                    Data belum tersedia
                </td>
            </tr>
        <?php endif; ?>
        </tbody>
    </table>
</div>

</body>
</html>
