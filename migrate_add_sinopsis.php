<?php
// File untuk menambahkan kolom sinopsis ke tabel buku
include 'login/config.php';

// Cek apakah kolom sinopsis sudah ada
$check_column = mysqli_query($conn, "SHOW COLUMNS FROM buku LIKE 'sinopsis'");

if (mysqli_num_rows($check_column) == 0) {
    // Kolom belum ada, tambahkan
    $alter_query = "ALTER TABLE buku ADD COLUMN sinopsis LONGTEXT DEFAULT NULL AFTER cover";
    
    if (mysqli_query($conn, $alter_query)) {
        echo "<div style='background: #27ae60; color: white; padding: 15px; border-radius: 8px; margin: 20px;'>
                <strong>✓ Sukses!</strong> Kolom sinopsis telah ditambahkan ke tabel buku.
              </div>";
        echo "<p style='margin: 20px; color: #555;'>Anda dapat menghapus file ini setelah migrasi selesai.</p>";
    } else {
        echo "<div style='background: #e74c3c; color: white; padding: 15px; border-radius: 8px; margin: 20px;'>
                <strong>✗ Error:</strong> " . mysqli_error($conn) . "
              </div>";
    }
} else {
    echo "<div style='background: #3498db; color: white; padding: 15px; border-radius: 8px; margin: 20px;'>
            <strong>ℹ Info:</strong> Kolom sinopsis sudah ada di tabel buku.
          </div>";
}

mysqli_close($conn);
?>
