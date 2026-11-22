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

if (empty($_SESSION['token_admin'])) {
    $_SESSION['token_admin'] = bin2hex(random_bytes(32));
}

$pesan = "";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['hapus_id'])) {

    if (
        !isset($_POST['token']) ||
        !hash_equals($_SESSION['token_admin'], $_POST['token'])
    ) {
        die("Permintaan tidak valid.");
    }

    $id = (int) $_POST['hapus_id'];

    $stmt = mysqli_prepare($conn, "DELETE FROM reservasi WHERE id = ?");
    mysqli_stmt_bind_param($stmt, "i", $id);

    if (mysqli_stmt_execute($stmt) && mysqli_stmt_affected_rows($stmt) > 0) {
        $_SESSION['pesan_admin'] = "Data reservasi berhasil dihapus!";
    } else {
        $_SESSION['pesan_admin'] = "Data reservasi tidak ditemukan atau gagal dihapus.";
    }

    mysqli_stmt_close($stmt);

    header("Location: admin.php");
    exit;
}

if (isset($_SESSION['pesan_admin'])) {
    $pesan = $_SESSION['pesan_admin'];
    unset($_SESSION['pesan_admin']);
}

$cari = trim($_GET['cari'] ?? '');

if ($cari != "") {

    $kata = "%" . $cari . "%";

    $stmt = mysqli_prepare(
        $conn,
        "SELECT * FROM reservasi
         WHERE nama_pelanggan LIKE ?
         OR telepon LIKE ?
         OR email LIKE ?
         OR nama_kamar LIKE ?
         ORDER BY id DESC"
    );

    mysqli_stmt_bind_param(
        $stmt,
        "ssss",
        $kata,
        $kata,
        $kata,
        $kata
    );

    mysqli_stmt_execute($stmt);
    $query = mysqli_stmt_get_result($stmt);

} else {

    $query = mysqli_query(
        $conn,
        "SELECT * FROM reservasi ORDER BY id DESC"
    );

}
?>

<html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Admin - HomiStay</title>

    <link rel="stylesheet" href="assets/style.css">

    <style>
    .admin-container {
    max-width: 1250px;
    margin: 45px auto;
    padding: 25px;
    background: #ffffff;
    border-radius: 16px;
    box-shadow: 0 5px 25px rgba(0,0,0,0.06);
}

.admin-table {
    width: 100%;
    border-collapse: collapse;
    background: white;
    margin-top: 25px;
    min-width: 950px;
}

.admin-table th,
.admin-table td {
    border-bottom: 1px solid #e8ece8;
    padding: 14px 12px;
    text-align: left;
    font-size: 13px;
}

.admin-table th {
    background: #315b4c;
    color: white;
    font-weight: 600;
    white-space: nowrap;
}

.admin-table tr:nth-child(even) {
    background: #f7f9f6;
}

.admin-table tr:hover {
    background: #edf3ee;
}

.table-wrapper {
    overflow-x: auto;
    border-radius: 10px;
}

.btn-hapus {
    background: #b94b4b;
    color: white;
    border: none;
    padding: 9px 14px;
    border-radius: 6px;
    cursor: pointer;
    font-size: 12px;
}

.btn-hapus:hover {
    background: #963838;
}

.pesan-admin {
    background: #e8f5e9;
    color: #256029;
    padding: 14px;
    border-radius: 8px;
    margin-bottom: 18px;
    font-size: 14px;
}

.admin-search {
    display: flex;
    gap: 12px;
    flex-wrap: wrap;
    margin: 25px 0;
}

.admin-search input {
    flex: 1;
    min-width: 200px;
    padding: 13px 15px;
    border: 1px solid #dce3dd;
    border-radius: 8px;
    outline: none;
}

.admin-search input:focus {
    border-color: #315b4c;
}

.admin-action {
    display: inline-block;
    background: #315b4c;
    color: white;
    padding: 9px 13px;
    border-radius: 6px;
    text-decoration: none;
    font-size: 12px;
    margin-bottom: 5px;
}

.admin-action:hover {
    background: #244638;
    color: white;
}

@media (max-width: 768px) {
    .admin-container {
        margin: 20px 10px;
        padding: 15px;
    }

    .admin-container .section-title h2 {
        font-size: 27px;
    }
}
</style>
</head>

<body>

<header class="site-navbar">
    <div class="logo">HomiStay <span style="font-size:15px;"> ADMIN</span></div>

    <nav class="nav-menu">
        <a href="index.php">Beranda</a>
        <a href="logout.php">logout</a>
    </nav>
</header>

<section class="admin-container">

    <div class="section-title">
        <h2>Dashboard Admin</h2>
        <p>Daftar Reservasi Pelanggan HomiStay</p>
    </div>

    <?php if ($pesan != ""): ?>
        <p class="pesan-admin">
            <?php echo htmlspecialchars($pesan); ?>
        </p>
    <?php endif; ?>

    <form method="GET" action="admin.php"
      class="admin-search">

    <input
        type="text"
        name="cari"
        placeholder="Cari nama, telepon, email, atau kamar..."
        value="<?php echo htmlspecialchars($cari); ?>"
        
    >

    <button type="submit" class="btn">
        Cari
    </button>

    <a href="admin.php" class="btn">
        Reset
    </a>

</form>
    <div class="table-wrapper">
        <table class="admin-table">

            <tr>
                <th>No</th>
                <th>Nama Pelanggan</th>
                <th>Telepon</th>
                <th>Email</th>
                <th>Kamar</th>
                <th>Check-in</th>
                <th>Check-out</th>
                <th>Jumlah Tamu</th>
                <th>Aksi</th>
            </tr>

            <?php
            $no = 1;

            if (mysqli_num_rows($query) > 0):
                while ($data = mysqli_fetch_assoc($query)):
            ?>

            <tr>
                <td><?php echo $no++; ?></td>

                <td><?php echo htmlspecialchars($data['nama_pelanggan']); ?></td>

                <td><?php echo htmlspecialchars($data['telepon']); ?></td>

                <td><?php echo htmlspecialchars($data['email']); ?></td>

                <td><?php echo htmlspecialchars($data['nama_kamar']); ?></td>

                <td><?php echo htmlspecialchars($data['tanggal_checkin']); ?></td>

                <td><?php echo htmlspecialchars($data['tanggal_checkout']); ?></td>

                <td><?php echo (int)$data['jumlah_tamu']; ?></td>

                <td>
                    <a href="detail_reservasi.php?id=<?php echo (int)$data['id']; ?>"
                    class="admin-action">
    Detail
</a>
                    <form method="POST" action="admin.php"
                          onsubmit="return confirm('Yakin ingin menghapus reservasi ini?');">

                        <input type="hidden" name="hapus_id"
                               value="<?php echo (int)$data['id']; ?>">

                        <input type="hidden" name="token"
                               value="<?php echo htmlspecialchars($_SESSION['token_admin']); ?>">

                        <button type="submit" class="btn-hapus">
                            Hapus
                        </button>
                    </form>
                </td>
            </tr>

            <?php
                endwhile;
            else:
            ?>

            <tr>
                <td colspan="9" style="text-align:center;">
                    Belum ada data reservasi.
                </td>
            </tr>

            <?php endif; ?>

        </table>
    </div>

</section>

<footer class="footer">
    © 2026 HomiStay.
</footer>

</body>
</html>