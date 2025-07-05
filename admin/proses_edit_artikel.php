<?php
session_start();
require_once("../koneksi.php");

// Pastikan user login
if (!isset($_SESSION['username'])) {
    header("Location: ../auth/login.php");
    exit;
}

// Validasi input dari form
if (!isset($_POST['id_artikel'], $_POST['nama_artikel'], $_POST['isi_artikel'])) {
    echo "<script>alert('Form tidak lengkap.'); history.back();</script>";
    exit;
}

// Ambil dan bersihkan input
$id     = mysqli_real_escape_string($db, $_POST['id_artikel']);
$judul  = mysqli_real_escape_string($db, $_POST['nama_artikel']);
$isi    = mysqli_real_escape_string($db, $_POST['isi_artikel']);

// Update data
$sql = "UPDATE tbl_artikel SET nama_artikel = '$judul', isi_artikel = '$isi' WHERE id_artikel = '$id'";
$query = mysqli_query($db, $sql);

// Feedback ke pengguna
if ($query) {
    echo "<script>alert('Artikel berhasil diperbarui.'); window.location='data_artikel.php';</script>";
} else {
    echo "<script>alert('Gagal mengedit artikel.'); history.back();</script>";
}
?>
