<?php
session_start();
require_once("../koneksi.php");

// Cek apakah user sudah login
if (!isset($_SESSION['username'])) {
    header('Location: ../auth/login.php');
    exit;
}

// Validasi ID dari URL
if (!isset($_GET['id_artikel']) || empty($_GET['id_artikel'])) {
    echo "<script>alert('ID artikel tidak valid.'); window.location='data_artikel.php';</script>";
    exit;
}

// Amankan input ID
$id = mysqli_real_escape_string($db, $_GET['id_artikel']);

// Eksekusi DELETE
$sql = "DELETE FROM tbl_artikel WHERE id_artikel = '$id'";
$query = mysqli_query($db, $sql);

// Feedback ke user
if ($query) {
    echo "<script>alert('Artikel berhasil dihapus.'); window.location='data_artikel.php';</script>";
} else {
    echo "<script>alert('Gagal menghapus artikel.'); history.back();</script>";
}
?>
