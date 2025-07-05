<?php include "koneksi.php"; ?>
<!DOCTYPE html>
<html lang="en" class="transition-colors duration-300">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Personal Web | Denis Setiawan Pratama</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <script>
    tailwind.config = {
      darkMode: 'class',
      theme: {
        extend: {
          animation: {
            'fade-in': 'fadeIn 0.6s ease-out both',
            'float': 'float 6s ease-in-out infinite'
          },
          keyframes: {
            fadeIn: {
              '0%': { opacity: '0', transform: 'translateY(20px)' },
              '100%': { opacity: '1', transform: 'translateY(0)' }
            },
            float: {
              '0%, 100%': { transform: 'translateY(0)' },
              '50%': { transform: 'translateY(-10px)' }
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
    .article-card {
      transition: all 0.3s ease;
    }
    .article-card:hover {
      transform: translateY(-5px);
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
          <a href="index.php" class="nav-link relative text-primary dark:text-blue-400 font-semibold px-2 py-1">
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
      <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-10 animate-fade-in">
        <h2 class="text-3xl font-bold text-gray-800 dark:text-white mb-4 md:mb-0">
          Artikel Terbaru
        </h2>
        <div class="flex items-center">
          <span class="mr-3 text-gray-600 dark:text-gray-400">Sort by:</span>
          <div class="relative">
            <select class="bg-gray-100 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-lg pl-4 pr-10 py-2 focus:outline-none focus:ring-2 focus:ring-primary text-gray-800 dark:text-white appearance-none">
              <option>Newest</option>
              <option>Popular</option>
              <option>Oldest</option>
            </select>
            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700 dark:text-gray-300">
              <i class="fas fa-chevron-down text-sm"></i>
            </div>
          </div>
        </div>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        <?php 
        $sql = "SELECT * FROM tbl_artikel ORDER BY id_artikel DESC LIMIT 6"; 
        $query = mysqli_query($db, $sql); 
        while ($data = mysqli_fetch_array($query)) { 
          $excerpt = substr($data['isi_artikel'], 0, 150) . '...';
          echo "<div class='article-card bg-white dark:bg-gray-800 rounded-2xl shadow-lg overflow-hidden hover:shadow-xl transition-all duration-300'>";
          echo "<div class='p-6'>";
          echo "<div class='flex items-center mb-5'>";
          echo "<div class='profile-photo w-12 h-12 rounded-full border-2 border-primary dark:border-primary mr-4'></div>";
          echo "<div>";
          echo "<h3 class='text-xl font-bold text-gray-800 dark:text-white mb-1'>" . htmlspecialchars($data['nama_artikel']) . "</h3>";
          echo "<span class='text-sm text-gray-500 dark:text-gray-400'>" . date('M d, Y', strtotime($data['tgl_artikel'] ?? 'now')) . "</span>";
          echo "</div>";
          echo "</div>";
          echo "<p class='text-gray-600 dark:text-gray-300 mb-5 leading-relaxed'>$excerpt</p>";
          echo "<div class='flex justify-end'>";
          echo "<a href='view_artikel.php' class='text-primary dark:text-blue-400 hover:text-primary-dark dark:hover:text-blue-300 font-medium flex items-center group'>";
          echo "Read more <i class='fas fa-arrow-right ml-2 text-sm transform group-hover:translate-x-1 transition-transform'></i>";
          echo "</a>";
          echo "</div>";
          echo "</div>";
          echo "</div>";
        } 
        ?>
      </div>
      
      <!-- Call to Action -->
      <div class="mt-14 bg-gradient-to-r from-primary to-secondary dark:from-primary-dark dark:to-secondary-dark rounded-2xl p-10 text-center animate-fade-in overflow-hidden relative">
        <div class="absolute -top-10 -right-10 w-32 h-32 bg-white/10 rounded-full"></div>
        <div class="absolute -bottom-10 -left-10 w-40 h-40 bg-white/10 rounded-full"></div>
        
        <div class="relative z-10">
          <h3 class="text-2xl font-bold text-white mb-4">Want to see more articles?</h3>
          <p class="text-blue-100 dark:text-blue-200 mb-8 max-w-2xl mx-auto text-lg">
            Explore my entire collection of thoughts, ideas, and insights on various topics that matter to me.
          </p>
          <a href="#" class="inline-block bg-white text-primary font-semibold px-8 py-3 rounded-lg hover:bg-gray-50 transition-all shadow-lg transform hover:-translate-y-1">
            Browse All Articles
          </a>
        </div>
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
          $sql = "SELECT * FROM tbl_artikel ORDER BY id_artikel DESC LIMIT 8"; 
          $query = mysqli_query($db, $sql); 
          while ($data = mysqli_fetch_array($query)) { 
            echo "<li class='flex items-start py-3 border-b border-gray-100 dark:border-gray-700 last:border-0 group'>";
            echo "<div class='w-2 h-2 rounded-full bg-primary dark:bg-blue-400 mt-2.5 mr-3 flex-shrink-0'></div>";
            echo "<a href='#' class='text-gray-700 dark:text-gray-300 hover:text-primary dark:hover:text-blue-400 transition flex-1 group-hover:translate-x-1 transition-transform'>" . htmlspecialchars($data['nama_artikel']) . "</a>";
            echo "</li>"; 
          } 
          ?>
        </ul>
        <a href="#" class="mt-6 inline-flex items-center text-primary dark:text-blue-400 hover:text-primary-dark dark:hover:text-blue-300 font-medium group">
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
          <a href="https://www.facebook.com/profile.php?id=61558729195529" target="_blank" rel="noopener noreferrer" class="w-12 h-12 rounded-full bg-primary flex items-center justify-center hover:bg-primary-dark transition transform hover:-translate-y-1">
  <i class="fab fa-facebook-f text-lg"></i>
</a>

         <a href="https://www.tiktok.com/@denssetiawan26?_t=ZS-8xkkdeN3VQo&_r=1" target="_blank" rel="noopener noreferrer" class="w-12 h-12 rounded-full bg-blue-400 flex items-center justify-center hover:bg-blue-500 transition transform hover:-translate-y-1">
  <i class="fab fa-tiktok text-lg"></i>
</a>

          <a href="https://www.instagram.com/_denssetiawan?igsh=dHp3bmFuam00MDBz&utm_source=qr" target="_blank" rel="noopener noreferrer" class="w-12 h-12 rounded-full bg-gradient-to-r from-purple-500 to-pink-500 flex items-center justify-center hover:from-purple-600 hover:to-pink-600 transition transform hover:-translate-y-1">
  <i class="fab fa-instagram text-lg"></i>
</a>

        <a href="https://t.me/abahdens" target="_blank" rel="noopener noreferrer"
  class="w-12 h-12 rounded-full bg-blue-700 flex items-center justify-center hover:bg-blue-800 transition transform hover:-translate-y-1">
  <i class="fab fa-telegram text-lg"></i>
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