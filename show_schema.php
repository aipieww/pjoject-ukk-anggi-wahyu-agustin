<?php
include 'login/config.php';
if (!$conn) {
    echo "koneksi gagal";
    exit;
}
$tables = ['siswas','anggota','buku','peminjaman'];
foreach ($tables as $t) {
    echo "\n-- SHOW CREATE TABLE $t --\n";
    $res = mysqli_query($conn, "SHOW CREATE TABLE $t");
    if ($row = mysqli_fetch_assoc($res)) {
        echo $row['Create Table'] . "\n";
    }
}
?>