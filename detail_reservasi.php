<?php
session_start();

if (
    !isset($_SESSION['admin_login']) ||
    $_SESSION['admin_login'] !== true
) {
    header("Location: login.php");
    exit;
}

include "koneksi.php";

$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

$stmt = mysqli_prepare(
    $conn,
    "SELECT * FROM reservasi WHERE id = ?"
);

mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);
$data = mysqli_fetch_assoc($result);

mysqli_stmt_close($stmt);

if (!$data) {
    die("Data reservasi tidak ditemukan.");
}
?>

<html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Detail Reservasi - HomiStay</title>

    <link rel="stylesheet" href="assets/style.css">

    <?php
session_start();

if (
    !isset($_SESSION['admin_login']) ||
    $_SESSION['admin_login'] !== true
) {
    header("Location: login.php");
    exit;
}

include "koneksi.php";

$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

$stmt = mysqli_prepare(
    $conn,
    "SELECT * FROM reservasi WHERE id = ?"
);

mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);
$data = mysqli_fetch_assoc($result);

mysqli_stmt_close($stmt);

if (!$data) {
    die("Data reservasi tidak ditemukan.");
}
?>

<html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Detail Reservasi - HomiStay</title>

    <link rel="stylesheet" href="assets/style.css">

    <style>
        .detail-container {
    max-width: 750px;
    margin: 50px auto;
    padding: 35px;
    background: #ffffff;
    border-radius: 18px;
    box-shadow: 0 8px 30px rgba(0,0,0,0.07);
}

.detail-container h2 {
    text-align: center;
    color: #263b31;
    font-size: 29px;
    font-weight: 800;
    margin-bottom: 30px;
}

.detail-item {
    display: flex;
    justify-content: space-between;
    gap: 20px;
    padding: 17px 5px;
    border-bottom: 1px solid #e8ece8;
    color: #59675f;
    font-size: 14px;
}

.detail-item strong {
    color: #263b31;
    min-width: 180px;
}

.btn-kembali {
    display: inline-block;
    margin-top: 30px;
    padding: 13px 22px;
    background: #315b4c;
    color: #ffffff;
    text-decoration: none;
    border-radius: 7px;
    transition: 0.3s;
    font-weight: 600;
}

.btn-kembali:hover {
    background: #244638;
    color: white;
}

@media (max-width: 600px) {
    .detail-container {
        margin: 25px 12px;
        padding: 22px 17px;
    }

    .detail-item {
        flex-direction: column;
        gap: 7px;
    }

    .detail-item strong {
        min-width: unset;
    }
}
    </style>
</head>

<body>

<header class="navbar">
    <div class="logo">HomiStay. Admin</div>
</header>

<section class="detail-container">

    <h2>Detail Reservasi</h2>

    <div class="detail-item">
        <strong>Nama Pelanggan</strong>
        <?php echo htmlspecialchars($data['nama_pelanggan']); ?>
    </div>

    <div class="detail-item">
        <strong>Nomor Telepon</strong>
        <?php echo htmlspecialchars($data['telepon']); ?>
    </div>

    <div class="detail-item">
        <strong>Email</strong>
        <?php echo htmlspecialchars($data['email']); ?>
    </div>

    <div class="detail-item">
        <strong>Jenis Kamar</strong>
        <?php echo htmlspecialchars($data['nama_kamar']); ?>
    </div>

    <div class="detail-item">
        <strong>Tanggal Check-in</strong>
        <?php echo htmlspecialchars($data['tanggal_checkin']); ?>
    </div>

    <div class="detail-item">
        <strong>Tanggal Check-out</strong>
        <?php echo htmlspecialchars($data['tanggal_checkout']); ?>
    </div>

    <div class="detail-item">
        <strong>Jumlah Tamu</strong>
        <?php echo (int)$data['jumlah_tamu']; ?> orang
    </div>

    <div class="detail-item">
        <strong>Tanggal Pemesanan</strong>
        <?php echo htmlspecialchars($data['tanggal_pesan']); ?>
    </div>

    <a href="admin.php" class="btn-kembali">
        Kembali ke Dashboard
    </a>

</section>

<footer class="footer">
    © 2026 HomiStay.
</footer>

</body>
</html>
</head>

<body>

<header class="site navbar">
    <div class="logo">HomiStay <span style="font-size:15px;">ADMIN</span></div>
    <nav class="nev-menu">
        <a
        href="admin.php">Deshboard</a>
        <a
        href="logout.php">Logout</a>
</nav>
</header>

<section class="detail-container">

    <h2>Detail Reservasi</h2>

    <div class="detail-item">
        <strong>Nama Pelanggan</strong>
        <?php echo htmlspecialchars($data['nama_pelanggan']); ?>
    </div>

    <div class="detail-item">
        <strong>Nomor Telepon</strong>
        <?php echo htmlspecialchars($data['telepon']); ?>
    </div>

    <div class="detail-item">
        <strong>Email</strong>
        <?php echo htmlspecialchars($data['email']); ?>
    </div>

    <div class="detail-item">
        <strong>Jenis Kamar</strong>
        <?php echo htmlspecialchars($data['nama_kamar']); ?>
    </div>

    <div class="detail-item">
        <strong>Tanggal Check-in</strong>
        <?php echo htmlspecialchars($data['tanggal_checkin']); ?>
    </div>

    <div class="detail-item">
        <strong>Tanggal Check-out</strong>
        <?php echo htmlspecialchars($data['tanggal_checkout']); ?>
    </div>

    <div class="detail-item">
        <strong>Jumlah Tamu</strong>
        <?php echo (int)$data['jumlah_tamu']; ?> orang
    </div>

    <div class="detail-item">
        <strong>Tanggal Pemesanan</strong>
        <?php echo htmlspecialchars($data['tanggal_pesan']); ?>
    </div>

    <a href="admin.php" class="btn-kembali">
        Kembali ke Dashboard
    </a>

</section>

<footer class="footer">
    © 2026 HomiStay.
</footer>

</body>
</html>