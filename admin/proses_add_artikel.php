<?php
session_start();
require_once("../koneksi.php");

// Cek login
if (!isset($_SESSION['username'])) {
    header("Location: ../auth/login.php");
    exit;
}

// Validasi form input
if (!isset($_POST['nama_artikel']) || !isset($_POST['isi_artikel'])) {
    echo "<script>alert('Form tidak lengkap.'); history.back();</script>";
    exit;
}

// Ambil data input dan sanitasi
$judul  = mysqli_real_escape_string($db, $_POST['nama_artikel']);
$isi    = mysqli_real_escape_string($db, $_POST['isi_artikel']);
$author = $_SESSION['username'];

// Fungsi slug generator
function generateSlug($string) {
    $string = preg_replace('/[^A-Za-z0-9-]+/', '-', strtolower(trim($string)));
    return rtrim($string, '-');
}

$slug = generateSlug($judul);

// Simpan ke database
$sql = "INSERT INTO tbl_artikel (nama_artikel, slug, isi_artikel, author) 
        VALUES ('$judul', '$slug', '$isi', '$author')";
$query = mysqli_query($db, $sql);

// Feedback
if ($query) {
    echo "<script>alert('Artikel berhasil ditambahkan.'); window.location='data_artikel.php';</script>";
} else {
    echo "<script>alert('Gagal menambahkan artikel.'); history.back();</script>";
}
?>
