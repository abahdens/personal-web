<?php
include('../koneksi.php');
session_start();

// Cek apakah user sudah login
if (!isset($_SESSION['username'])) {
    header('location:login.php');
    exit;
}

// Validasi form
if (!isset($_POST['id_about']) || !isset($_POST['about']) || trim($_POST['about']) === '') {
    echo "<script>alert('Form tidak lengkap.'); history.back();</script>";
    exit;
}

// Ambil dan sanitasi data
$id = mysqli_real_escape_string($db, $_POST['id_about']);
$about = mysqli_real_escape_string($db, $_POST['about']);

// Update ke database
$sql = "UPDATE tbl_about SET about='$about' WHERE id_about='$id'";
$query = mysqli_query($db, $sql);

// Respon hasil
if ($query) {
    echo "<script>alert('Data berhasil diperbarui.'); window.location='about.php';</script>";
} else {
    echo "<script>alert('Gagal mengedit data.'); history.back();</script>";
}
?>
