<?php
include('../koneksi.php');
session_start();

// Cek apakah user sudah login
if (!isset($_SESSION['username'])) {
    header('location:../auth/login.php');
    exit;
}

// Validasi input
if (!isset($_POST['id_gallery']) || !isset($_POST['judul'])) {
    echo "<script>alert('Data tidak lengkap.'); history.back();</script>";
    exit;
}

$id    = mysqli_real_escape_string($db, $_POST['id_gallery']);
$judul = mysqli_real_escape_string($db, $_POST['judul']);
$foto  = $_FILES['foto']['name'];
$tmp   = $_FILES['foto']['tmp_name'];

$folder = '../images/';
$success = false;

if (!empty($foto)) {
    $target = $folder . basename($foto);

    // Coba upload file baru
    if (move_uploaded_file($tmp, $target)) {
        // Ambil nama file lama
        $getOld = mysqli_query($db, "SELECT foto FROM tbl_gallery WHERE id_gallery = '$id'");
        $old    = mysqli_fetch_assoc($getOld);
        $oldFile = $old['foto'];

        // Hapus file lama jika ada dan tidak kosong
        if (!empty($oldFile) && file_exists($folder . $oldFile)) {
            unlink($folder . $oldFile);
        }

        // Update judul + nama file baru
        $sql = "UPDATE tbl_gallery SET judul = '$judul', foto = '$foto' WHERE id_gallery = '$id'";
        $success = true;
    } else {
        echo "<script>alert('Gagal upload gambar baru.'); history.back();</script>";
        exit;
    }
} else {
    // Jika hanya mengubah judul
    $sql = "UPDATE tbl_gallery SET judul = '$judul' WHERE id_gallery = '$id'";
    $success = true;
}

if ($success) {
    $query = mysqli_query($db, $sql);
    if ($query) {
        echo "<script>alert('Data gallery berhasil diperbarui.'); window.location='data_gallery.php';</script>";
    } else {
        echo "<script>alert('Gagal memperbarui database.'); history.back();</script>";
    }
}
?>
