<?php
// File test untuk verifikasi fungsi modal book detail

include 'login/config.php';

// Cek koneksi
if (!$conn) {
    die("❌ Koneksi database gagal");
}

// Cek kolom sinopsis ada
$check = mysqli_query($conn, "SHOW COLUMNS FROM buku LIKE 'sinopsis'");
$sinopsis_exists = mysqli_num_rows($check) > 0;

// Cek ada buku di database
$buku_result = mysqli_query($conn, "SELECT COUNT(*) as total FROM buku");
$buku_count = mysqli_fetch_assoc($buku_result)['total'];

// Ambil satu buku untuk sample
$sample = mysqli_query($conn, "SELECT * FROM buku LIMIT 1");
$sample_buku = $sample && mysqli_num_rows($sample) > 0 ? mysqli_fetch_assoc($sample) : null;

?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Test Book Detail Modal</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
        .test-container {
            margin: 40px;
            max-width: 800px;
        }
        .test-item {
            padding: 15px;
            margin: 10px 0;
            border-radius: 8px;
            background: rgba(255,255,255,0.05);
            border-left: 4px solid #b051ff;
        }
        .test-item.success {
            border-left-color: #27ae60;
        }
        .test-item.error {
            border-left-color: #e74c3c;
        }
    </style>
</head>
<body>
    <div class="test-container">
        <h1>✓ Test Setup Book Detail Modal</h1>
        
        <div class="test-item success">
            <strong>✓ Database Connected</strong><br>
            <small>Koneksi ke database berhasil</small>
        </div>

        <div class="test-item <?php echo $sinopsis_exists ? 'success' : 'error'; ?>">
            <strong><?php echo $sinopsis_exists ? '✓' : '✗'; ?> Kolom Sinopsis</strong><br>
            <small><?php echo $sinopsis_exists ? 'Kolom sinopsis sudah ada di tabel buku' : 'Kolom sinopsis belum ada - jalankan migrate_add_sinopsis.php'; ?></small>
        </div>

        <div class="test-item <?php echo $buku_count > 0 ? 'success' : 'error'; ?>">
            <strong><?php echo $buku_count > 0 ? '✓' : '✗'; ?> Data Buku</strong><br>
            <small><?php echo $buku_count > 0 ? "Ditemukan $buku_count buku di database" : 'Tidak ada buku di database'; ?></small>
        </div>

        <?php if ($sample_buku): ?>
        <div class="test-item success">
            <strong>✓ Sample Buku untuk Test</strong>
            <p><strong>Judul:</strong> <?php echo htmlspecialchars($sample_buku['judul_buku']); ?></p>
            <p><strong>Pengarang:</strong> <?php echo htmlspecialchars($sample_buku['pengarang']); ?></p>
            <p><strong>JSON Data (untuk testing):</strong></p>
            <pre style="background: rgba(0,0,0,0.3); padding: 10px; border-radius: 4px; overflow-x: auto;">
<?php 
$test_data = json_encode([
    'judul' => $sample_buku['judul_buku'],
    'pengarang' => $sample_buku['pengarang'],
    'penerbit' => $sample_buku['penerbit'],
    'tahun' => $sample_buku['tahun_terbit'],
    'stok' => $sample_buku['stok'],
    'sinopsis' => $sample_buku['sinopsis'] ?? 'Tidak ada',
    'cover' => $sample_buku['cover'] ? 'assets/cover/' . $sample_buku['cover'] : 'https://via.placeholder.com/180x150?text=No+Cover',
    'id' => $sample_buku['id_buku']
]);
echo htmlspecialchars($test_data);
?>
            </pre>
        </div>
        <?php endif; ?>

        <div style="background: rgba(0,200,100,0.2); padding: 20px; border-radius: 8px; margin-top: 30px;">
            <h2>✓ Setup Berhasil!</h2>
            <p>Sekarang coba buka halaman berikut dan klik card buku untuk test modal:</p>
            <ul>
                <li><a href="siswa/dashboard.php" style="color: #b051ff;">Dashboard siswa</a></li>
                <li><a href="siswa/koleksi_buku.php" style="color: #b051ff;">Koleksi Buku siswa</a></li>
                <li><a href="admin/dashboard.php" style="color: #b051ff;">Dashboard Admin</a></li>
            </ul>
        </div>
    </div>

    <script src="assets/js/script.js"></script>
</body>
</html>
