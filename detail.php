<?php
$nama = $_GET['kamar'] ?? 'Deluxe Room';

$kamar = [
    'Deluxe Room' => [
        'harga' => 'Rp550.000',
        'gambar' => 'assets/deluxe.jpg',
        'deskripsi' => 'Kamar nyaman dengan fasilitas lengkap dan suasana tenang
        bisa  diisi oleh 3 orang dewasa dan 1 anak anak.'
    ],
    'Suite Room' => [
        'harga' => 'Rp750.000',
        'gambar' => 'assets/suite.jpg',
        'deskripsi' => 'Kamar luas dengan desain elegan dan fasilitas premium 
        bisa diisi oleh 2 orang dewasa dan 1 anak anak.'
    ],
    'Standard Room' => [
        'harga' => 'Rp200.000',
        'gambar' => 'assets/standar room.jpg',
        'deskripsi' => 'Pilihan kamar ekonomis dengan fasilitas nyaman
        bisa diisi oleh 2 orang dewasa.'
    ]
];

if (!isset($kamar[$nama])) {
    $nama = 'Deluxe Room';
}

$data = $kamar[$nama];
?>

<html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Kamar - HomiStay</title>
    <link rel="stylesheet" href="assets/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.9/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="assets/style.css">
</head>

<body>

<header class="site-navbar">
    <div class="logo">HomiStay</div>

    <nav class="nav-menu">
        <a href="index.php">Beranda</a>
        <a href="index.php#kamar">Kamar</a>
        <a href="index.php#tentang">Tentang</a>
    </nav>
</header>

<section class="detail-section">

    <div class="section-title">
        <h2><?php echo htmlspecialchars($nama); ?></h2>
        <p>Informasi lengkap kamar penginapan</p>
    </div>

    <div class="room-card">

        <img
            src="<?php echo htmlspecialchars($data['gambar']); ?>"
            alt="Foto kamar"
            style="height:350px;"
        >

        <div class="detail-info">

            <h3><?php echo htmlspecialchars($nama); ?></h3>

            <p>
                <?php echo htmlspecialchars($data['deskripsi']); ?>
            </p>

            <div class="detail-price">
                <?php echo htmlspecialchars($data['harga']); ?> / malam
            </div>

            <br>

            <a href="reservasi.php?kamar=<?php echo urlencode($nama); ?>"
               class="btn">
                Pesan Sekarang
            </a>

        </div>
    </div>

</section>

<footer class="footer">
    © 2026 HomiStay. Website Reservasi Penginapan.
</footer>

</body>
</html>