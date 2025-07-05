<?php
include('../koneksi.php');
session_start();

// Cek apakah user sudah login
if (!isset($_SESSION['username'])) {
    header('location:login.php');
    exit;
}

// Ambil dan sanitasi input
if (!isset($_POST['about']) || empty(trim($_POST['about']))) {
    echo "<script>alert('Form tidak boleh kosong.'); history.back();</script>";
    exit;
}

$about = mysqli_real_escape_string($db, $_POST['about']);

// Opsional: Cek jika hanya boleh ada 1 data About
$cek = mysqli_query($db, "SELECT COUNT(*) AS jumlah FROM tbl_about");
$cekData = mysqli_fetch_assoc($cek);
if ($cekData['jumlah'] >= 1) {
    echo "<script>alert('Data About sudah ada. Silakan edit atau hapus terlebih dahulu.'); window.location='about.php';</script>";
    exit;
}

// Simpan ke database
$sql = "INSERT INTO tbl_about (about) VALUES ('$about')";
$query = mysqli_query($db, $sql);

// Tampilkan hasil
if ($query) {
    echo "<script>alert('About berhasil ditambahkan.'); window.location='about.php';</script>";
} else {
    echo "<script>alert('Gagal menambahkan about.'); history.back();</script>";
}
?>
