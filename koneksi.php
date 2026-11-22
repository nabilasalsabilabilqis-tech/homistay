<<?php
$host = "sql206.infinityfree.com";
$user = "if0_43498432";
$pass = "vwTvxriNgkqEv";
$db   = "if0_43498432_homistay";

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}
?>