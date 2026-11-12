
<?php
require_once 'config/database.php';

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if (!$id) {
    die("ID tidak valid");
}

$stmt = $pdo->prepare("DELETE FROM mahasiswa WHERE id = ?");
$stmt->execute([$id]);

//header("Location: index.php");
echo "<script type='text/javascript'>document.location.href = 'index.php';</script>";
exit;
