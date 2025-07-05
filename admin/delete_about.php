<?php
include('../koneksi.php');
session_start();

// Cek apakah user sudah login
if (!isset($_SESSION['username'])) {
    header('location:login.php');
    exit;
}

// Validasi ID
if (!isset($_GET['id_about']) || empty($_GET['id_about'])) {
    echo "<script>alert('ID tidak valid.'); window.location='about.php';</script>";
    exit;
}

$id = mysqli_real_escape_string($db, $_GET['id_about']);

// Hapus data dari database
$sql = "DELETE FROM tbl_about WHERE id_about = '$id'";
$query = mysqli_query($db, $sql);

// Feedback ke user
if ($query) {
    echo "<script>alert('Data About berhasil dihapus.'); window.location='about.php';</script>";
} else {
    echo "<script>alert('Gagal menghapus data.'); history.back();</script>";
}
?>
