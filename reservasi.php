<?php
include "koneksi.php";

$namaKamar = $_GET['kamar'] ?? 'Deluxe Room';
$pesan = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nama = $_POST['nama'];
    $telepon = $_POST['telepon'];
    $email = $_POST['email'];
    $kamar = $_POST['kamar'];
    $checkin = $_POST['checkin'];
    $checkout = $_POST['checkout'];
    $tamu = (int) $_POST['tamu'];

    if ($checkout <= $checkin) {
        $pesan = "Tanggal check-out harus setelah check-in!";
    } else {

        $query = "INSERT INTO reservasi
        (nama_pelanggan, telepon, email, nama_kamar,
        tanggal_checkin, tanggal_checkout, jumlah_tamu)
        VALUES (?, ?, ?, ?, ?, ?, ?)";

        $stmt = mysqli_prepare($conn, $query);

        mysqli_stmt_bind_param(
            $stmt,
            "ssssssi",
            $nama,
            $telepon,
            $email,
            $kamar,
            $checkin,
            $checkout,
            $tamu
        );

        if (mysqli_stmt_execute($stmt)) {
            $pesan = "Reservasi berhasil disimpan!";
        } else {
            $pesan = "Reservasi gagal disimpan.";
        }

        mysqli_stmt_close($stmt);
    }
}
?>

<html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Reservasi - HomiStay</title>

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
    </nav>
</header>

<section class="reservation-section">

    <div class="section-title">
        <h2>Formulir Reservasi</h2>
        <p>Lengkapi informasi berikut untuk melakukan pemesanan kamar</p>
    </div>

    <div class="reservation-card">

        <?php if ($pesan != ""): ?>
            <p class="reservation-message">
                <?php echo htmlspecialchars($pesan); ?>
            </p>
        <?php endif; ?>

        <form action="" method="post" class="reservation-form">

            <div class="form-group">
                <label>Nama Lengkap</label>
                <input type="text" name="nama"
                       placeholder="Masukkan nama lengkap"
                       required>
            </div>

            <div class="form-group">
                <label>Nomor Telepon</label>
                <input type="tel" name="telepon"
                       placeholder="Masukkan nomor telepon"
                       required>
            </div>

            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email"
                       placeholder="Masukkan email"
                       required>
            </div>

            <div class="form-group">
                <label>Pilihan Kamar</label>
                <input type="text" name="kamar"
                       value="<?php echo htmlspecialchars($namaKamar); ?>"
                       readonly>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label>Tanggal Check-in</label>
                    <input type="date" name="checkin" required>
                </div>

                <div class="form-group">
                    <label>Tanggal Check-out</label>
                    <input type="date" name="checkout" required>
                </div>
            </div>

            <div class="form-group">
                <label>Jumlah Tamu</label>
                <input type="number" name="tamu"
                       min="1" value="1" required>
            </div>

            <button type="submit" class="btn reservation-button">
                Kirim Reservasi
            </button>

        </form>
    </div>

</section>
<footer class="footer">
    © 2026 HomiStay.
</footer>

</body>
</html>