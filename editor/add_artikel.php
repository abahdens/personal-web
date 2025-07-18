<?php
include('../koneksi.php');
session_start();
if (!isset($_SESSION['username']) || strtolower($_SESSION['role']) !== 'editor') {
    header('location:../auth/login.php');
    exit;
}
$username = $_SESSION['username'];
?>
<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <title>Tambah Artikel Editor</title>
  <script src="https://cdn.tailwindcss.com"></script>

  <!-- TinyMCE -->
  <script src="https://cdn.jsdelivr.net/npm/tinymce@6/tinymce.min.js" referrerpolicy="origin"></script>
  <script>
    tinymce.init({
      selector: '#isi_artikel',
      height: 300,
      menubar: false,
      plugins: 'lists link image preview code',
      toolbar: 'undo redo | formatselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | code preview'
    });
  </script>
</head>

<body class="bg-gradient-to-b from-blue-50 to-blue-100 min-h-screen font-sans">

  <!-- Header -->
  <header class="bg-blue-900 text-white text-center py-6 shadow-md">
    <h1 class="text-3xl font-bold">📝 Tambah Artikel Editor</h1>
  </header>

  <div class="flex flex-col md:flex-row max-w-7xl mx-auto mt-8 px-4 gap-6">

    <!-- Sidebar -->
    <aside class="md:w-1/4 bg-white rounded-xl shadow p-6">
      <h2 class="text-xl font-semibold text-blue-700 mb-4 text-center">📁 MENU</h2>
      <ul class="space-y-3 text-gray-700">
        <li><a href="beranda_editor.php" class="block hover:text-blue-600">🏠 Beranda</a></li>
        <li><a href="data_artikel.php" class="block font-bold text-blue-900">📝 Artikel Saya</a></li>
        <li><a href="../auth/logout.php" onclick="return confirm('Apakah anda yakin ingin keluar?');"
            class="block text-red-600 hover:underline font-medium">🚪 Logout</a></li>
      </ul>
    </aside>

    <!-- Main Content -->
    <main class="md:w-3/4 bg-white rounded-xl shadow p-8">
      <h2 class="text-xl font-semibold text-blue-800 mb-6">✍️ Form Tambah Artikel</h2>

      <form action="proses_add_artikel.php" method="post" class="space-y-6">
        <div>
          <label for="nama_artikel" class="block text-sm font-medium text-gray-700 mb-1">Judul Artikel</label>
          <input type="text" id="nama_artikel" name="nama_artikel" required
            class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <div>
          <label for="isi_artikel" class="block text-sm font-medium text-gray-700 mb-1">Isi Artikel</label>
          <textarea id="isi_artikel" name="isi_artikel" rows="6"
            class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
        </div>

        <div class="flex justify-end gap-4">
          <button type="submit"
            class="bg-blue-700 text-white px-4 py-2 rounded-md hover:bg-blue-800 transition">Simpan</button>
          <a href="data_artikel.php"
            class="bg-gray-300 text-gray-700 px-4 py-2 rounded-md hover:bg-gray-400 transition">Batal</a>
        </div>
      </form>
    </main>

  </div>

  <!-- Footer -->
  <footer class="bg-blue-800 text-white text-center py-4 mt-12 shadow-inner">
    &copy; <?php echo date('Y'); ?> | Created by <span class="font-semibold">Denis Setiawan Pratama</span>
  </footer>

</body>

</html>
