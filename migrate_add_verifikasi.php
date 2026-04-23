<?php
/**
 * Migration: Menambahkan fitur verifikasi akun siswa
 * Tambahkan kolom status_verifikasi ke tabel anggota
 */

include 'login/config.php';

try {
    // Cek apakah kolom sudah ada
    $check_column = "SHOW COLUMNS FROM anggota LIKE 'status_verifikasi'";
    $result = mysqli_query($conn, $check_column);
    
    if (mysqli_num_rows($result) == 0) {
        // Kolom belum ada, tambahkan
        $alter_query = "ALTER TABLE anggota ADD COLUMN status_verifikasi ENUM('belum_diverifikasi', 'terverifikasi', 'ditolak') DEFAULT 'belum_diverifikasi' AFTER kelas";
        
        if (mysqli_query($conn, $alter_query)) {
            echo "<div style='padding: 20px; background: #d4edda; color: #155724; border-radius: 4px; margin: 20px;'>";
            echo "✓ Kolom status_verifikasi berhasil ditambahkan ke tabel anggota!";
            echo "</div>";
        } else {
            throw new Exception("Gagal menambahkan kolom: " . mysqli_error($conn));
        }
    } else {
        echo "<div style='padding: 20px; background: #cfe2ff; color: #084298; border-radius: 4px; margin: 20px;'>";
        echo "ℹ Kolom status_verifikasi sudah ada di tabel anggota.";
        echo "</div>";
    }
} catch (Exception $e) {
    echo "<div style='padding: 20px; background: #f8d7da; color: #842029; border-radius: 4px; margin: 20px;'>";
    echo "✗ Error: " . $e->getMessage();
    echo "</div>";
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Migration Database</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; padding: 20px; }
        a { display: inline-block; margin-top: 20px; padding: 10px 20px; background: #007bff; color: white; text-decoration: none; border-radius: 4px; }
        a:hover { background: #0056b3; }
    </style>
</head>
<body>
    <h1>Migration Database - Verifikasi Akun Siswa</h1>
    <p>Status migration dijelaskan di atas.</p>
    <a href="admin/dashboard.php">Kembali ke Dashboard</a>
</body>
</html>
