<?php
include('../koneksi.php');
session_start();

// Cek login
if (!isset($_SESSION['username'])) {
    header('location:../auth/login.php');
    exit;
}

// Validasi input ID
if (!isset($_GET['id_gallery']) || !is_numeric($_GET['id_gallery'])) {
    echo "<script>alert('ID tidak valid.'); window.location='data_gallery.php';</script>";
    exit;
}

$id = $_GET['id_gallery'];

// Ambil nama file gambar
$sql = "SELECT foto FROM tbl_gallery WHERE id_gallery = '$id'";
$query = mysqli_query($db, $sql);
$data = mysqli_fetch_assoc($query);

if (!$data) {
    echo "<script>alert('Data tidak ditemukan.'); window.location='data_gallery.php';</script>";
    exit;
}

$foto = $data['foto'];
$folder = "../images/";

// Hapus file jika ada
if (!empty($foto) && file_exists($folder . $foto)) {
    unlink($folder . $foto);
}

// Hapus data dari database
$sql_delete = "DELETE FROM tbl_gallery WHERE id_gallery = '$id'";
$query_delete = mysqli_query($db, $sql_delete);

if ($query_delete) {
    echo "<script>alert('Data gallery berhasil dihapus.'); window.location='data_gallery.php';</script>";
} else {
    echo "<script>alert('Gagal menghapus data.'); history.back();</script>";
}
