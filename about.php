<?php include "koneksi.php"; ?>
<!DOCTYPE html>
<html lang="en" class="transition-colors duration-300">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>About | Denis Setiawan Pratama</title>
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

    .timeline-item::before {
      content: '';
      position: absolute;
      left: 0;
      top: 0;
      width: 4px;
      height: 100%;
      background: linear-gradient(to bottom, #2563eb, #7c3aed);
    }

    .skill-bar {
      height: 10px;
      border-radius: 5px;
      background: linear-gradient(90deg, #2563eb, #7c3aed);
      position: relative;
      overflow: hidden;
    }

    .skill-bar::after {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.4), transparent);
      animation: shine 2s infinite;
    }

    @keyframes shine {
      0% {
        transform: translateX(-100%);
      }

      100% {
        transform: translateX(100%);
      }
    }
  </style>
</head>

<body
  class="bg-gradient-to-br from-gray-50 to-blue-50 dark:from-gray-900 dark:to-gray-800 text-gray-800 dark:text-gray-200 min-h-screen">
  <!-- Dark Mode Toggle -->
  <div class="absolute top-6 right-6 z-20">
    <label for="darkToggle" class="relative inline-flex items-center cursor-pointer">
      <input type="checkbox" id="darkToggle" class="sr-only">
      <div class="w-14 h-8 bg-gray-300 dark:bg-gray-700 rounded-full transition-colors duration-300"></div>
      <div id="toggleCircle"
        class="absolute left-1 top-1 w-6 h-6 bg-white rounded-full flex items-center justify-center text-sm transition-transform duration-300 transform">
        <i class="fas fa-sun text-yellow-500"></i>
      </div>
    </label>
  </div>

  <!-- Floating decorative elements -->
  <div
    class="fixed top-10 left-10 w-32 h-32 bg-blue-100 dark:bg-blue-900/50 rounded-full opacity-30 blur-xl animate-float">
  </div>
  <div
    class="fixed bottom-10 right-10 w-40 h-40 bg-indigo-100 dark:bg-indigo-900/50 rounded-full opacity-30 blur-xl animate-float animation-delay-2000">
  </div>

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
        About Me
      </h1>
      <p class="text-xl text-blue-100 max-w-2xl mx-auto">
        Get to know my journey, skills, and passions
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
          <a href="index.php"
            class="nav-link relative text-gray-700 dark:text-gray-300 hover:text-primary dark:hover:text-blue-400 transition px-2 py-1">
            Artikel
          </a>
        </li>
        <li>
          <a href="gallery.php"
            class="nav-link relative text-gray-700 dark:text-gray-300 hover:text-primary dark:hover:text-blue-400 transition px-2 py-1">
            Galeri
          </a>
        </li>
        <li>
          <a href="about.php" class="nav-link relative text-primary dark:text-blue-400 font-semibold px-2 py-1">
            Tentang
          </a>
        </li>
        <li>
          <a href="auth/login.php"
            class="flex items-center px-4 py-2 bg-primary dark:bg-primary-dark text-white rounded-lg hover:bg-primary-dark dark:hover:bg-primary transition-all shadow hover:shadow-lg">
            <i class="fas fa-sign-in-alt mr-2"></i> Login
          </a>
        </li>
      </ul>
    </div>
  </nav>

  <!-- Main Content -->
  <main class="max-w-6xl mx-auto px-4 py-10">
    <!-- About Section -->
    <section class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-8 mb-12 animate-fade-in">
      <div class="flex flex-col md:flex-row gap-8">
        <div class="md:w-1/3 flex flex-col items-center">
          <div class="profile-photo w-48 h-48 rounded-2xl border-4 border-primary/20 mb-6"></div>
          <div class="text-center">
            <h2 class="text-2xl font-bold text-gray-800 dark:text-white">Denis Setiawan Pratama</h2>
            <p class="text-primary dark:text-blue-400 font-medium">Mahasiswa Sistem Informasi</p>
            <p class="text-gray-600 dark:text-gray-400 mt-1">Universitas Subang</p>

            <div class="mt-6 flex justify-center space-x-4">
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

        <div class="md:w-2/3">
          <h2
            class="text-2xl font-bold text-gray-800 dark:text-white mb-6 pb-3 border-b border-gray-200 dark:border-gray-700">
            <i class="fas fa-user mr-2 text-primary dark:text-blue-400"></i> Tentang Saya
          </h2>

          <div class="space-y-6 text-gray-600 dark:text-gray-300 leading-relaxed">
            <?php
            $sql = "SELECT * FROM tbl_about ORDER BY id_about DESC";
            $query = mysqli_query($db, $sql);
            while ($data = mysqli_fetch_array($query)):
              ?>
              <p><?= htmlspecialchars($data['about']) ?></p>
            <?php endwhile; ?>
          </div>

          <div class="mt-8">
            <h3 class="text-xl font-bold text-gray-800 dark:text-white mb-4">Keahlian Saya</h3>
            <div class="space-y-5">
              <div>
                <div class="flex justify-between mb-1">
                  <span class="font-medium">Web Development</span>
                  <span class="text-primary dark:text-blue-400">90%</span>
                </div>
                <div class="skill-bar" style="width: 90%"></div>
              </div>
              <div>
                <div class="flex justify-between mb-1">
                  <span class="font-medium">UI/UX Design</span>
                  <span class="text-primary dark:text-blue-400">85%</span>
                </div>
                <div class="skill-bar" style="width: 85%"></div>
              </div>
              <div>
                <div class="flex justify-between mb-1">
                  <span class="font-medium">Database Management</span>
                  <span class="text-primary dark:text-blue-400">80%</span>
                </div>
                <div class="skill-bar" style="width: 80%"></div>
              </div>
              <div>
                <div class="flex justify-between mb-1">
                  <span class="font-medium">Photography</span>
                  <span class="text-primary dark:text-blue-400">75%</span>
                </div>
                <div class="skill-bar" style="width: 75%"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>



    <!-- Contact Section -->
    <section
      class="bg-gradient-to-r from-primary to-secondary dark:from-primary-dark dark:to-secondary-dark rounded-2xl shadow-lg p-8 animate-fade-in">
      <div class="max-w-3xl mx-auto text-center">
        <h2 class="text-2xl font-bold text-white mb-4">Let's Connect</h2>
        <p class="text-blue-100 mb-8 max-w-2xl mx-auto">
          Have a project in mind or want to discuss potential opportunities? Feel free to reach out!
        </p>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
          <div class="bg-white/10 backdrop-blur-sm rounded-xl p-5">
            <div class="w-12 h-12 rounded-full bg-white/20 flex items-center justify-center mx-auto mb-4">
              <i class="fas fa-envelope text-white text-xl"></i>
            </div>
            <p class="text-white font-medium">Email</p>
            <p class="text-blue-100">densabah6@gmail .com</p>
          </div>

          <div class="bg-white/10 backdrop-blur-sm rounded-xl p-5">
            <div class="w-12 h-12 rounded-full bg-white/20 flex items-center justify-center mx-auto mb-4">
              <i class="fas fa-phone text-white text-xl"></i>
            </div>
            <p class="text-white font-medium">Phone</p>
            <p class="text-blue-100">+62 813 2417 1066</p>
          </div>

          <div class="bg-white/10 backdrop-blur-sm rounded-xl p-5">
            <div class="w-12 h-12 rounded-full bg-white/20 flex items-center justify-center mx-auto mb-4">
              <i class="fas fa-map-marker-alt text-white text-xl"></i>
            </div>
            <p class="text-white font-medium">Location</p>
            <p class="text-blue-100">Subang, West Java</p>
          </div>
        </div>

        <a href="#"
          class="inline-block bg-white text-primary font-semibold px-8 py-3 rounded-lg hover:bg-gray-50 transition-all shadow-lg transform hover:-translate-y-1">
          <i class="fas fa-paper-plane mr-2"></i> Send Message
        </a>
      </div>
    </section>
  </main>

  <!-- Footer -->
  <footer
    class="bg-gradient-to-r from-gray-800 to-gray-900 dark:from-gray-900 dark:to-gray-950 text-white py-16 px-6 mt-16">
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
              <i
                class="fas fa-chevron-right text-xs mr-2 text-primary group-hover:translate-x-1 transition-transform"></i>
              Home
            </a></li>
          <li><a href="gallery.php" class="text-gray-300 hover:text-white transition flex items-center group">
              <i
                class="fas fa-chevron-right text-xs mr-2 text-primary group-hover:translate-x-1 transition-transform"></i>
              Gallery
            </a></li>
          <li><a href="about.php" class="text-gray-300 hover:text-white transition flex items-center group">
              <i
                class="fas fa-chevron-right text-xs mr-2 text-primary group-hover:translate-x-1 transition-transform"></i>
              About
            </a></li>
          <li><a href="admin/login.php" class="text-gray-300 hover:text-white transition flex items-center group">
              <i
                class="fas fa-chevron-right text-xs mr-2 text-primary group-hover:translate-x-1 transition-transform"></i>
              Login
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
      <p>&copy; <?php echo date('Y'); ?> | Created with <i class="fas fa-heart text-red-500 mx-1"></i> by Denis Setiawan
        Pratama</p>
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