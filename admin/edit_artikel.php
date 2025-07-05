<?php
include('../koneksi.php');
session_start();
if (!isset($_SESSION['username'])) {
    header('location:../auth/login.php');
    exit;
}

// Cek apakah form disubmit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_artikel = $_POST['id_artikel'];
    $nama_artikel = mysqli_real_escape_string($db, $_POST['nama_artikel']);
    $kategori = mysqli_real_escape_string($db, $_POST['kategori']);
    $isi_artikel = mysqli_real_escape_string($db, $_POST['isi_artikel']);
    $meta_description = mysqli_real_escape_string($db, $_POST['meta_description']);
    $tanggal_update = date('Y-m-d H:i:s');

    // Ambil data gambar lama
    $query = "SELECT gambar_artikel FROM tbl_artikel WHERE id_artikel = '$id_artikel'";
    $result = mysqli_query($db, $query);
    $data = mysqli_fetch_assoc($result);
    $gambar_lama = $data['gambar_artikel'];

    // Handle upload gambar baru
    $gambar_artikel = $gambar_lama;
    
    // Cek apakah user ingin menghapus gambar
    $hapus_gambar = isset($_POST['hapus_gambar']) ? true : false;
    
    if ($hapus_gambar && !empty($gambar_lama)) {
        // Hapus file gambar lama
        $file_path = '../uploads/artikel/' . $gambar_lama;
        if (file_exists($file_path)) {
            unlink($file_path);
        }
        $gambar_artikel = '';
    }
    
    // Cek apakah ada file gambar baru diupload
    if (!empty($_FILES['gambar_artikel']['name'])) {
        $file_name = $_FILES['gambar_artikel']['name'];
        $file_size = $_FILES['gambar_artikel']['size'];
        $file_tmp = $_FILES['gambar_artikel']['tmp_name'];
        $file_type = $_FILES['gambar_artikel']['type'];
        $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
        
        $extensions = array("jpeg", "jpg", "png");
        
        if (in_array($file_ext, $extensions) === false) {
            $_SESSION['error'] = "Ekstensi file tidak diizinkan, pilih file JPEG, JPG, atau PNG.";
            header("location: edit_artikel.php?id_artikel=$id_artikel");
            exit;
        }
        
        if ($file_size > 2097152) { // 2MB
            $_SESSION['error'] = "Ukuran file terlalu besar, maksimal 2MB.";
            header("location: edit_artikel.php?id_artikel=$id_artikel");
            exit;
        }
        
        // Hapus gambar lama jika ada
        if (!empty($gambar_lama)) {
            $file_path = '../uploads/artikel/' . $gambar_lama;
            if (file_exists($file_path)) {
                unlink($file_path);
            }
        }
        
        // Generate nama file unik
        $gambar_artikel = uniqid() . '.' . $file_ext;
        move_uploaded_file($file_tmp, "../uploads/artikel/" . $gambar_artikel);
    }
    
    // Update data artikel
    $sql = "UPDATE tbl_artikel SET 
            nama_artikel = '$nama_artikel',
            kategori = '$kategori',
            isi_artikel = '$isi_artikel',
            meta_description = '$meta_description',
            tanggal_update = '$tanggal_update'";
    
    // Tambahkan gambar jika diupdate
    if (!empty($gambar_artikel) || $hapus_gambar) {
        $sql .= ", gambar_artikel = " . (!empty($gambar_artikel) ? "'$gambar_artikel'" : "NULL");
    }
    
    $sql .= " WHERE id_artikel = '$id_artikel'";
    
    $query = mysqli_query($db, $sql);
    
    if ($query) {
        $_SESSION['success'] = "Artikel berhasil diperbarui.";
        header("location: data_artikel.php");
        exit;
    } else {
        $_SESSION['error'] = "Gagal memperbarui artikel: " . mysqli_error($db);
        header("location: edit_artikel.php?id_artikel=$id_artikel");
        exit;
    }
} else {
    header("location: data_artikel.php");
    exit;
}
?>