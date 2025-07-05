<?php
include('../koneksi.php');
session_start();

// Cek login
if (!isset($_SESSION['username'])) {
    header('location:../auth/login.php');
    exit;
}

// Ambil data input
$judul = mysqli_real_escape_string($db, $_POST['judul']);
$foto = $_FILES['foto']['name'];
$tmp  = $_FILES['foto']['tmp_name'];
$folder = '../images/';
$allowed_ext = ['jpg', 'jpeg', 'png', 'gif'];
$max_size = 2 * 1024 * 1024; // 2MB

// Validasi ekstensi
$ext = strtolower(pathinfo($foto, PATHINFO_EXTENSION));
if (!in_array($ext, $allowed_ext)) {
    echo "<script>alert('Ekstensi gambar tidak didukung (hanya JPG, PNG, GIF).'); history.back();</script>";
    exit;
}

// Validasi ukuran file
if ($_FILES['foto']['size'] > $max_size) {
    echo "<script>alert('Ukuran file terlalu besar. Maksimal 2MB.'); history.back();</script>";
    exit;
}

// Buat nama unik agar tidak menimpa file lain
$nama_baru = uniqid('img_') . '.' . $ext;
$target = $folder . $nama_baru;

// Upload & simpan ke database
if (move_uploaded_file($tmp, $target)) {
    $sql = "INSERT INTO tbl_gallery (judul, foto) VALUES ('$judul', '$nama_baru')";
    $query = mysqli_query($db, $sql);

    if ($query) {
        echo "<script>alert('Gambar berhasil ditambahkan.'); window.location='data_gallery.php';</script>";
    } else {
        echo "<script>alert('Gagal menyimpan data ke database.'); history.back();</script>";
    }
} else {
    echo "<script>alert('Gagal mengupload gambar.'); history.back();</script>";
}
?>
