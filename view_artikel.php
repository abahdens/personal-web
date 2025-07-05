<?php
session_start();
include "koneksi.php";

// Ambil ID artikel dari parameter URL
$id_artikel = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Query untuk mengambil artikel berdasarkan ID
$sql = "SELECT * FROM tbl_artikel WHERE id_artikel = $id_artikel";
$query = mysqli_query($db, $sql);
$artikel = mysqli_fetch_assoc($query);

// Jika artikel tidak ditemukan, redirect ke halaman utama
if (!$artikel) {
    header('Location: index.php');
    exit;
}

// Format tanggal artikel
$tanggal_artikel = date('F j, Y', strtotime($artikel['tgl_artikel']));
?>
<!DOCTYPE html>
<html lang="en" class="transition-colors duration-300">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo htmlspecialchars($artikel['nama_artikel']); ?> | Denis Setiawan Pratama</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <script>
    tailwind.config = {
      darkMode: 'class',
      theme: {
        extend: {
          animation: {
            'fade-in': 'fadeIn 0.6s ease-out both',
          },
          keyframes: {
            fadeIn: {
              '0%': { opacity: '0', transform: 'translateY(20px)' },
              '100%': { opacity: '1', transform: 'translateY(0)' }
            }
          },
          colors: {
            'primary': '#2563eb',
            'primary-dark': '#1d4ed8',
            'secondary': '#7c3aed',
            'secondary-dark': '#6d28d9'
          }
        }
      }
    };
  </script>
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
    
    body {
      font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
      transition: background-color 0.3s ease;
    }
    .article-content {
      line-height: 1.8;
      color: #4b5563;
    }
    .article-content p {
      margin-bottom: 1.5rem;
    }
    .article-content h2 {
      font-size: 1.8rem;
      font-weight: 700;
      margin-top: 2.5rem;
      margin-bottom: 1.5rem;
      color: #1f2937;
    }
    .article-content h3 {
      font-size: 1.5rem;
      font-weight: 600;
      margin-top: 2rem;
      margin-bottom: 1.25rem;
      color: #1f2937;
    }
    .article-content blockquote {
      border-left: 4px solid #3b82f6;
      padding-left: 1.5rem;
      margin: 1.5rem 0;
      color: #4b5563;
      font-style: italic;
    }
    .article-content img {
      max-width: 100%;
      height: auto;
      border-radius: 0.75rem;
      margin: 1.5rem 0;
    }
    .article-content a {
      color: #3b82f6;
      text-decoration: underline;
    }
    .article-content a:hover {
      color: #2563eb;
    }
    .dark .article-content {
      color: #d1d5db;
    }
    .dark .article-content h2, 
    .dark .article-content h3 {
      color: #f3f4f6;
    }
    .dark .article-content blockquote {
      color: #d1d5db;
      border-left-color: #60a5fa;
    }
    .dark .article-content a {
      color: #60a5fa;
    }
    .dark .article-content a:hover {
      color: #3b82f6;
    }
    .nav-link::after {
      content: '';
      position: absolute;
      bottom: -2px;
      left: 0;
      width: 0;
      height: 2px;
      background: linear-gradient(90deg, #60a5fa, #3b82f6);
      transition: width 0.3s ease;
    }
    .nav-link:hover::after {
      width: 100%;
    }
    .profile-photo {
      background-image: url('pp/pp.jpg');
      background-size: cover;
      background-position: center;
    }
    .gradient-bg {
      background: linear-gradient(135deg, #2563eb 0%, #7c3aed 100%);
    }
    .gradient-bg-dark {
      background: linear-gradient(135deg, #1d4ed8 0%, #6d28d9 100%);
    }
    .tag {
      transition: all 0.2s ease;
    }
    .tag:hover {
      transform: translateY(-2px);
    }
  </style>
</head>
<body class="bg-gradient-to-br from-gray-50 to-blue-50 dark:from-gray-900 dark:to-gray-800 text-gray-800 dark:text-gray-200 min-h-screen">
  <!-- Dark Mode Toggle -->
  <div class="absolute top-6 right-6 z-20">
    <label for="darkToggle" class="relative inline-flex items-center cursor-pointer">
      <input type="checkbox" id="darkToggle" class="sr-only">
      <div class="w-14 h-8 bg-gray-300 dark:bg-gray-700 rounded-full transition-colors duration-300"></div>
      <div id="toggleCircle" class="absolute left-1 top-1 w-6 h-6 bg-white rounded-full flex items-center justify-center text-sm transition-transform duration-300 transform">
        <i class="fas fa-sun text-yellow-500"></i>
      </div>
    </label>
  </div>
  
  <!-- Floating decorative elements -->
  <div class="fixed top-10 left-10 w-32 h-32 bg-blue-100 dark:bg-blue-900/50 rounded-full opacity-30 blur-xl animate-float"></div>
  <div class="fixed bottom-10 right-10 w-40 h-40 bg-indigo-100 dark:bg-indigo-900/50 rounded-full opacity-30 blur-xl animate-float animation-delay-2000"></div>
  
  <!-- Header -->
  <header class="relative gradient-bg dark:gradient-bg-dark text-white py-16 px-6 text-center overflow-hidden">
    <div class="absolute top-0 left-0 w-full h-full opacity-10">
      <div class="absolute top-20 left-1/4 w-16 h-16 bg-white rounded-full"></div>
      <div class="absolute top-10 right-20 w-12 h-12 bg-white rounded-full"></div>
      <div class="absolute bottom-20 left-20 w-14 h-14 bg-white rounded-full"></div>
    </div>
    
    <div class="relative max-w-4xl mx-auto animate-fade-in">
      <div class="flex justify-center mb-6">
        <div class="profile-photo w-28 h-28 rounded-full border-4 border-white/30 shadow-xl"></div>
      </div>
      <h1 class="text-4xl md:text-5xl font-bold mb-4 tracking-tight">
        Denis Setiawan Pratama
      </h1>
      <p class="text-xl text-blue-100 max-w-2xl mx-auto">
        Welcome to my personal space where I share my thoughts and creations
      </p>
    </div>
  </header>

  <!-- Navigation -->
  <nav class="sticky top-0 z-10 bg-white dark:bg-gray-800 shadow-md py-4 px-6">
    <div class="max-w-6xl mx-auto flex flex-col md:flex-row justify-between items-center">
      <div class="flex items-center mb-4 md:mb-0">
        <div class="profile-photo w-10 h-10 rounded-full border-2 border-primary dark:border-primary mr-3"></div>
        <span class="font-bold text-lg dark:text-white">Denis S.P.</span>
      </div>
      
      <ul class="flex flex-wrap justify-center gap-6 md:gap-8 font-medium">
        <li>
          <a href="index.php" class="nav-link relative text-gray-700 dark:text-gray-300 hover:text-primary dark:hover:text-blue-400 transition px-2 py-1">
            Artikel
          </a>
        </li>
        <li>
          <a href="gallery.php" class="nav-link relative text-gray-700 dark:text-gray-300 hover:text-primary dark:hover:text-blue-400 transition px-2 py-1">
            Gallery
          </a>
        </li>
        <li>
          <a href="about.php" class="nav-link relative text-gray-700 dark:text-gray-300 hover:text-primary dark:hover:text-blue-400 transition px-2 py-1">
            About
          </a>
        </li>
        <li>
          <a href="auth/login.php" class="flex items-center px-4 py-2 bg-primary dark:bg-primary-dark text-white rounded-lg hover:bg-primary-dark dark:hover:bg-primary transition-all shadow hover:shadow-lg">
            <i class="fas fa-sign-in-alt mr-2"></i> Login
          </a>
        </li>
      </ul>
    </div>
  </nav>

  <!-- Main Content -->
  <main class="max-w-6xl mx-auto px-4 py-10 grid grid-cols-1 lg:grid-cols-4 gap-8">
    <!-- Main Content Area -->
    <div class="lg:col-span-3">
      <article class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg overflow-hidden">
        <!-- Article Header -->
        <div class="p-6 border-b border-gray-100 dark:border-gray-700">
          <h1 class="text-3xl font-bold text-gray-800 dark:text-white mb-4">
            <?php echo htmlspecialchars($artikel['nama_artikel']); ?>
          </h1>
          
          <div class="flex items-center">
            <div class="profile-photo w-12 h-12 rounded-full border-2 border-primary dark:border-primary mr-4"></div>
            <div>
              <h3 class="font-semibold text-gray-800 dark:text-white">Denis Setiawan Pratama</h3>
              <div class="flex items-center text-gray-500 dark:text-gray-400 text-sm">
                <span><?php echo $tanggal_artikel; ?></span>
                <span class="mx-2">•</span>
                <span>5 min read</span>
              </div>
            </div>
          </div>
        </div>
        
        <!-- Article Content -->
        <div class="p-6 article-content">
          <?php echo $artikel['isi_artikel']; ?>
        </div>
        
        <!-- Article Footer -->
        <div class="p-6 border-t border-gray-100 dark:border-gray-700">
          <div class="flex flex-wrap gap-2">
            <span class="tag px-3 py-1 bg-blue-100 dark:bg-blue-900/50 text-primary dark:text-blue-300 rounded-full text-sm font-medium hover:shadow-md">
              Technology
            </span>
            <span class="tag px-3 py-1 bg-blue-100 dark:bg-blue-900/50 text-primary dark:text-blue-300 rounded-full text-sm font-medium hover:shadow-md">
              Web Development
            </span>
          </div>
        </div>
      </article>
      
      <!-- Navigation Buttons -->
      <div class="flex justify-between mt-10">
        <?php
        // Query untuk artikel sebelumnya
        $sql_prev = "SELECT * FROM tbl_artikel WHERE id_artikel < $id_artikel ORDER BY id_artikel DESC LIMIT 1";
        $query_prev = mysqli_query($db, $sql_prev);
        $prev_artikel = mysqli_fetch_assoc($query_prev);
        
        // Query untuk artikel berikutnya
        $sql_next = "SELECT * FROM tbl_artikel WHERE id_artikel > $id_artikel ORDER BY id_artikel ASC LIMIT 1";
        $query_next = mysqli_query($db, $sql_next);
        $next_artikel = mysqli_fetch_assoc($query_next);
        ?>
        
        <?php if ($prev_artikel): ?>
        <a href="view_artikel.php?id=<?php echo $prev_artikel['id_artikel']; ?>" class="flex items-center px-5 py-3 bg-white dark:bg-gray-800 rounded-lg shadow hover:shadow-md transition">
          <i class="fas fa-arrow-left mr-3 text-primary dark:text-blue-400"></i>
          <span><?php echo htmlspecialchars($prev_artikel['nama_artikel']); ?></span>
        </a>
        <?php else: ?>
        <div></div> <!-- Placeholder untuk menjaga layout -->
        <?php endif; ?>
        
        <?php if ($next_artikel): ?>
        <a href="view_artikel.php?id=<?php echo $next_artikel['id_artikel']; ?>" class="flex items-center px-5 py-3 bg-white dark:bg-gray-800 rounded-lg shadow hover:shadow-md transition">
          <span><?php echo htmlspecialchars($next_artikel['nama_artikel']); ?></span>
          <i class="fas fa-arrow-right ml-3 text-primary dark:text-blue-400"></i>
        </a>
        <?php endif; ?>
      </div>
    </div>

    <!-- Sidebar -->
    <aside class="animate-fade-in space-y-8">
      <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-6">
        <h2 class="text-xl font-bold text-gray-800 dark:text-white mb-5 flex items-center pb-3 border-b border-gray-100 dark:border-gray-700">
          <i class="fas fa-list mr-3 text-primary dark:text-blue-400"></i> Daftar Artikel
        </h2>
        <ul class="space-y-4">
          <?php 
          $sql_sidebar = "SELECT * FROM tbl_artikel ORDER BY id_artikel DESC LIMIT 8"; 
          $query_sidebar = mysqli_query($db, $sql_sidebar); 
          while ($artikel_sidebar = mysqli_fetch_array($query_sidebar)) { 
            $active_class = ($artikel_sidebar['id_artikel'] == $id_artikel) ? 'text-primary dark:text-blue-400 font-semibold' : 'text-gray-700 dark:text-gray-300';
            echo "<li class='flex items-start py-3 border-b border-gray-100 dark:border-gray-700 last:border-0 group'>";
            echo "<div class='w-2 h-2 rounded-full bg-primary dark:bg-blue-400 mt-2.5 mr-3 flex-shrink-0'></div>";
            echo "<a href='view_artikel.php?id=" . $artikel_sidebar['id_artikel'] . "' class='$active_class hover:text-primary dark:hover:text-blue-400 transition flex-1 group-hover:translate-x-1 transition-transform'>" . htmlspecialchars($artikel_sidebar['nama_artikel']) . "</a>";
            echo "</li>"; 
          } 
          ?>
        </ul>
        <a href="index.php" class="mt-6 inline-flex items-center text-primary dark:text-blue-400 hover:text-primary-dark dark:hover:text-blue-300 font-medium group">
          View all articles 
          <i class="fas fa-arrow-right ml-2 text-sm transform group-hover:translate-x-1 transition-transform"></i>
        </a>
      </div>
      
      <div class="bg-gradient-to-br from-primary to-secondary dark:from-primary-dark dark:to-secondary-dark rounded-2xl shadow-lg p-6 text-white">
        <div class="flex items-center mb-5 pb-3 border-b border-white/20">
          <i class="fas fa-user-circle text-xl mr-3"></i>
          <h2 class="text-xl font-bold">About Me</h2>
        </div>
        <p class="mb-5 text-blue-100">
          Hi, I'm Denis Setiawan Pratama. I share my thoughts, experiences, and creative work on this personal platform.
        </p>
        <a href="about.php" class="inline-flex items-center text-white font-medium hover:underline group">
          Learn more about me
          <i class="fas fa-arrow-right ml-2 text-sm transform group-hover:translate-x-1 transition-transform"></i>
        </a>
      </div>
      
      <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-6">
        <h2 class="text-xl font-bold text-gray-800 dark:text-white mb-5 flex items-center pb-3 border-b border-gray-100 dark:border-gray-700">
          <i class="fas fa-hashtag mr-3 text-primary dark:text-blue-400"></i> Popular Tags
        </h2>
        <div class="flex flex-wrap gap-3">
          <span class="tag bg-blue-100 dark:bg-blue-900/50 text-primary dark:text-blue-300 px-4 py-1.5 rounded-full text-sm font-medium hover:shadow-md">Technology</span>
          <span class="tag bg-blue-100 dark:bg-blue-900/50 text-primary dark:text-blue-300 px-4 py-1.5 rounded-full text-sm font-medium hover:shadow-md">Design</span>
          <span class="tag bg-blue-100 dark:bg-blue-900/50 text-primary dark:text-blue-300 px-4 py-1.5 rounded-full text-sm font-medium hover:shadow-md">Travel</span>
          <span class="tag bg-blue-100 dark:bg-blue-900/50 text-primary dark:text-blue-300 px-4 py-1.5 rounded-full text-sm font-medium hover:shadow-md">Photography</span>
          <span class="tag bg-blue-100 dark:bg-blue-900/50 text-primary dark:text-blue-300 px-4 py-1.5 rounded-full text-sm font-medium hover:shadow-md">Programming</span>
          <span class="tag bg-blue-100 dark:bg-blue-900/50 text-primary dark:text-blue-300 px-4 py-1.5 rounded-full text-sm font-medium hover:shadow-md">Web Dev</span>
        </div>
      </div>
    </aside>
  </main>

  <!-- Footer -->
  <footer class="bg-gradient-to-r from-gray-800 to-gray-900 dark:from-gray-900 dark:to-gray-950 text-white py-16 px-6 mt-16">
    <div class="max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-4 gap-10">
      <div class="md:col-span-2">
        <div class="flex items-center mb-6">
          <div class="profile-photo w-16 h-16 rounded-full border-2 border-primary mr-5"></div>
          <div>
            <h3 class="text-2xl font-bold">Denis Setiawan Pratama</h3>
            <p class="text-gray-300 mt-1">Personal Portfolio</p>
          </div>
        </div>
        <p class="text-gray-300 max-w-md text-lg">
          A personal web platform where I share my thoughts, experiences, and creative projects with the world.
        </p>
      </div>
      
      <div>
        <h4 class="font-semibold text-lg mb-5 pb-2 border-b border-gray-700 w-max">Navigation</h4>
        <ul class="space-y-3">
          <li><a href="index.php" class="text-gray-300 hover:text-white transition flex items-center group">
            <i class="fas fa-chevron-right text-xs mr-2 text-primary group-hover:translate-x-1 transition-transform"></i> Home
          </a></li>
          <li><a href="gallery.php" class="text-gray-300 hover:text-white transition flex items-center group">
            <i class="fas fa-chevron-right text-xs mr-2 text-primary group-hover:translate-x-1 transition-transform"></i> Gallery
          </a></li>
          <li><a href="about.php" class="text-gray-300 hover:text-white transition flex items-center group">
            <i class="fas fa-chevron-right text-xs mr-2 text-primary group-hover:translate-x-1 transition-transform"></i> About
          </a></li>
          <li><a href="admin/login.php" class="text-gray-300 hover:text-white transition flex items-center group">
            <i class="fas fa-chevron-right text-xs mr-2 text-primary group-hover:translate-x-1 transition-transform"></i> Login
          </a></li>
        </ul>
      </div>
      
      <div>
        <h4 class="font-semibold text-lg mb-5 pb-2 border-b border-gray-700 w-max">Connect</h4>
        <div class="flex space-x-4">
          <a href="#" class="w-12 h-12 rounded-full bg-primary flex items-center justify-center hover:bg-primary-dark transition transform hover:-translate-y-1">
            <i class="fab fa-facebook-f text-lg"></i>
          </a>
          <a href="#" class="w-12 h-12 rounded-full bg-blue-400 flex items-center justify-center hover:bg-blue-500 transition transform hover:-translate-y-1">
            <i class="fab fa-twitter text-lg"></i>
          </a>
          <a href="#" class="w-12 h-12 rounded-full bg-gradient-to-r from-purple-500 to-pink-500 flex items-center justify-center hover:from-purple-600 hover:to-pink-600 transition transform hover:-translate-y-1">
            <i class="fab fa-instagram text-lg"></i>
          </a>
          <a href="#" class="w-12 h-12 rounded-full bg-blue-700 flex items-center justify-center hover:bg-blue-800 transition transform hover:-translate-y-1">
            <i class="fab fa-linkedin-in text-lg"></i>
          </a>
        </div>
      </div>
    </div>
    
    <div class="max-w-6xl mx-auto border-t border-gray-700 mt-14 pt-8 text-center text-gray-400">
      <p>&copy; <?php echo date('Y'); ?> | Created with <i class="fas fa-heart text-red-500 mx-1"></i> by Denis Setiawan Pratama</p>
    </div>
  </footer>

  <!-- Dark Mode Script -->
  <script>
    const toggleInput = document.getElementById('darkToggle');
    const html = document.documentElement;
    const circle = document.getElementById('toggleCircle');

    // Load theme from localStorage
    if (localStorage.getItem('theme') === 'dark') {
      html.classList.add('dark');
      toggleInput.checked = true;
      circle.classList.add('translate-x-6');
      circle.innerHTML = '<i class="fas fa-moon text-indigo-300"></i>';
    }

    toggleInput.addEventListener('change', () => {
      if (toggleInput.checked) {
        html.classList.add('dark');
        localStorage.setItem('theme', 'dark');
        circle.classList.add('translate-x-6');
        circle.innerHTML = '<i class="fas fa-moon text-indigo-300"></i>';
      } else {
        html.classList.remove('dark');
        localStorage.setItem('theme', 'light');
        circle.classList.remove('translate-x-6');
        circle.innerHTML = '<i class="fas fa-sun text-yellow-500"></i>';
      }
    });
  </script>
</body>
</html>