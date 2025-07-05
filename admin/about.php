<?php
include('../koneksi.php');
session_start();
if (!isset($_SESSION['username'])) {
    header('location:login.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola About - Admin Panel</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
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
        
        /* About card styling */
        .about-card {
            background: linear-gradient(135deg, #f0f9ff, #e0f2fe);
            border-radius: 0.75rem;
            overflow: hidden;
            transition: all 0.3s ease;
        }
        
        .dark .about-card {
            background: linear-gradient(135deg, #1e293b, #0f172a);
            border: 1px solid var(--dark-border);
        }
        
        .about-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
        }
        
        .dark .about-card:hover {
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.3);
        }
        
        /* Action buttons */
        .action-btn {
            display: inline-flex;
            align-items: center;
            padding: 0.4rem 0.8rem;
            border-radius: 0.25rem;
            font-size: 0.875rem;
            transition: all 0.2s;
        }
        
        .edit-btn {
            background-color: #dbeafe;
            color: var(--primary);
        }
        
        .edit-btn:hover {
            background-color: #bfdbfe;
            transform: translateY(-1px);
        }
        
        .delete-btn {
            background-color: #fee2e2;
            color: #dc2626;
        }
        
        .delete-btn:hover {
            background-color: #fecaca;
            transform: translateY(-1px);
        }
        
        .dark .edit-btn {
            background-color: rgba(59, 130, 246, 0.2);
            color: #93c5fd;
        }
        
        .dark .delete-btn {
            background-color: rgba(220, 38, 38, 0.2);
            color: #fca5a5;
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
        
        /* Add button */
        .add-btn {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.6rem 1.5rem;
            font-weight: 500;
            border-radius: 0.5rem;
            background: var(--primary);
            color: white;
            box-shadow: 0 4px 6px rgba(37, 99, 235, 0.3);
            transition: all 0.2s;
        }
        
        .add-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 8px rgba(37, 99, 235, 0.4);
            background: var(--primary-dark);
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
        
        /* Footer */
        .footer {
            background: linear-gradient(135deg, var(--primary-darker), var(--primary-dark));
            box-shadow: 0 -4px 6px rgba(0, 0, 0, 0.05);
        }
        
        .dark .footer {
            background: linear-gradient(135deg, #0f172a, #1e293b);
        }
        
        /* Content styling */
        .about-content {
            line-height: 1.7;
            color: #334155;
        }
        
        .dark .about-content {
            color: #cbd5e1;
        }
        
        .empty-state {
            background: linear-gradient(135deg, #f0f9ff, #e0f2fe);
            border-radius: 0.75rem;
            overflow: hidden;
        }
        
        .dark .empty-state {
            background: linear-gradient(135deg, #1e293b, #0f172a);
        }
    </style>
</head>
<body class="min-h-screen transition-colors duration-300">
    <!-- Header -->
    <header class="header text-white py-4">
        <div class="max-w-7xl mx-auto flex justify-between items-center px-4">
            <div class="flex items-center gap-3">
                <div class="bg-white/20 p-2 rounded-lg">
                    <i class="fas fa-info-circle text-xl"></i>
                </div>
                <h1 class="text-xl md:text-2xl font-bold">Kelola Halaman About</h1>
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
                        <a href="data_gallery.php" class="menu-item">
                            <i class="fas fa-images text-blue-600 dark:text-blue-400"></i>
                            <span>Kelola Gallery</span>
                        </a>
                    </li>
                    <li>
                        <a href="about.php" class="menu-item active">
                            <i class="fas fa-info-circle text-blue-600 dark:text-blue-400"></i>
                            <span>Kelola About</span>
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
                                <i class="fas fa-user-circle text-blue-500"></i>
                                <span>Tentang Saya</span>
                            </h2>
                            <p class="text-gray-600 dark:text-gray-400 mt-1">Kelola konten halaman tentang saya</p>
                        </div>
                        <a href="add_about.php" class="add-btn">
                            <i class="fas fa-plus"></i>
                            <span>Tambah Data</span>
                        </a>
                    </div>
                </div>
                
                <div class="p-5">
                    <div class="space-y-6">
                        <?php
                        $sql = "SELECT * FROM tbl_about ORDER BY id_about DESC";
                        $query = mysqli_query($db, $sql);
                        
                        if (mysqli_num_rows($query) > 0) {
                            while ($data = mysqli_fetch_array($query)) {
                                echo "<div class='about-card p-6'>";
                                echo "<div class='about-content mb-4'>" . nl2br(htmlspecialchars($data['about'])) . "</div>";
                                echo "<div class='flex space-x-4'>";
                                echo "<a href='edit_about.php?id_about={$data['id_about']}' 
                                       class='action-btn edit-btn'>
                                       <i class='fas fa-edit mr-1'></i> Edit
                                    </a>";
                                echo "<a href='delete_about.php?id_about={$data['id_about']}' 
                                       onclick='return confirm(\"Yakin ingin menghapus data ini?\")' 
                                       class='action-btn delete-btn'>
                                       <i class='fas fa-trash mr-1'></i> Hapus
                                    </a>";
                                echo "</div></div>";
                            }
                        } else {
                            echo "<div class='empty-state p-8 text-center rounded-lg'>";
                            echo "<div class='inline-block p-4 bg-blue-100 rounded-full mb-4 dark:bg-blue-900/30'>";
                            echo "<i class='fas fa-info-circle text-4xl text-blue-500 dark:text-blue-400'></i>";
                            echo "</div>";
                            echo "<h3 class='text-xl font-medium text-gray-800 dark:text-gray-200 mb-2'>Belum Ada Data About</h3>";
                            echo "<p class='text-gray-600 dark:text-gray-400 mb-6'>Mulai dengan menambahkan data tentang Anda</p>";
                            echo "<a href='add_about.php' class='add-btn inline-flex'>";
                            echo "<i class='fas fa-plus'></i>";
                            echo "<span>Tambahkan Data</span>";
                            echo "</a>";
                            echo "</div>";
                        }
                        ?>
                    </div>
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
                     <a href="https://www.facebook.com/profile.php?id=61558729195529" target="_blank" rel="noopener noreferrer" class="w-12 h-12 rounded-full bg-primary flex items-center justify-center hover:bg-primary-dark transition transform hover:-translate-y-1">
  <i class="fab fa-facebook-f text-lg"></i>
</a>
                    <a href="https://www.tiktok.com/@denssetiawan26?_t=ZS-8xkkdeN3VQo&_r=1" target="_blank" rel="noopener noreferrer" class="w-12 h-12 rounded-full bg-blue-400 flex items-center justify-center hover:bg-blue-500 transition transform hover:-translate-y-1">
  <i class="fab fa-tiktok text-lg"></i>
</a>
                   <a href="https://www.instagram.com/_denssetiawan?igsh=dHp3bmFuam00MDBz&utm_source=qr" target="_blank" rel="noopener noreferrer" class="w-12 h-12 rounded-full bg-gradient-to-r from-purple-500 to-pink-500 flex items-center justify-center hover:from-purple-600 hover:to-pink-600 transition transform hover:-translate-y-1">
  <i class="fab fa-instagram text-lg"></i>
</a>
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