<?php
include('../koneksi.php');
session_start();
if (!isset($_SESSION['username'])) {
    header('location:../auth/login.php');
    exit;
}

// Validasi ID
if (!isset($_GET['id_gallery']) || !is_numeric($_GET['id_gallery'])) {
    echo "<script>alert('ID tidak valid.'); window.location='data_gallery.php';</script>";
    exit;
}

$id = $_GET['id_gallery'];
$sql = "SELECT * FROM tbl_gallery WHERE id_gallery = '$id'";
$query = mysqli_query($db, $sql);
$data = mysqli_fetch_assoc($query);

if (!$data) {
    echo "<script>alert('Data tidak ditemukan.'); window.location='data_gallery.php';</script>";
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Gallery - Admin Panel</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="icon" href="../assets/favicon.ico" type="image/x-icon">
    
    <style>
        :root {
            --primary: #3b82f6;
            --primary-dark: #2563eb;
            --primary-darker: #1d4ed8;
            --dark-bg: #0f172a;
            --dark-card: #1e293b;
            --dark-text: #e2e8f0;
            --dark-border: #334155;
            --light-card: #ffffff;
            --light-border: #e2e8f0;
        }
        
        * {
            transition: background-color 0.3s, border-color 0.3s, transform 0.2s, box-shadow 0.2s;
        }
        
        body {
            font-family: 'Inter', system-ui, sans-serif;
            background-color: #f8fafc;
        }
        
        .dark {
            background-color: var(--dark-bg);
            color: var(--dark-text);
        }
        
        .dashboard-grid {
            display: grid;
            grid-template-columns: 280px 1fr;
            gap: 1.5rem;
        }
        
        @media (max-width: 1024px) {
            .dashboard-grid {
                grid-template-columns: 1fr;
            }
        }
        
        .sidebar-card {
            background-color: var(--light-card);
            border-radius: 0.75rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 
                        0 2px 4px -1px rgba(0, 0, 0, 0.03);
            height: fit-content;
        }
        
        .dark .sidebar-card {
            background-color: var(--dark-card);
            border: 1px solid var(--dark-border);
        }
        
        .content-card {
            background-color: var(--light-card);
            border-radius: 0.75rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 
                        0 2px 4px -1px rgba(0, 0, 0, 0.03);
            overflow: hidden;
        }
        
        .dark .content-card {
            background-color: var(--dark-card);
            border: 1px solid var(--dark-border);
        }
        
        /* Header styling */
        .header {
            background: linear-gradient(135deg, var(--primary-darker), var(--primary-dark));
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        
        .dark .header {
            background: linear-gradient(135deg, #0f172a, #1e293b);
        }
        
        /* Theme toggle button */
        .theme-toggle {
            background: rgba(255, 255, 255, 0.15);
            border: none;
            cursor: pointer;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background 0.3s, transform 0.2s;
        }
        
        .theme-toggle:hover {
            background: rgba(255, 255, 255, 0.25);
            transform: scale(1.05);
        }
        
        .theme-toggle svg {
            width: 1.25rem;
            height: 1.25rem;
        }
        
        .dark .theme-toggle {
            background: rgba(255, 255, 255, 0.1);
        }
        
        .dark .theme-toggle:hover {
            background: rgba(255, 255, 255, 0.2);
        }
        
        /* Form styling */
        .form-input {
            width: 100%;
            padding: 0.75rem 1rem;
            border-radius: 0.5rem;
            border: 1px solid var(--light-border);
            background-color: white;
            transition: border-color 0.2s, box-shadow 0.2s;
        }
        
        .dark .form-input {
            background-color: #1e293b;
            border-color: var(--dark-border);
            color: var(--dark-text);
        }
        
        .form-input:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(29, 78, 216, 0.2);
        }
        
        .dark .form-input:focus {
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.5);
        }
        
        .form-label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
            color: #374151;
        }
        
        .dark .form-label {
            color: #e5e7eb;
        }
        
        /* File upload styling */
        .file-upload {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            width: 100%;
            height: 160px;
            border: 2px dashed var(--light-border);
            border-radius: 0.5rem;
            background-color: #f8fafc;
            cursor: pointer;
            transition: all 0.2s;
        }
        
        .dark .file-upload {
            border-color: var(--dark-border);
            background-color: #1e293b;
        }
        
        .file-upload:hover {
            border-color: var(--primary);
            background-color: #f0f9ff;
        }
        
        .dark .file-upload:hover {
            background-color: #1e3a8a;
        }
        
        /* Image preview */
        .image-preview {
            max-width: 100%;
            max-height: 300px;
            border-radius: 0.5rem;
            border: 1px solid var(--light-border);
        }
        
        .dark .image-preview {
            border-color: var(--dark-border);
        }
        
        /* Footer */
        .footer {
            background: linear-gradient(135deg, var(--primary-darker), var(--primary-dark));
            box-shadow: 0 -4px 6px rgba(0, 0, 0, 0.05);
        }
        
        .dark .footer {
            background: linear-gradient(135deg, #0f172a, #1e293b);
        }
        
        /* Menu items */
        .menu-item {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.75rem 1rem;
            border-radius: 0.5rem;
            transition: all 0.2s;
            color: #4b5563;
        }
        
        .menu-item:hover {
            background-color: #f1f5f9;
            color: var(--primary);
        }
        
        .dark .menu-item {
            color: #cbd5e1;
        }
        
        .dark .menu-item:hover {
            background-color: #334155;
            color: #93c5fd;
        }
        
        .menu-item.active {
            background-color: #dbeafe;
            color: var(--primary);
            font-weight: 500;
        }
        
        .dark .menu-item.active {
            background-color: rgba(59, 130, 246, 0.2);
            color: #93c5fd;
        }
    </style>
    
    <!-- Preview image before upload -->
    <script>
        function previewImage(event) {
            const reader = new FileReader();
            const imagePreview = document.getElementById('newImagePreview');
            const previewContainer = document.getElementById('newPreviewContainer');
            
            reader.onload = function() {
                imagePreview.src = reader.result;
                previewContainer.classList.remove('hidden');
            }
            
            if (event.target.files[0]) {
                reader.readAsDataURL(event.target.files[0]);
            }
        }
    </script>
</head>
<body class="min-h-screen transition-colors duration-300">
    <!-- Header -->
    <header class="header text-white py-4">
        <div class="max-w-7xl mx-auto flex justify-between items-center px-4">
            <div class="flex items-center gap-3">
                <div class="bg-white/20 p-2 rounded-lg">
                    <i class="fas fa-images text-xl"></i>
                </div>
                <h1 class="text-xl md:text-2xl font-bold">Admin Dashboard</h1>
            </div>
            <div class="flex items-center gap-4">
                <div class="hidden md:flex items-center gap-2 bg-white/10 px-3 py-1 rounded-full">
                    <i class="fas fa-user-circle"></i>
                    <span><?php echo $_SESSION['username']; ?></span>
                </div>
                <button id="theme-toggle" class="theme-toggle">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="dark-icon">
                        <path d="M12 2.25a.75.75 0 01.75.75v2.25a.75.75 0 01-1.5 0V3a.75.75 0 01.75-.75zM7.5 12a4.5 4.5 0 119 0 4.5 4.5 0 01-9 0zM18.894 6.166a.75.75 0 00-1.06-1.06l-1.591 1.59a.75.75 0 101.06 1.061l1.591-1.59zM21.75 12a.75.75 0 01-.75.75h-2.25a.75.75 0 010-1.5H21a.75.75 0 01.75.75zM17.834 18.894a.75.75 0 001.06-1.06l-1.59-1.591a.75.75 0 10-1.061 1.06l1.59 1.591zM12 18a.75.75 0 01.75.75V21a.75.75 0 01-1.5 0v-2.25A.75.75 0 0112 18zM7.758 17.303a.75.75 0 00-1.061-1.06l-1.591 1.59a.75.75 0 001.06 1.061l1.591-1.59zM6 12a.75.75 0 01-.75.75H3a.75.75 0 010-1.5h2.25A.75.75 0 016 12zM6.697 7.757a.75.75 0 001.06-1.06l-1.59-1.591a.75.75 0 00-1.061 1.06l1.59 1.591z" />
                    </svg>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="light-icon">
                        <path fill-rule="evenodd" d="M9.528 1.718a.75.75 0 01.162.819A8.97 8.97 0 009 6a9 9 0 009 9 8.97 8.97 0 003.463-.69.75.75 0 01.981.98 10.503 10.503 0 01-9.694 6.46c-5.799 0-10.5-4.701-10.5-10.5 0-4.368 2.667-8.112 6.46-9.694a.75.75 0 01.818.162z" clip-rule="evenodd" />
                    </svg>
                </button>
            </div>
        </div>
    </header>
    
    <div class="max-w-7xl mx-auto my-6 px-4">
        <div class="dashboard-grid">
            <!-- Sidebar -->
            <div class="sidebar-card p-5">
                <h2 class="text-xl font-semibold text-blue-700 mb-5 dark:text-blue-300 flex items-center gap-2">
                    <i class="fas fa-bars"></i>
                    <span>Admin Menu</span>
                </h2>
                <ul class="space-y-2">
                    <li>
                        <a href="beranda_admin.php" class="menu-item">
                            <i class="fas fa-home text-blue-600 dark:text-blue-400"></i>
                            <span>Beranda</span>
                        </a>
                    </li>
                    <li>
                        <a href="data_artikel.php" class="menu-item">
                            <i class="fas fa-newspaper text-blue-600 dark:text-blue-400"></i>
                            <span>Kelola Artikel</span>
                        </a>
                    </li>
                    <li>
                        <a href="data_gallery.php" class="menu-item active">
                            <i class="fas fa-images text-blue-600 dark:text-blue-400"></i>
                            <span>Kelola Gallery</span>
                        </a>
                    </li>
                    <li>
                        <a href="about.php" class="menu-item">
                            <i class="fas fa-info-circle text-blue-600 dark:text-blue-400"></i>
                            <span>Tentang Aplikasi</span>
                        </a>
                    </li>
                    <li>
                        <a href="../auth/logout.php" onclick="return confirm('Apakah anda yakin ingin keluar?');" 
                           class="menu-item">
                            <i class="fas fa-sign-out-alt text-red-500"></i>
                            <span>Keluar</span>
                        </a>
                    </li>
                </ul>
            </div>
            
            <!-- Main Content -->
            <div class="content-card">
                <div class="p-5 border-b border-gray-200 dark:border-gray-700">
                    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                        <div>
                            <h2 class="text-xl md:text-2xl font-bold text-gray-800 dark:text-gray-100 flex items-center gap-2">
                                <i class="fas fa-edit text-blue-500"></i>
                                <span>Edit Gambar Gallery</span>
                            </h2>
                            <p class="text-gray-600 dark:text-gray-400 mt-1">Perbarui informasi gambar gallery</p>
                        </div>
                        <a href="data_gallery.php" class="px-4 py-2 rounded-md bg-blue-600 text-white hover:bg-blue-700 transition flex items-center gap-2">
                            <i class="fas fa-arrow-left"></i>
                            <span>Kembali</span>
                        </a>
                    </div>
                </div>
                
                <div class="p-6">
                    <form action="proses_edit_gallery.php" method="post" enctype="multipart/form-data" class="space-y-6">
                        <input type="hidden" name="id_gallery" value="<?php echo $data['id_gallery']; ?>">

                        <div>
                            <label for="judul" class="form-label">Judul Gambar*</label>
                            <input type="text" id="judul" name="judul" required 
                                   value="<?php echo htmlspecialchars($data['judul']); ?>"
                                   class="form-input"
                                   placeholder="Masukkan judul untuk gambar">
                        </div>
                        
                        <div>
                            <label for="deskripsi" class="form-label">Deskripsi</label>
                            <textarea id="deskripsi" name="deskripsi" rows="3"
                                      class="form-input"
                                      placeholder="Masukkan deskripsi gambar (opsional)"><?php echo htmlspecialchars($data['deskripsi'] ?? ''); ?></textarea>
                        </div>
                        
                        <div>
                            <label class="form-label">Gambar Saat Ini</label>
                            <img src="../images/<?php echo htmlspecialchars($data['foto']); ?>" 
                                 class="image-preview max-w-xs mb-4" 
                                 alt="Gambar saat ini">
                                 
                            <div class="flex items-center mb-4">
                                <input type="checkbox" id="hapus_gambar" name="hapus_gambar" class="mr-2">
                                <label for="hapus_gambar" class="text-sm text-red-600 dark:text-red-400">Hapus gambar saat disimpan</label>
                            </div>
                        </div>
                        
                        <div>
                            <label for="foto" class="form-label">Ganti Gambar (Opsional)</label>
                            
                            <!-- New Image Preview -->
                            <div id="newPreviewContainer" class="hidden mb-4">
                                <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">Preview Gambar Baru:</p>
                                <img id="newImagePreview" class="image-preview max-w-xs">
                            </div>
                            
                            <div class="file-upload" onclick="document.getElementById('foto').click()">
                                <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                    <i class="fas fa-cloud-upload-alt text-3xl text-gray-500 dark:text-gray-400 mb-3"></i>
                                    <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">Klik untuk upload</span> gambar baru</p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">Format: JPG, PNG, JPEG (Maks. 5MB)</p>
                                </div>
                                <input id="foto" name="foto" type="file" accept="image/*" 
                                       class="hidden" onchange="previewImage(event)">
                            </div>
                        </div>
                        
                        <div>
                            <label for="kategori" class="form-label">Kategori</label>
                            <select id="kategori" name="kategori" class="form-input">
                                <option value="Umum" <?php echo ($data['kategori'] ?? '') === 'Umum' ? 'selected' : ''; ?>>Umum</option>
                                <option value="Event" <?php echo ($data['kategori'] ?? '') === 'Event' ? 'selected' : ''; ?>>Event</option>
                                <option value="Produk" <?php echo ($data['kategori'] ?? '') === 'Produk' ? 'selected' : ''; ?>>Produk</option>
                                <option value="Lainnya" <?php echo ($data['kategori'] ?? '') === 'Lainnya' ? 'selected' : ''; ?>>Lainnya</option>
                            </select>
                        </div>
                        
                        <div class="flex justify-end gap-4 pt-4">
                            <button type="button" onclick="window.location.href='data_gallery.php'"
                                class="px-6 py-2 rounded-md border border-gray-300 text-gray-700 hover:bg-gray-50 transition flex items-center gap-2 dark:border-gray-600 dark:text-gray-200 dark:hover:bg-gray-700">
                                <i class="fas fa-times"></i>
                                Batal
                            </button>
                            <button type="submit"
                                class="px-6 py-2 rounded-md bg-blue-600 text-white hover:bg-blue-700 transition flex items-center gap-2">
                                <i class="fas fa-save"></i>
                                Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Footer -->
    <footer class="footer text-white py-6 mt-8">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <div>
                    <p>&copy; <?php echo date('Y'); ?> | Created by Denis Setiawan Pratama</p>
                    <p class="mt-1 text-blue-200 text-sm">Sistem Manajemen Konten</p>
                </div>
                <div class="mt-4 md:mt-0 flex gap-3">
                    <a href="#" class="text-blue-200 hover:text-white"><i class="fab fa-facebook"></i></a>
                    <a href="#" class="text-blue-200 hover:text-white"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="text-blue-200 hover:text-white"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
        </div>
    </footer>
    
    <script>
        // Dark mode toggle functionality
        const themeToggle = document.getElementById('theme-toggle');
        const htmlElement = document.documentElement;
        
        // Initialize theme
        function initTheme() {
            const savedTheme = localStorage.getItem('theme');
            const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
            
            if (savedTheme === 'dark' || (!savedTheme && prefersDark)) {
                htmlElement.classList.add('dark');
                localStorage.setItem('theme', 'dark');
            } else {
                htmlElement.classList.remove('dark');
                localStorage.setItem('theme', 'light');
            }
        }
        
        // Toggle theme
        function toggleTheme() {
            if (htmlElement.classList.contains('dark')) {
                htmlElement.classList.remove('dark');
                localStorage.setItem('theme', 'light');
            } else {
                htmlElement.classList.add('dark');
                localStorage.setItem('theme', 'dark');
            }
        }
        
        // Initialize
        document.addEventListener('DOMContentLoaded', initTheme);
        themeToggle.addEventListener('click', toggleTheme);
    </script>
</body>
</html>